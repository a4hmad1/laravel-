# 💼 چینی خزمەتگوزاری — Services (`app/Services`)

> **ئاستی پێویست:** ئاستی ناوەند (Mid-Level Developer - هەنگاوی ١١)  
> **ئامانجی سەرەکی:** کۆکردنەوە و ڕێکخستنی لۆجیکی ئاڵۆزی پڕۆژە (Business Logic) لە دەرەوەی کۆنتڕۆڵەر.

---

## 📌 کڵاسی سێرڤیس بە کوردییەکی سادە چییە؟

کڵاسی سێرڤیس (Service Class) واتە: **وەستای کارەکە!**  
کاتێک کڕیارێک شتێک دەکڕێت، ئەم کارە تەنها بریتی نییە لە سەیڤکردنێکی سادە؛ بەڵکو:
1. پێویستە پارەکە لە ڕێگەی فاسپەی یان کارتی بانکی ڕابکێشیت.
2. ژمارەی کاڵاکە لە عەمبار (داتابەیس) کەم بکەیتەوە.
3. نامەی دڵنیایی بە کورتەنامە (SMS) بۆ کڕیار بنێریت.
4. خاڵی خەڵات بە هەژمارەکەی زیاد بکەیت.

ئەگەر ئەم هەموو کارە لە ناو کۆنتڕۆڵەر بنووسیت، کۆدەکەت دەبێتە پشێوی. بەڵام کڵاسی `CheckoutService` دروست دەکەیت و هەموو ئەم قۆناغانە بە ڕێکی تێیدا دادەنێیت.

---

## 🔄 نەخشەی کارکردنی سێرڤیس (Business Flow)

```text
[ Controller ]
      │  داوای تەواوکردنی کڕین دەکات
      ▼
[ PaymentService ] ──┬──► ١. پارەدان لە ڕێگەی بانکی دەرەکی (API)
                     ├──► ٢. دروستکردنی پسوڵە لە داتابەیس (Database)
                     ├──► ٣. کەمکردنەوەی ژمارە لە کۆگا (Inventory)
                     └──► ٤. ناردنی کورتەنامەی پسوڵە (SMS Notification)
```

---

## 💻 نموونەی کۆد (`PaymentService.php`)

```php
namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Exception;

class PaymentService
{
    /**
     * تەواوکردنی پرۆسەی کڕین
     */
    public function processOrder(User $user, float $amount, array $items): Order
    {
        // ١. لێبڕینی پارە لە دەروازەی بانکی
        $isCharged = true; // نموونەی بانگکردنی API بانک

        if (! $isCharged) {
            throw new Exception('پارەدانەکە سەرکەوتوو نەبوو!');
        }

        // ٢. دروستکردنی داواکاری لە داتابەیس
        $order = Order::create([
            'user_id' => $user->id,
            'amount'  => $amount,
            'status'  => 'completed',
        ]);

        return $order;
    }
}
```

---

## 🎓 سەرچاوە فێرکارییە تایبەتەکان بۆ ئەم بابەتە

* 🎥 **Laracasts (چۆنیەتی بەکارهێنانی سێرڤیس):**  
  [Laracasts: How and When to Use Service Classes](https://laracasts.com/series/laravel-beyond-crud)
* 📺 **فێرکاری ڤیدیۆیی لە یوتیوب:**  
  [YouTube: Service Pattern in Laravel Explained](https://www.youtube.com/results?search_query=laravel+service+classes+pattern)
