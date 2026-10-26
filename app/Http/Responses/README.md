# 📤 وەڵامدانەوە پێوانەییەکان — Responses (`app/Http/Responses`)

> **ئاستی پێویست:** ئاستی پێشکەوتوو (Senior Developer)  
> **ئامانجی سەرەکی:** دروستکردنی شێوازی وەڵامدانەوەی یەکدەست و ستاندارد بۆ هەموو پەڕەکان و خزمەتگوزارییەکان.

---

## 📌 ڕیسپۆنس (Response) بە کوردی چییە؟

کڵاسی وەڵامدانەوە وەک **فۆڕمی پێوانەیی دەرچوونی نامە لە فەرمانگەدا** وایە!  
کاتێک تۆ ئەپڵیکەیشنێکی مۆبایل دروست دەکەیت، پڕۆگرامەری مۆبایل داوات لێدەکات هەموو وەڵامەکانی API هەمیشە یەک شێوازیان هەبێت:
`{"success": true, "data": [...], "message": "..."}`

لە بری ئەوەی لە هەموو کۆنتڕۆڵەرێک بە دەست ئەم JSONە دروست بکەیتەوە، کڵاسێکی Responsable لەم فۆڵدەرە دروست دەکەیت.

---

## 🔄 نەخشەی چۆنیەتی ڕێکخستنی وەڵام

```text
[ ئەنجامی لۆجیک لە کۆنتڕۆڵەر ]
             │
             ▼
    [ CustomResponse Class ] ──► (فۆرماتکردنی یەکگرتووی داتا + مێژوو + پەیام)
             │
             ▼
[ وەڵامێکی پاک و ستاندارد دەگاتە ئەپی مۆبایل ]
```

---

## 💻 نموونەی کۆد (`ApiResponse.php`)

```php
namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

class ApiResponse implements Responsable
{
    public function __construct(
        protected mixed $data = [],
        protected string $message = 'کردارەکە سەرکەوتوو بوو',
        protected int $status = 200
    ) {}

    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'status'  => $this->status,
            'success' => $this->status >= 200 && $this->status < 300,
            'message' => $this->message,
            'data'    => $this->data,
        ], $this->status);
    }
}
```

---

## 🎓 سەرچاوەی فێربوون
* 📖 [Laravel Docs: Responsable Objects](https://laravel.com/docs/responses#responsable-interfaces)
* 📺 [YouTube: Standardizing API Responses in Laravel](https://www.youtube.com/results?search_query=laravel+responsable+interface)
