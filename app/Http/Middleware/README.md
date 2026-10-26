# 🛡️ پاسەوانانی داواکاری — Middleware (`app/Http/Middleware`)

> **ئاستی پێویست:** ئاستی ناوەند (Mid-Level Developer - هەنگاوی ٨)  
> **ئامانجی سەرەکی:** پشکنین، فلتەرکردن و پاراستنی پڕۆژەکە پێش ئەوەی داواکاری بگاتە ناوەڕۆکی سیستەم.

---

## 📌 میدڵوێر (Middleware) بە کوردییەکی زۆر سادە چییە؟

میدڵوێر وەکو **خاڵی پشکنینی ئاسایش (Checkpoint) لە دەروازەی شارێک** وایە!  
هەموو ئۆتۆمبێلێک (HTTP Request) کە دەیەوێت بێتە ناو شارەوە (پڕۆژەکەت)، بەم بازگەیەدا تێدەپەڕێت:
* ئەگەر ناسنامەی پێنەبێت (چوونەژوورەوەی ئەنجام نەدابێت) ──► دەگەڕێنرێتەوە بۆ دواوە بۆ پەڕەی چوونەژوورەوە (Login).
* ئەگەر بەکارهێنەرەکە ئەژمێرەکەی لەکارخرابێت (Banned) ──► پەیامی هەڵەی 403 پیشان دەدرێت.
* ئەگەر هەموو شتێک یاسایی بوو ──► پێی دەوترێت: «فەرموو بڕۆ بۆ لای کۆنتڕۆڵەر» (`$next($request)`).

---

## 🔄 نەخشەی چۆنیەتی تێپەڕبوونی داواکاری (Middleware Pipeline)

```text
داواکاری کڕیار (Request)
         │
         ▼
[ میدڵوێری یەکەم: ئایا ئەپڵیکەیشن لە چاککردنەوەدایە؟ (Maintenance) ]
         │ (بەڵێ یاساییە)
         ▼
[ میدڵوێری دووەم: ئایا چووەتە ژوورەوە؟ (Auth Middleware) ]
         │ (بەڵێ ناسراوە)
         ▼
[ میدڵوێری سێیەم: ئایا مۆڵەتی ئەدمینی هەیە؟ (Admin Middleware) ]
         │ (بەڵێ ڕێگەپێدراوە)
         ▼
[ گەیشتن بە کۆنتڕۆڵەر (Controller Method) ]
```

---

## 💻 نموونەی کۆد (`CheckAdminRole.php`)

```php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * پشکنینی ئەوەی ئایا بەکارهێنەر ئەدمینە
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ئەگەر بەکارهێنەر نەچووبێتە ژوورەوە یان ئەدمین نەبێت، ڕێگری لێبکە
        if (! $request->user() || ! $request->user()->is_admin) {
            abort(403, 'تۆ دەسەڵاتی چوونەژوورەوەت بۆ ئەم بەشە نییە!');
        }

        // ئەگەر کێشەی نەبوو، با داواکارییەکە تێپەڕێت بۆ هەنگاوی دواتر
        return $next($request);
    }
}
```

---

## 🚀 چۆن ڕێڕەوەکان (Routes) بەم میدڵوێرە بپارێزین؟

لە ناو فایلی `routes/web.php`:

```php
use App\Http\Middleware\CheckAdminRole;

Route::middleware(['auth', CheckAdminRole::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
});
```

---

## 🎓 سەرچاوە فێرکارییە تایبەتەکان بۆ ئەم بابەتە

* 🎥 **Laracasts (کۆرسی ناسینی تەواوی Middleware):**  
  [Laracasts: Understanding Middleware in Laravel](https://laracasts.com/series/laravel-30-days-to-learn-it/episodes/16)
* 📺 **فێرکاری ڤیدیۆیی یوتیوب:**  
  [YouTube: Laravel Middleware Tutorial for Beginners](https://www.youtube.com/results?search_query=laravel+middleware+explained)
* 📖 **بەڵگەنامەی فەرمی لارافێڵ:**  
  [Laravel Docs: Middleware](https://laravel.com/docs/middleware)
