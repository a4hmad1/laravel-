# 🎮 Controllers (`app/Http/Controllers`)

> **ئاستی فێربوون**: 🟢 Junior (دەستپێک - هەنگاوی ٢)

## 📌 ئەم فۆڵدەرە چییە؟
کۆنتڕۆڵەر (Controller) مێشکی جوڵەی داواکارییەکانە لە نێوان **Routes** و **Models** و **Views**. کاتێک بەکارهێنەر لە وێبگەڕ یان مۆبایلەوە داواکاری دەنێرێت (HTTP Request)، کۆنتڕۆڵەر وەری دەگرێت، بڕیار دەدات چ لۆجیکێک کار بکات، و وەڵامەکە (Response) دەگەڕێنێتەوە.

---

## 🔄 چۆنیەتی کارکردن (Workflow & Lifecycle)

```
User (Browser / App) 
       │
       ▼
Routes (web.php / api.php)
       │
       ▼
[Controller Method] ──► (بانگکردنی Model یان Service بۆ داتا)
       │
       ▼
Response (HTML View یان JSON API Resource)
```

---

## 💻 نموونەی کۆد (Real-world Example)

```php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::latest()->paginate(10);
        return view('pages.users.index', compact('users'));
    }
}
```

---

## 🎯 ئامۆژگاری بۆ Senior بوون (Best Practices)
* ❌ **هەڵەی باو**: لۆجیکی ئاڵۆزی داتابەیس و حیساباتی دارایی مەخەرە ناو کۆنتڕۆڵەر (Fat Controller).
* ✅ **تەلارسازی دروست**: کۆنتڕۆڵەر با تەنها ڕێکخەر بێت (Skinny Controller)، کارە قورسەکان بدە بە `Actions` یان `Services`.

---

## 🔗 سەرچاوەی فێربوون (Resources)
* 📖 [Laravel Official Docs - Controllers](https://laravel.com/docs/controllers)
* 🎥 [Laracasts - Controllers from Scratch](https://laracasts.com)
