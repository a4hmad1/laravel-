# ⚠️ بەڕێوەبردنی هەڵەکان — Exceptions (`app/Exceptions`)

> **ئاستی پێویست:** ئاستی پێشکەوتوو (Senior Developer - هەنگاوی ٢٦)  
> **ئامانجی سەرەکی:** دروستکردنی هەڵەی دیاریکراو بۆ بەڕێوەبردنی پرۆفیشناڵانەی کێشەکان بەبێ ئەوەی ماڵپەڕەکە بکەوێت.

---

## 📌 ئێکسێپشن بە کوردی چییە؟

ئێکسێپشن وەک **ئاگادارکردنەوەی برێکی دەستی ئۆتۆمبێل** وایە!  
کاتێک کڕیارێک دەیەوێت کۆرسێک بکڕێت کە نرخەکەی $50ە، بەڵام باڵانسەکەی تەنها $10ە:  
ئەگەر کۆدەکەت بێ ئاگابێت، لەوانەیە کڕینەکە ڕووبدات یان هەڵەی نەناسراوی داتابەیس (SQL Error) پیشانی خەڵک بدات کە زۆر مەترسیدارە!

لە بری ئەوە، ئێکسێپشنێکی تایبەت دروست دەکەیت بە ناوی `InsufficientBalanceException` و بە شێوازێکی زۆر شارستانی و بە زمانی کوردی پەیامێک پیشانی کڕیار دەدەیت: «باڵانسی پێویستت نییە، تکایە باڵانسەکەت پڕبکەرەوە».

---

## 💻 نموونەی کۆد (`CourseFullException.php`)

```php
namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseFullException extends Exception
{
    /**
     * پیشاندانی پەیامی هەڵە بە شێوازی جوان بۆ کڕیار
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'بەداخەوە هەموو کورسییەکانی ئەم کۆرسە پڕبوون و ناتوانیت ناونووسین بکەیت.',
        ], 422);
    }
}
```

---

## 🎓 سەرچاوەی فێربوون
* 📖 [Laravel Docs: Error Handling](https://laravel.com/docs/errors)
* 📺 [YouTube: Custom Exceptions in Laravel Explained](https://www.youtube.com/results?search_query=laravel+custom+exceptions+tutorial)
