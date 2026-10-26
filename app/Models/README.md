# 🗄️ Eloquent Models (`app/Models`)

> **ئاستی فێربوون**: 🟢 Junior (دەستپێک - هەنگاوی ٥)

## 📌 ئەم فۆڵدەرە چییە؟
مۆدێل نوێنەری خشتەیەکی بنکەدراوەیە. بە بەکارهێنانی تایبەتمەندی بەهێزی Eloquent ORM، بەبێ نووسینی کۆدی درێژی SQL دەتوانیت پەیوەندییەکان (Relationships) و داتاکان بخوێنیتەوە و دەستکاری بکەیت.

---

## 🔄 پەیوەندییە سەرەکییەکان (Relationships)
1. `hasOne` / `belongsTo` (تاک بۆ تاک)
2. `hasMany` / `belongsTo` (تاک بۆ زۆر، بۆ نموونە بەکارهێنەر و پۆستەکانی)
3. `belongsToMany` (زۆر بۆ زۆر، بۆ نموونە خوێندکار و کۆرسەکان)

---

## 💻 نموونەی کۆد

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
```

---

## 🔗 سەرچاوەی فێربوون
* 📖 [Laravel Docs - Eloquent ORM](https://laravel.com/docs/eloquent)
* 🎥 [Laracasts - Eloquent Relationships Deep Dive](https://laracasts.com)
