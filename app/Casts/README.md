# 🎭 گۆڕینی داتا — Custom Casts (`app/Casts`)

> **ئاستی پێویست:** ئاستی پێشکەوتوو (Senior Developer - هەنگاوی ٢٤)  
> **ئامانجی سەرەکی:** گۆڕینی خۆکاری داتای ستوونەکان لە کاتی خوێندنەوە و پاشەکەوتکردن لە بنکەدراوەدا.

---

## 📌 کاست بە کوردی چییە؟

کاست وەک **وەرگێڕی ژوورەوە و دەرەوەی بنکەدراوە** وایە!  
کاتێک تۆ ستوونێکت هەیە لە بنکەدراوە بە ناوی `settings` کە بە دەقی JSON هەڵگیراوە:  
کاتی هێنان لە بنکەدراوە (`get`) ──► دەیکاتە ئۆبجێکتێکی ئاسان بۆ بەکارهێنان.  
کاتی سەیڤکردنەوە (`set`) ──► دەیکاتەوە بە دەقی داتابەیس. هەمووی بەبێ ئەوەی تۆ یەک دێڕ لە کۆنتڕۆڵەر بنووسیت!

---

## 💻 نموونەی کۆد (`AddressCast.php`)

```php
namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class AddressCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        // گۆڕینی JSONی داتابەیس بۆ Array کاتێک دەیخوێنیتەوە
        return json_decode($value, true);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        // گۆڕینی Array بۆ JSON کاتێک سەیڤی دەکەیت
        return json_encode($value);
    }
}
```

---

## 🎓 سەرچاوەی فێربوون
* 📖 [Laravel Docs: Eloquent Custom Casts](https://laravel.com/docs/eloquent-mutators#custom-casts)
* 🎥 [Laracasts: Advanced Eloquent Casts](https://laracasts.com)
