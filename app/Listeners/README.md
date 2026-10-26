# 👂 گوێگرەکانی ڕووداو — Listeners (`app/Listeners`)

> **ئاستی پێویست:** ئاستی پێشکەوتوو (Senior Developer - هەنگاوی ١٩)  
> **ئامانجی سەرەکی:** گوێگرتن لە Events و ئەنجامدانی کاری کرداری لە کاتی ڕوودانیاندا.

---

## 📌 گوێگر (Listener) بە کوردی چییە؟

ئەو کڵاسەیە کە دەوەستێت تا ڕووداوێک ڕووبدات، دەستبەجێ هەڵدەستێت بە جێبەجێکردنی ئەرکەکەی. باشترین لایەنی ئەوەیە دەتوانیت بیکەیتە ئەرکی پاشبنەما (`implements ShouldQueue`) تا بەبێ وەستاندنی کڕیار کارەکە لە پاشبنەما ئەنجام بدرێت.

---

## 💻 نموونەی کۆد (`SendInvoiceListener.php`)

```php
namespace App\Listeners;

use App\Events\CoursePurchasedEvent;
use App\Mail\InvoiceMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendInvoiceListener implements ShouldQueue
{
    public function handle(CoursePurchasedEvent $event): void
    {
        // ناردنی پسوڵەی کڕین بۆ ئیمەیڵی قوتابی لە پاشبنەمادا
        Mail::to($event->student->email)->send(
            new InvoiceMail($event->student, $event->course)
        );
    }
}
```

---

## 🎓 سەرچاوەی فێربوون
* 📖 [Laravel Documentation: Events & Listeners](https://laravel.com/docs/events)
