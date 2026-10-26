# 🎮 کۆنتڕۆڵەرەکان — Controllers (`app/Http/Controllers`)

> **ئاستی پێویست:** ئاستی سەرەتایی (Junior Developer - هەنگاوی ٢)  
> **ئامانجی سەرەکی:** وەرگرتنی داواکاری لە کڕیار، بڕیاردان لەسەر لۆجیک، و گەڕاندنەوەی وەڵام.

---

## 📌 کۆنتڕۆڵەر بە کوردییەکی سادە چییە؟

کۆنتڕۆڵەر (Controller) وەکو **گارسۆنی ناو چێشتخانە** وایە!  
کاتێک کڕیار دادەنیشێت و داواکاری خواردنێک دەکات، گارسۆنەکە دەچێتە چێشتخانەکە، داواکارییەکە دەدات بە چێشتلێنەرەکە (Model / Database)، کاتێک خواردنەکە ئامادە بوو، دەیهێنێتەوە سەر مێزی کڕیارەکە (View / HTML / JSON).  
گارسۆنەکە خۆی خواردن لێنانێت! تەنها هاتوچۆ بە داواکارییەکان دەکات.

---

## 🔄 نەخشەی چۆنیەتی کارکردنی کۆنتڕۆڵەر (Visual Lifecycle)

```text
[ بەکارهێنەر / کڕیار ] 
       │  (١. کلیک دەکات لەسەر بەستەر یان دوگمەیەک)
       ▼
[ Routes (routes/web.php) ]
       │  (٢. دەینێرێت بۆ فەنکشنی دیاریکراو لە کۆنتڕۆڵەر)
       ▼
[ Controller Method ] ◄───► [ Model / داتابەیس ] (٣. داوای داتاکە دەکات)
       │
       ▼  (٤. وەڵامەکە ئامادە دەکات)
[ View یان JSON Response ] ──► دەگەڕێتەوە بۆ شاشەی بەکارهێنەر
```

---

## 💻 نموونەی کۆد (`StudentController.php`)

```php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * پیشاندانی لیستی قوتابیان
     */
    public function index(): View
    {
        // ١. هێنانی قوتابیەکان لە بنکەدراوە
        $students = User::where('role', 'student')->latest()->paginate(10);

        // ٢. ناردنی داتاکان بۆ پەڕەی دیزاینکراوی خوێندکاران
        return view('pages.students.index', compact('students'));
    }
}
```

---

## 💡 ئامۆژگاری زێڕین بۆ ئەوەی ببیت بە پڕۆگرامەری بەهێز

* ❌ **هەڵەی باوی دەستپێکەران (Fat Controller):** هەموو کۆدەکانی ناردنی ئیمەیڵ، حیساباتی بانکی، و گۆڕینی وێنە لە ناو کۆنتڕۆڵەر دەنووسن! ئەمە هەڵەیە و کۆدەکەت شێواو دەکات.
* ✅ **کۆنتڕۆڵەری پرۆفیشناڵ (Skinny Controller):** کۆنتڕۆڵەر پێویستە تەنها نێوەندگیر بێت، هەموو کارە قورسەکان بدات بە فۆڵدەری `Requests` (بۆ پشکنین) و `Actions` یان `Services` (بۆ لۆجیک).

---

## 🎓 سەرچاوە فێرکارییە تایبەتەکان بۆ ئەم بابەتە

* 🎥 **Laracasts (کۆرسی تەواوی کۆنتڕۆڵەر لە سفرەوە):**  
  [Laracasts: Laravel 11 / 12 from Scratch - Controllers](https://laracasts.com/series/laravel-30-days-to-learn-it)
* 📺 **ڤیدیۆی فێرکاری یوتیوب:**  
  [YouTube: Laravel Controllers Full Guide for Beginners](https://www.youtube.com/results?search_query=laravel+controllers+tutorial+step+by+step)
* 📖 **بەڵگەنامەی فەرمی لارافێڵ:**  
  [Laravel Official Documentation: Controllers](https://laravel.com/docs/controllers)
