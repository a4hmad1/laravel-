# 📦 ئەی پی ئای ڕیسۆرس — API Resources (`app/Http/Resources`)

> **ئاستی پێویست:** ئاستی ناوەند (Mid-Level Developer - هەنگاوی ٩)  
> **ئامانجی سەرەکی:** ڕێکخستنی شێوازی دەرچوونی داتاکان بە فۆرماتی JSON بۆ بەرنامەی مۆبایل و فرۆنتێند.

---

## 📌 ڕیسۆرس (Resource) بە کوردییەکی سادە چییە؟

ڕیسۆرس وەکو **فلتەری زانیاری لە نێوان داتابەیس و خەڵکی دەرەوە** وایە!  
کاتێک ئەپڵیکەیشنی مۆبایل داوای زانیاری بەکارهێنەرێک دەکات لە ڕێگەی API:
* ناگونجێت هەموو ستوونەکانی ناو خشتەکە بە ڕووتی بۆ مۆبایل بنێریت (وەک: `password_hash` یان `remember_token` یان نۆتی نهێنی).
* پڕۆگرامەری مۆبایل پێویستی بە داتایەکی پاک و ڕێکخراوە.

لێرەدا API Resource وەک فلتەرێک دادەنێیت؛ تەنها ئەو فیلدانە هەڵدەبژێریت کە پێویستن و بە شێوازێکی زۆر جوان و هاوچەرخ دەیانکەیتە فۆرماتی JSON.

---

## 💻 نموونەی کۆد (`StudentResource.php`)

```php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * گۆڕینی مۆدێلەکە بۆ نەخشەیەکی پاکی JSON
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'full_name'    => $this->name,
            'email'        => $this->email,
            'joined_since' => $this->created_at->diffForHumans(), // وەک: پێش ٣ مانگ
            'status'       => $this->status,
        ];
    }
}
```

---

## 🚀 چۆن لە کۆنتڕۆڵەری API بانگی بکەین؟

```php
use App\Http\Resources\StudentResource;
use App\Models\User;

public function show(User $student): StudentResource
{
    return new StudentResource($student);
}

// بۆ هێنانی کۆمەڵێک قوتابی پێکەوە (Collection):
public function index()
{
    $students = User::where('role', 'student')->paginate(10);
    return StudentResource::collection($students);
}
```

---

## 🎓 سەرچاوە فێرکارییە تایبەتەکان بۆ ئەم بابەتە

* 🎥 **Laracasts (دروستکردنی API بە پێوەرە بەرزەکان):**  
  [Laracasts: Transforming API Data with Eloquent Resources](https://laracasts.com/series/whatcha-working-on/episodes/35)
* 📺 **فێرکاری ڤیدیۆیی یوتیوب:**  
  [YouTube: Laravel API Resources Tutorial Crash Course](https://www.youtube.com/results?search_query=laravel+api+resources+tutorial)
* 📖 **بەڵگەنامەی فەرمی لارافێڵ:**  
  [Laravel Docs: Eloquent API Resources](https://laravel.com/docs/eloquent-resources)
