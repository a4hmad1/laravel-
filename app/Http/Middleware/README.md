# 🛡️ Middleware (`app/Http/Middleware`)

> **ئاستی فێربوون**: 🟡 Mid-Level (هەنگاوی ٨)

## 📌 ئەم فۆڵدەرە چییە؟
میدڵوێر فلتەر و پاسەوانی نێوان داواکاری (Request) و سیستەمەکەیە. بەکاردێت بۆ دڵنیابوونەوە لەوەی بەکارهێنەر چووەتە ژوورەوە (Authentication)، چالاکە، یان ئاستی ڕێگەپێدانی هەیە (Role/Permission).

---

## 💻 نموونەی کۆد

```php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && ! $request->user()->is_active) {
            abort(403, 'ئەم ئەژمێرە لەکارخراوە.');
        }

        return $next($request);
    }
}
```

---

## 🔗 سەرچاوەی فێربوون
* 📖 [Laravel Docs - Middleware](https://laravel.com/docs/middleware)
