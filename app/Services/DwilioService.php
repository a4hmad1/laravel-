<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class DwilioService
{
    protected string $apiKey;
    protected string $baseUrl;

    public function __construct()
    {
        $this->apiKey = (string) config('services.dwilio.api_key');
        $this->baseUrl = rtrim((string) config('services.dwilio.base_url', 'https://api.dwilio.com'), '/');
    }

    /**
     * Normalize mobile phone number for Dwilio API (digits only, international format without +).
     * Specifically handles Iraqi numbers (07XXXXXXXXX, 7XXXXXXXXX -> 9647XXXXXXXXX)
     * and GCC numbers.
     */
    public function normalizePhone(string $phone): string
    {
        // Remove spaces, dashes, brackets, plus, leading zeros/00
        $clean = preg_replace('/[^\d]/', '', $phone);

        // Remove international double-zero prefix if present
        if (str_starts_with($clean, '00')) {
            $clean = substr($clean, 2);
        }

        // Iraqi number starting with 07 (11 digits): 07701234567 -> 9647701234567
        if (preg_match('/^0(7\d{9})$/', $clean, $matches)) {
            return '964' . $matches[1];
        }

        // Iraqi number starting with 7 (10 digits): 7701234567 -> 9647701234567
        if (preg_match('/^(7\d{9})$/', $clean, $matches)) {
            return '964' . $matches[1];
        }

        // Saudi Arabia trunk zero: 96605XXXXXXXX -> 9665XXXXXXXX
        if (preg_match('/^9660(5\d{8})$/', $clean, $matches)) {
            return '966' . $matches[1];
        }

        // UAE trunk zero: 9710(5\d{8}) -> 9715XXXXXXXX
        if (preg_match('/^9710(5\d{8})$/', $clean, $matches)) {
            return '971' . $matches[1];
        }

        return $clean;
    }

    /**
     * Send OTP verification code via WhatsApp.
     */
    public function sendOtp(string $phone, string $channel = 'whatsapp'): array
    {
        $normalizedPhone = $this->normalizePhone($phone);

        if (empty($normalizedPhone)) {
            return [
                'success' => false,
                'error' => 'Invalid phone number format.',
                'phone' => $normalizedPhone,
            ];
        }

        try {
            $response = Http::withToken($this->apiKey)
                ->timeout(12)
                ->acceptJson()
                ->post("{$this->baseUrl}/api/sms", [
                    'phone' => $normalizedPhone,
                    'channel' => $channel,
                ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'messageId' => $response->json('messageId'),
                    'status' => $response->json('status', 'pending'),
                    'cost' => $response->json('cost'),
                    'phone' => $normalizedPhone,
                ];
            }

            $errorMsg = $response->json('error') ?? $response->json('message') ?? 'Provider rejected the request';

            // Provide clear, actionable feedback for WhatsApp availability
            if ($response->status() === 400 || $response->status() === 502) {
                if (stripos($errorMsg, 'invalid phone') !== false) {
                    $errorMsg = 'This phone number is invalid or not registered on WhatsApp. Please check the number and try again.';
                }
            }

            Log::warning('Dwilio sendOtp failed', [
                'phone' => $normalizedPhone,
                'status' => $response->status(),
                'response' => $response->body(),
            ]);

            return [
                'success' => false,
                'error' => $errorMsg,
                'phone' => $normalizedPhone,
                'status_code' => $response->status(),
            ];
        } catch (Throwable $e) {
            Log::error('Dwilio sendOtp exception', [
                'phone' => $normalizedPhone,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => 'Unable to connect to WhatsApp OTP service. Please try again later.',
                'phone' => $normalizedPhone,
            ];
        }
    }

    /**
     * Verify the OTP code entered by the user.
     */
    public function verifyOtp(string $phone, string $code): array
    {
        $normalizedPhone = $this->normalizePhone($phone);
        $cleanCode = trim($code);

        if (empty($normalizedPhone) || empty($cleanCode)) {
            return [
                'success' => false,
                'error' => 'Phone number and verification code are required.',
            ];
        }

        try {
            $response = Http::withToken($this->apiKey)
                ->timeout(10)
                ->acceptJson()
                ->post("{$this->baseUrl}/api/verify", [
                    'phone' => $normalizedPhone,
                    'code' => $cleanCode,
                ]);

            if ($response->successful() && $response->json('verified') === true) {
                return [
                    'success' => true,
                    'verified' => true,
                    'phone' => $normalizedPhone,
                ];
            }

            $status = $response->status();
            $errorMessage = match ($status) {
                401 => 'The verification code you entered is incorrect. Please double-check your WhatsApp message.',
                404 => 'No pending verification request found for this number. Please request a new code.',
                410 => 'This verification code has expired. Please request a new code.',
                429 => 'Too many failed verification attempts. Please wait a moment and request a new code.',
                default => $response->json('error') ?? 'Verification failed. Please try again.',
            };

            Log::info('Dwilio verifyOtp failed', [
                'phone' => $normalizedPhone,
                'status' => $status,
                'response' => $response->body(),
            ]);

            return [
                'success' => false,
                'verified' => false,
                'error' => $errorMessage,
                'status_code' => $status,
            ];
        } catch (Throwable $e) {
            Log::error('Dwilio verifyOtp exception', [
                'phone' => $normalizedPhone,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'verified' => false,
                'error' => 'Could not verify code with WhatsApp service. Please try again.',
            ];
        }
    }

    /**
     * Check wallet balance and channel rates.
     */
    public function getBalance(): array
    {
        try {
            $response = Http::withToken($this->apiKey)
                ->timeout(5)
                ->acceptJson()
                ->get("{$this->baseUrl}/api/balance");

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(),
                ];
            }

            return [
                'success' => false,
                'error' => $response->json('error') ?? 'Failed to retrieve balance',
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}
