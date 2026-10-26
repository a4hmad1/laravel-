# 🔍 فلتەری کوێرییەکان — Scopes (`app/Models/Scopes`)

> **ئاستی پێویست:** ئاستی پێشکەوتوو (Senior Developer - هەنگاوی ٢٤)  
> **ئامانجی سەرەکی:** دانانی فلتەری هەمیشەیی و خۆکار لەسەر داتاکان بەبێ دووبارەکردنەوەی مەرجەکان.

---

## 📌 سکۆپ (Scope) بە کوردی چییە؟

سکۆپ وەکو **عەینەکی فلتەرکراوی کاتی خوێندنەوەی داتابەیس** وایە!  
کاتێک تۆ ماڵپەڕێک دروست دەکەیت، ڕەنگە ٩٩٪ی کاتەکان تەنها ئەو قوتابیانەت بوێت کە «چالاکن» (`is_active = true`).  
ئەگەر لە ٥٠ شوێنی جیاوازی پڕۆژەکە بنووسیت `where('is_active', true)`، ڕۆژێک لەبیرت دەچێت و قوتابیە سڕاوەکان لە شوێنێک دزە دەکەن!

بەڵام کاتێک **Global Scope** دادەنێیت، عەینەکێک دەخەیتە سەر چاوی لارافێڵ: ئیتر هەر کوێرییەک بۆ خوێندکار بکەیت، لارافێڵ بە شێوەیەکی خۆکار تەنها چالاکەکان دەهێنێت بەبێ ئەوەی تۆ وشەیەک بنووسیت!

---

## 💻 نموونەی کۆد (`ActiveScope.php`)

```php
namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ActiveScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        // فلتەری خۆکار بۆ ئەوەی تەنها بەکارهێنەرە چالاکەکان بهێنرێن
        $builder->where('is_active', true);
    }
}
```

---

## 🎓 سەرچاوەی فێربوون
* 📖 [Laravel Docs: Eloquent Global & Local Scopes](https://laravel.com/docs/eloquent#query-scopes)
* 🎥 [Laracasts: Clean Queries with Eloquent Scopes](https://laracasts.com)
