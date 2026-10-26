# 🗄️ مۆدێلەکان — Eloquent Models (`app/Models`)

> **ئاستی پێویست:** ئاستی سەرەتایی (Junior Developer - هەنگاوی ٥)  
> **ئامانجی سەرەکی:** پەیوەندی بەستن لەگەڵ خشتەکانی بنکەدراوە بە شێوازی ئۆبجێکت (Eloquent ORM).

---

## 📌 مۆدێل بە کوردییەکی سادە چییە؟

مۆدێل (Model) واتە: **وەرگێڕی نێوان کۆدی PHP و خشتەی بنکەدراوە.**  
پێشتر لە پرۆگرامسازیدا، بۆ ئەوەی زانیارییەک لە داتابەیس بهێنیت دەبوو کۆدی درێژی SQL بنووسیت وەک:
`SELECT * FROM users WHERE status = 'active'`

بەڵام لە لارافێڵدا، مۆدێل وایکردووە بە زمانی ئینگلیزی ئاسایی کۆد بنووسیت:
`User::where('status', 'active')->get();`

هەر خشتەیەکی بنکەدراوە (وەک `students`, `orders`, `courses`)، مۆدێلێکی تایبەت بە خۆی هەیە لەم فۆڵدەرە بە پیتی گەورە و تاک (وەک `Student`, `Order`, `Course`).

---

## 🔄 پەیوەندییە گرنگەکانی نێوان مۆدێلەکان (Relationships)

1. **تاک بۆ تاک (`hasOne` / `belongsTo`):** هەر بەکارهێنەرێک تەنها یەک پرۆفایلی هەیە.
2. **تاک بۆ زۆر (`hasMany` / `belongsTo`):** هەر مامۆستایەک دەتوانێت چەندین وانە بڵێتەوە.
3. **زۆر بۆ زۆر (`belongsToMany`):** هەر قوتابییەک چەندین کۆرس وەردەگرێت، و هەر کۆرسێک چەندین قوتابی تێدایە.

---

## 💻 نموونەی کۆد (`Course.php`)

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    // ئەو ستوونانەی ڕێگەپێدراون دەستکاری بکرێن
    protected $fillable = [
        'teacher_id',
        'title',
        'price',
        'is_published',
    ];

    /**
     * ئەم کۆرسە سەر بە کام مامۆستایە؟
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * ئەم کۆرسە چەند وانەی (Lessons) هەیە؟
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
```

---

## 🛠️ فەرمانی تێرمیناڵ بۆ دروستکردنی مۆدێل لەگەڵ مایگرەیشن:

```bash
php artisan make:model Course -m
```

---

## 🎓 سەرچاوە فێرکارییە تایبەتەکان بۆ ئەم بابەتە

* 🎥 **Laracasts (تایبەت بە تێگەیشتنی تەواوی Eloquent):**  
  [Laracasts: Eloquent Relationships Demystified](https://laracasts.com/series/eloquent-relationships)
* 📺 **فێرکاری ڤیدیۆیی لە یوتیوب:**  
  [YouTube: Laravel Eloquent ORM Full Course](https://www.youtube.com/results?search_query=laravel+eloquent+relationships+tutorial)
* 📖 **بەڵگەنامەی فەرمی لارافێڵ:**  
  [Laravel Docs: Eloquent Getting Started](https://laravel.com/docs/eloquent)
