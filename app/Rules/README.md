# ✅ یاسا تایبەتەکانی پشکنین — Custom Rules (`app/Rules`)

> **ئاستی پێویست:** ئاستی ناوەند (Mid-Level Developer - هەنگاوی ١٤)  
> **ئامانجی سەرەکی:** دروستکردنی مەرجی تایبەت بۆ فۆڕمەکان کاتێک یاساکانی ئاسایی لارافێڵ بەس نین.

---

## 📌 یاسای تایبەت بە کوردی چییە؟

لارافێڵ خاوەنی سەدان یاسای ئامادەکراوە وەک `required`, `email`, `numeric`. بەڵام چەندین جار پێویستت بە مەرجێکە کە تەنها لە وڵاتی خۆمان یان بەپێی یاسای کۆمپانیاکەت هەیە؛ بۆ نموونە:
* ئایا ئەم ژمارەی مۆبایلە لەسەر شێوازی فەرمی هێڵەکانی کوردستان و عێراقە (کۆڕەک، ئاسیا، زین)؟
* ئایا کۆدی ناسنامەکە لە ١٠ ڕەقەم پێکهاتووە و ساختە نییە؟

لە بری ئەوەی کۆدی ئاڵۆزی پشکنین لە ناو کۆنتڕۆڵەر بنووسیت، کڵاسێکی پاک لەم فۆڵدەرە دروست دەکەیت.

---

## 💻 نموونەی کۆد (`KurdishPhoneNumber.php`)

```php
namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class KurdishPhoneNumber implements ValidationRule
{
    /**
     * پشکنینی ڕاستی ژمارەی مۆبایل
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // مەرج: دەبێت ژمارەکە بە 07 دەستپێبکات و تەواوی ژمارەکە ١١ ڕەقەم بێت
        if (! preg_match('/^(0750|0751|0770|0771|0780)[0-9]{7}$/', (string) $value)) {
            $fail('تکایە ژمارەیەکی مۆبایلی دروستی کوردستان یان عێراق بنووسە.');
        }
    }
}
```

---

## 🚀 چۆن لە فۆڕم ڕیکوێستدا بەکاری بهێنین؟

```php
use App\Rules\KurdishPhoneNumber;

public function rules(): array
{
    return [
        'phone' => ['required', new KurdishPhoneNumber()],
    ];
}
```

---

## 🎓 سەرچاوەی فێربوون
* 📖 [Laravel Docs: Custom Validation Rules](https://laravel.com/docs/validation#custom-validation-rules)
* 📺 [YouTube: Laravel Custom Validation Rules Tutorial](https://www.youtube.com/results?search_query=laravel+custom+validation+rules)
