# 🚦 ڕێڕەوەکان — Routes (`routes`)

> **ئاستی پێویست:** ئاستی سەرەتایی (Junior Developer - یەکەمین هەنگاو)  
> **ئامانجی سەرەکی:** دەروازەی سەرەکی وەرگرتنی ناونیشانی URL و بەستنەوەی بە کۆنتڕۆڵەرەکان.

---

## 🖼️ وێنەی ڕێڕەوی کارکردن (Visual Workflow)

![Workflow Diagram](diagram.svg)


## 📌 ڕاوت (Route) بە کوردییەکی سادە چییە؟

ڕاوت وەکو **تەابلۆی ڕێنمایی سەر شەقامەکان** وایە!  
کاتێک بەکارهێنەر لە وێبگەڕەکەیدا دەنوسێت: `mysite.com/courses`  
ڕاوت تەماشای دەکات و دەڵێت: «ئەم کەسە ناونیشانی coursesـی دەوێت، کەواتە بیبە بۆ لای مۆدێلی کۆرسەکان لە ناو `CourseController` لە فەنکشنی `index`».

---

## 📂 فایلە سەرەکییەکانی ناو فۆڵدەری `routes`:

* **`web.php`:** بۆ ئەو پەڕانەی لە وێبگەڕ دەکرێنەوە و Session و Cookies و پاراستنی دژی ساختەکاری (CSRF Token) لەخۆ دەگرن.
* **`api.php`:** بۆ ئەپڵیکەیشنی مۆبایل و دەرچوونی JSON (Stateless / Token-based).
* **`console.php`:** بۆ فەرمانە خێراکانی ناو تێرمیناڵ.
* **`channels.php`:** بۆ کەناڵەکانی پەخشی ڕاستەوخۆ (WebSockets).

---

## 💻 نموونەی کۆد (`routes/web.php`)

```php
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

// پەڕەی سەرەکی
Route::get('/', function () {
    return view('welcome');
});

// ڕێڕەوی دڵنیاکراو کە تەنها ئەوانەی چوونەتە ژوورەوە دەتوانن بیبینن (Auth Middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
});
```

---

## 🎓 سەرچاوە فێرکارییە تایبەتەکان بۆ ئەم بابەتە

* 🎥 **Laracasts (دەستپێکی ڕاوتەکان):**  
  [Laracasts: Laravel Routing Basics](https://laracasts.com/series/laravel-30-days-to-learn-it/episodes/3)
* 📺 **فێرکاری ڤیدیۆیی یوتیوب:**  
  [YouTube: Laravel Routing Tutorial with Real Examples](https://www.youtube.com/results?search_query=laravel+routing+beginner+tutorial)
* 📖 **بەڵگەنامەی فەرمی لارافێڵ:**  
  [Laravel Docs: Routing](https://laravel.com/docs/routing)
