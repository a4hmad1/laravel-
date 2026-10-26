# 🏛️ کۆگای داتا — Repositories (`app/Repositories`)

> **ئاستی پێویست:** ئاستی پێشکەوتوو (Senior Developer - هەنگاوی ٢٢)  
> **ئامانجی سەرەکی:** جیاکردنەوەی لۆجیکی پڕۆژە لە چۆنیەتی هەڵگرتن و هێنانی داتا لە بنکەدراوەدا.

---

## 📌 ڕیپۆزیتۆری بە کوردییەکی سادە چییە؟

ڕیپۆزیتۆری وەک **دەرمانخانە یان عەمباردار** وایە!  
کاتێک تۆ دەچیتە دەرمانخانە، ناچیتە ناو ژووری عەمبارەکە تا دەرمانەکە خۆت بدۆزیتەوە؛ بەڵکو داواکارییەک دەدەیت بە کارمەندەکە و ئەو دەرمانەکەت بۆ دەهێنێت.  
لە پڕۆژەی گەورەشدا:
* کۆنتڕۆڵەر ڕاستەوخۆ دەستکاری داتابەیس ناکات.
* لە ڕیپۆزیتۆری داوای دەکات: `$studentRepo->getTopPerformers(10)`.
* ئەگەر سبەی بڕیارت دا ئەم داتایە لە داتابەیسی خێراتر (Redis) بهێنیت، تەنها ناوەڕۆکی ڕیپۆزیتۆری دەگۆڕیت بەبێ ئەوەی یەک دێڕی کۆنتڕۆڵەر دەستکاری بکەیت.

---

## 💻 نموونەی کۆد (`StudentRepository.php`)

```php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class StudentRepository
{
    public function getActiveStudents(): Collection
    {
        return User::where('role', 'student')
            ->where('is_active', true)
            ->latest()
            ->get();
    }
}
```

---

## 🎓 سەرچاوەی فێربوون
* 🎥 [Laracasts: Repositories in Practice](https://laracasts.com/series/laravel-beyond-crud)
* 📺 [YouTube: Laravel Repository Pattern Full Guide](https://www.youtube.com/results?search_query=laravel+repository+pattern+explained)
