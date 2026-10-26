# 🧬 تڕەیتەکان — Traits (`app/Traits`)

> **ئاستی پێویست:** ئاستی ناوەند (Mid-Level Developer)  
> **ئامانجی سەرەکی:** هاوبەشکردنی کۆد و فانکشنەکان لە نێوان چەند کڵاسێکی جیاواز بەبێ پێویستی میراتگری ئاڵۆز.

---

## 📌 تڕەیت (Trait) بە کوردی چییە؟

تڕەیت وەک **پارچەی پێوەکراو (Plugin) بۆ کڵاسەکان** وایە!  
لە زمانی PHP ناکرێت کڵاسێک لە دوو کڵاسی باوک میرات بگرێت (No Multiple Inheritance). بەڵام ئەگەر چەند مۆدێلێکت هەبێت (وەک: مامۆستا، قوتابی، بابەت، کۆرس) و هەموویان پێویستیان بەوە بێت کە «ناوی خوازراوی URL (Slug)»یان بۆ دروست بێت:  
لە بری کۆپیکردنی هەمان کۆد لەناو هەموو مۆدێلەکان، کڵاسێکی Trait دروست دەکەیت و تەنها دەنوسیت `use HasSlug;` لە ناو مۆدێلەکانتدا.

---

## 💻 نموونەی کۆد (`HasSlug.php`)

```php
namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug) && ! empty($model->title)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }
}
```

---

## 🎓 سەرچاوەی فێربوون
* 🎥 [Laracasts: When and How to Use PHP Traits](https://laracasts.com/series/php-for-beginners)
