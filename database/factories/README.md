# 🏭 مۆدێل فاکتۆری — Factories (`database/factories`)

> **ئاستی پێویست:** ئاستی سەرەتایی بۆ ناوەند (Junior to Mid-Level)  
> **ئامانجی سەرەکی:** دروستکردنی داتای ساختەی ئەزموونی بە هەزاران دانە بۆ تاقیکردنەوە.

---

## 📌 فاکتۆری (Factory) بە کوردی چییە؟

فاکتۆری وەکو **کارگەی دروستکردنی داتای ئەزموونی** وایە!  
کاتێک کۆدی گەڕان (Search) یان لاپەڕەبەندی (Pagination) دروست دەکەیت، ئەگەر لە داتابەیسەکەتدا تەنها ٢ دانە قوتابی هەبێت هەرگیز نازانیت کۆدەکەت چۆن کاردەکات! بە فاکتۆری تەنها بە یەک دێڕ دەتوانیت **١٠،٠٠٠ قوتابی ساختە** دروست بکەیت بە ناوی کوردی/ئینگلیزی، ئیمەیڵ، ژمارەی تەلەفۆن و ناونیشانی جیاواز.

---

## 💻 نموونەی کۆد (`UserFactory.php`)

```php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
        ];
    }
}
```

---

## 🎓 سەرچاوەی فێربوون
* 📖 [Laravel Docs: Eloquent Factories](https://laravel.com/docs/eloquent-factories)
