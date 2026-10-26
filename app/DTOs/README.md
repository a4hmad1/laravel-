# 🚚 ئۆبجێکتی گواستنەوەی داتا — DTOs (`app/DTOs`)

> **ئاستی پێویست:** ئاستی پێشکەوتوو (Senior Developer - هەنگاوی ١٧)  
> **ئامانجی سەرەکی:** بەکارهێنانی کڵاسی تایپکراو (Typesafe Objects) بۆ گواستنەوەی داتا لە بری Arrayـی تاریک و مەترسیدار.

---

## 📌 دی تی ئۆ (DTO) بە کوردییەکی سادە چییە؟

دی تی ئۆ (Data Transfer Object) وەکو **کارتۆنێکی ڕێکخراوی پاکەتکردن** وایە!  
کاتێک بەکارهێنەر فۆڕمێک پڕ دەکاتەوە، ئەگەر داتاکان بە `$request->all()` یان بە `array` بنێریت بۆ ناو سێرڤیسەکانت:
* هیچ دڵنیاییەک نییە ناوی کلیلی داتاکان بە دروستی نووسراون (ئایا `$data['user_name']` بوو یان `$data['name']`؟).
* مێشکی پڕۆگرامەر لە ناو ئارایەکاندا دەشێوێت و ئەگەری هەڵە زۆر دەبێت.

کڵاسی DTO کڵاسێکی سادەیە لە PHP 8.2+ کە هەموو فیلدەکان بە جۆری خۆیان دیاری دەکات (`string $name`, `int $age`, `float $price`). بەمەش کۆدەکانت هەمیشە سەلامەت و پارێزراون.

---

## 💻 نموونەی کۆد (`CreateUserData.php`)

```php
namespace App\DTOs;

readonly class CreateUserData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?string $phone = null,
    ) {}

    /**
     * دروستکردنی DTO ڕاستەوخۆ لە ناو FormRequest
     */
    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            phone: $data['phone'] ?? null,
        );
    }
}
```

---

## 🎓 سەرچاوە فێرکارییە تایبەتەکان بۆ ئەم بابەتە

* 🎥 **Laracasts (تایبەت بە تەلارسازی داتا):**  
  [Laracasts: Data Transfer Objects in Modern PHP](https://laracasts.com/series/php-for-beginners)
* 📖 **ڕێبەری نووسراوی Spatie:**  
  [Working with DTOs in Laravel - Brent Roose](https://stitcher.io/blog/laravel-beyond-crud-01-data-transfer-objects)
