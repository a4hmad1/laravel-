# Simple Laravel WhatsApp OTP Authentication

A clean, modern Laravel application featuring **WhatsApp OTP Authentication** powered by the **Dwilio API**.

---

## 🚀 Features

1. **User Registration with WhatsApp Verification**:
   - Requires a valid WhatsApp phone number.
   - Automatically sends an OTP to WhatsApp via Dwilio (`POST /api/sms`) to confirm the number is active and available.
   - User verifies their 6-digit OTP to complete registration and log in.

2. **User Login**:
   - Supports login using **WhatsApp Phone Number** (accepts `07XXXXXXXXX`, `+964XXXXXXXXXX`, etc.) or **Email**.
   - Password verification with "Remember Me" option.

3. **Forgot & Reset Password via WhatsApp OTP**:
   - User enters their registered WhatsApp number.
   - Dwilio delivers a secure 6-digit verification code to the user's WhatsApp.
   - User verifies the OTP and sets their new password in one simple step.

4. **Phone Normalization**:
   - Automatically normalizes local Iraqi phone numbers (`0770XXXXXXX`, `770XXXXXXX`, `+964 770 XXXXXXX`) into the standard international format (`964770XXXXXXX`).
   - Also supports Saudi Arabia, UAE, and GCC mobile numbers.

5. **Dwilio API Integration**:
   - Base URL: `https://api.dwilio.com`
   - Configured with your API key: `dw_5156921b_382fd3e5a96c7405656955aca848fee1f5f9d6f0905fbb7f`
   - Real-time balance and WhatsApp quota status widget displayed in the dashboard.

6. **Modern, Responsive UI**:
   - Styled with Tailwind CSS and designed with a clean WhatsApp emerald color scheme.
   - Countdown timer for OTP resend.
   - Flash alerts for success and error messages.

---

## 🛠️ Requirements & Setup

- **PHP**: 8.2+ (PHP 8.5 tested)
- **Composer**: 2.x
- **Database**: SQLite (pre-configured out of the box in `database/database.sqlite`)

### 1. Environment Configuration

The `.env` file already contains your credentials:

```env
DWILIO_API_KEY=dw_5156921b_382fd3e5a96c7405656955aca848fee1f5f9d6f0905fbb7f
DWILIO_BASE_URL=https://api.dwilio.com
```

### 2. Run Database Migrations

```bash
php artisan migrate
```

### 3. Start Development Server

```bash
php artisan serve
```

Visit [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser.

---

## 🧪 Automated Tests

The test suite covers full registration, OTP verification, phone normalization, login, and password reset flows:

```bash
php artisan test
```

Result: `10 passed (36 assertions)`.

---

## 📁 Project Structure

- `app/Services/DwilioService.php`: Core integration service for phone normalization, OTP sending, and verification via Dwilio.
- `app/Http/Controllers/AuthController.php`: Complete authentication logic for Login, Register, Verify, Forgot Password, and Dashboard.
- `resources/views/auth/`: Clean Blade templates for `login`, `register`, `register-verify`, `forgot-password`, and `reset-password`.
- `resources/views/dashboard.blade.php`: User dashboard with live gateway balance and profile card.
- `routes/web.php`: Clean, readable web routes.
