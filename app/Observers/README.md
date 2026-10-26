# 👀 چاودێرەکانی مۆدێل — Observers (`app/Observers`)

> **ئاستی پێویست:** ئاستی پێشکەوتوو (Senior Developer - هەنگاوی ٢٠)  
> **ئامانجی سەرەکی:** چاودێریکردنی ڕووداوەکانی ژیانی مۆدێل (دروستبوون، نوێبوونەوە، سڕینەوە) و کارکردنی ئۆتۆماتیکی.

---

## 📌 ئۆبسێرڤەر بە کوردییەکی زۆر سادە چییە؟

ئۆبسێرڤەر وەک **کامێرای چاودێری و پاسەوانی مۆدێلێک** وایە!  
کاتێک تۆ لە هەر شوێنێکی سیستمەکە مۆدێلێک دەستکاری دەکەیت، ئۆبسێرڤەر دەستبەجێ هەستی پێدەکات و کاری خۆی دەکات بەبێ ئەوەی پێویست بکات تۆ لە کۆنتڕۆڵەر شتێک بنووسیت:
* هەر کە قوتابییەک دروست بوو (`created`) ──► ئۆتۆماتیکی کۆدی خوێندکاری بۆ دروست دەکات.
* هەر کە کۆرسێک سڕایەوە (`deleted`) ──► ئۆتۆماتیکی هەموو ڤیدیۆکانی ناو سێرڤەر دەسڕێتەوە تا جێگە نەگرێت!

---

## 💻 نموونەی کۆد (`UserObserver.php`)

```php
namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * پێش ئەوەی بەکارهێنەر لە داتابەیس دروست بێت:
     */
    public function creating(User $user): void
    {
        // دروستکردنی ناوی خوازراوی URL بە شێوەی ئۆتۆماتیک (Slug)
        if (empty($user->slug)) {
            $user->slug = Str::slug($user->name) . '-' . rand(1000, 9999);
        }
    }

    /**
     * کاتێک بەکارهێنەر دەسڕدرێتەوە:
     */
    public function deleted(User $user): void
    {
        // سڕینەوەی وێنەی پرۆفایلەکەی لە کۆگا
        if ($user->avatar) {
            \Storage::disk('public')->delete($user->avatar);
        }
    }
}
```

---

## 🎓 سەرچاوە فێرکارییە تایبەتەکان بۆ ئەم بابەتە

* 🎥 **Laracasts (فێربوونی Model Observers):**  
  [Laracasts: Eloquent Model Observers](https://laracasts.com/series/eloquent-relationships)
* 📺 **فێرکاری ڤیدیۆیی یوتیوب:**  
  [YouTube: How to use Model Observers in Laravel](https://www.youtube.com/results?search_query=laravel+model+observers+tutorial)
* 📖 **بەڵگەنامەی فەرمی لارافێڵ:**  
  [Laravel Docs: Eloquent Observers](https://laravel.com/docs/eloquent#observers)
