# 🌱 داتابەیس سیدەر — Seeders (`database/seeders`)

> **ئاستی پێویست:** ئاستی سەرەتایی (Junior Developer - هەنگاوی ٦)  
> **ئامانجی سەرەکی:** تێکردنی داتای سەرەتایی و جێگیر بۆ ناو خشتەکان بە یەک فەرمان.

---

## 📌 سیدەر (Seeder) بە کوردی چییە؟

سیدەر وەکو **تۆوی کشتوکاڵ** وایە بۆ داتابەیسەکەت!  
کاتێک پڕۆژەیەکی نوێ دەستپێدەکەیت، داتابەیسەکەت بە تەواوی بەتاڵە؛ بەڵام سیستەمەکەت پێویستی بەوەیە:
* لانی کەم یەک هەژماری سەرەکی ئەدمین هەبێت تا بتوانیت بچیتە ژوورەوە.
* ناوی شارەکان یان جۆری دراوەکان (USD, IQD) لە سیستمەکەدا هەبێت.

لە بری ئەوەی هەموو جارێک بە دەست لە ناو phpMyAdmin یان TablePlus زانیارییەکان بنووسیتەوە، لە فایلی Seeder دەینووسیت و تەنها بە فەرمانێک پڕی دەکەیتەوە:
```bash
php artisan db:seed
```

---

## 💻 نموونەی کۆد (`DatabaseSeeder.php`)

```php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // دروستکردنی ئەژماری سەرەکی بەڕێوەبەر
        User::firstOrCreate(
            ['email' => 'admin@school.com'],
            [
                'name'     => 'بەڕێوەبەری سیستەم',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ]
        );

        // دروستکردنی ٥٠ خوێندکاری نموونەیی بە فاکتۆری
        User::factory(50)->create();
    }
}
```

---

## 🎓 سەرچاوەی فێربوون
* 📖 [Laravel Docs: Seeding](https://laravel.com/docs/seeding)
* 🎥 [Laracasts: Database Seeding Masterclass](https://laracasts.com)
