# 🏷️ Enums (`app/Enums`)

> **ئاستی فێربوون**: 🟡 Mid-Level (هەنگاوی ١٠)

## 📌 ئەم فۆڵدەرە چییە؟
ئینەم (PHP 8.1+) بۆ جێگیرکردنی دۆخ و بەها نەگۆڕەکان بەکاردێت و ڕێگری دەکات لە هەڵەی تایپکردنی تێکست لە داتابەیس یان کۆد.

```php
namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Completed = 'completed';
    case Cancelled = 'cancelled';
}
```
