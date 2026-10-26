# 🏷️ بەها جێگیرەکان — Enums (`app/Enums`)

> **ئاستی پێویست:** ئاستی ناوەند (Mid-Level Developer - هەنگاوی ١٠)  
> **ئامانجی سەرەکی:** ڕێگری لە هەڵەی نووسین و یەکخستنی دۆخە نەگۆڕەکان لە سیستمدا.

---

## 🖼️ وێنەی ڕێڕەوی کارکردن (Visual Workflow)

![Workflow Diagram](diagram.svg)


## 📌 ئینەم (Enum) بە کوردییەکی سادە چییە؟

ئینەم واتە: **لیستێکی دیاریکراو لە هەڵبژاردن کە نابێت هیچ شتێکی دەرەکی لەخۆ بگرێت.**  
بۆ نموونە دۆخی داواکاری خوێندکارێک لە سیستەمدا تەنها سێ حاڵەتە:
1. چاوەڕوانکراو (`pending`)
2. وەرگیراو (`approved`)
3. ڕەتکراوە (`rejected`)

ئەگەر Enum بەکارنەهێنیت، لەوانەیە ڕۆژێک پڕۆگرامەرێک بە هەڵە بنووسێت `'aprovd'` یان پیتی گەورە و بچووک تێکەڵ بکات، ئەو کات هەموو ڕاپۆرتەکانی سیستەم تێکدەچن! بەڵام کاتێک Enum دادەنێیت، PHP هەرگیز ڕێگە نادات هیچ وشەیەکی دەرەوەی ئەو سێ دانەیە بنووسرێت.

---

## 💻 نموونەی کۆد (`StudentStatus.php`)

```php
namespace App\Enums;

enum StudentStatus: string
{
    case Pending  = 'pending';
    case Active   = 'active';
    case Suspended = 'suspended';

    /**
     * پیشاندانی ناو بە کوردی بۆ ناو ڕووکاری وێب
     */
    public function label(): string
    {
        return match($this) {
            self::Pending   => 'لە چاوەڕوانیدایە',
            self::Active    => 'چالاکە',
            self::Suspended => 'ڕاگیراوە',
        };
    }

    /**
     * ڕەنگی باج لە دیزایندا
     */
    public function color(): string
    {
        return match($this) {
            self::Pending   => 'yellow',
            self::Active    => 'green',
            self::Suspended => 'red',
        };
    }
}
```

---

## 🛠️ فەرمانی تێرمیناڵ بۆ دروستکردنی Enum:

```bash
php artisan make:enum StudentStatus
```

---

## 🎓 سەرچاوە فێرکارییە تایبەتەکان بۆ ئەم بابەتە

* 🎥 **Laracasts (فێربوونی PHP Enums لە لارافێڵدا):**  
  [Laracasts: PHP 8.1 Enums in Laravel](https://laracasts.com/series/whats-new-in-php-81/episodes/1)
* 📺 **فێرکاری ڤیدیۆیی لە یوتیوب:**  
  [YouTube: How to use Enums in Laravel 10/11/12](https://www.youtube.com/results?search_query=laravel+enums+explained)
