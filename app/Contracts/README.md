# 📋 پەیماننامە و ڕێککەوتنەکان — Contracts & Interfaces (`app/Contracts`)

> **ئاستی پێویست:** ئاستی پێشکەوتوو (Senior Developer - هەنگاوی ٢١)  
> **ئامانجی سەرەکی:** نەخشەسازی ستاندارد و جێبەجێکردنی بنەماکانی SOLID و پاک ڕاگرتنی پەیوەندی نێوان کڵاسەکان.

---

## 📌 کۆنتراکت (Contract) بە کوردی چییە؟

کۆنتراکت وەک **گرێبەستی شەرعی نێوان دوو لایەن** وایە!  
کاتێک پڕۆژەیەکی گەورە دروست دەکەیت، تۆ گرێبەستێک (Interface) دادەنێیت بە ناوی `PaymentGatewayInterface` کە دەڵێت:
«هەر کڵاسێک بیەوێت لەم پڕۆژەیەدا پارە وەربگرێت، دەبێت ئەم سێ فانکشنەی هەبێت: `charge()`, `refund()`, `verify()`».

ئیتر سبەی گەر ویستت دەروازەی پارەدان لە **FIB** بگۆڕیت بۆ **FastPay** یان **QiCard**، تەنها بە گۆڕینی یەک دێڕ لە ناو `AppServiceProvider` دەیگۆڕیت بەبێ ئەوەی دەستکاری یەک پیتی کۆنتڕۆڵەرەکانت بکەیت!

---

## 💻 نموونەی کۆد (`PaymentGatewayInterface.php`)

```php
namespace App\Contracts;

interface PaymentGatewayInterface
{
    public function charge(float $amount): bool;
    public function refund(string $transactionId): bool;
}
```

---

## 🎓 سەرچاوەی فێربوون
* 🎥 [Laracasts: SOLID Principles in PHP - Interfaces](https://laracasts.com/series/solid-principles-in-php)
