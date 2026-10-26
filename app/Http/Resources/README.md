# 📦 API Resources (`app/Http/Resources`)

> **ئاستی فێربوون**: 🟡 Mid-Level (هەنگاوی ٩)

## 📌 ئەم فۆڵدەرە چییە؟
کڵاسەکانی API Resource وەک چینی گۆڕینی داتا (Transformation Layer) کار دەکەن لە نێوان Eloquent Models و کڕیارەکانی API (وەک مۆبایل و فرۆنتێند). ڕێگری دەکات لە دزەپێکردنی زانیاری نهێنی (وەک وشەی تێپەڕ) و شێوازی JSON یەکدەست دەکات.

---

## 💻 نموونەی کۆد

```php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
```

---

## 🔗 سەرچاوەی فێربوون
* 📖 [Laravel Docs - Eloquent: API Resources](https://laravel.com/docs/eloquent-resources)
