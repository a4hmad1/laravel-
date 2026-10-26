# 💼 Services (`app/Services`)

> **ئاستی فێربوون**: 🟡 Mid-Level (هەنگاوی ١١)

## 📌 ئەم فۆڵدەرە چییە؟
کڵاسی خزمەتگوزاری (Service Class) ئەو شوێنەیە کە لۆجیکی ئاڵۆزی پڕۆژەکەی تێدا کۆدەکرێتەوە (Business Logic). ئەگەر کارێک پێویستی بە چەندین هەنگاو بێت (داتابەیس، پەیوەندی دەرەکی، ئیمەیڵ، پارەدان)، هەمووی لە Service دەنووسرێت تا کۆنتڕۆڵەر کورت و پاک بێتەوە.

---

## 💻 نموونەی کۆد

```php
namespace App\Services;

use App\Models\Order;
use App\Models\User;

class PaymentService
{
    public function processCheckout(User $user, float $amount): Order
    {
        // ١. پەیوەندی بە دەروازەی پارەدان
        // ٢. دروستکردنی داواکاری لە داتابەیس
        return Order::create([
            'user_id' => $user->id,
            'amount'  => $amount,
            'status'  => 'completed',
        ]);
    }
}
```

---

## 🔗 سەرچاوەی فێربوون
* 🎥 [Laracasts - Service Layer in Laravel](https://laracasts.com)
