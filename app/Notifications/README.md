# 🔔 ئاگادارکردنەوەکان — Notifications (`app/Notifications`)

> **ئاستی پێویست:** ئاستی ناوەند (Mid-Level Developer - هەنگاوی ١٢)  
> **ئامانجی سەرەکی:** ناردنی یەک ئاگاداری بۆ چەند کەناڵێکی جیاواز لە یەک کاتدا (ئیمەیڵ، کورتەنامەی مۆبایل، داتابەیس).

---

## 📌 نۆتیفیکەیشن بە کوردییەکی زۆر سادە چییە؟

نۆتیفیکەیشن واتە: **«ئاگەدارکردنەوەی فرە-کەناڵ»!**  
جیاوازی نێوان `Mail` و `Notification`:
* فۆڵدەری `Mail` **تەنها بۆ ئیمەیڵە**.
* بەڵام فۆڵدەری `Notifications` دەتوانێت بە یەک فەرمان:
  1. ئیمەیڵێک بۆ قوتابی بنێرێت.
  2. کورتەنامەیەک (SMS) بۆ مۆبایلەکەی بنێرێت.
  3. زەنگۆڵەی نۆتیفیکەیشنی ناو ماڵپەڕەکە پڕ بکاتەوە لە داتابەیس.
  4. پەیامێکیش بۆ کەناڵی ستافی مامۆستایان بنێرێت لەناو Slack یان Discord!

---

## 💻 نموونەی کۆد (`CourseApprovedNotification.php`)

```php
namespace App\Notifications;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseApprovedNotification extends Notification
{
    use Queueable;

    public function __construct(public Course $course) {}

    /**
     * کام کەناڵانە بەکاربهێنرێن؟ (ئیمەیڵ + زەنگۆڵەی داتابەیس)
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * شێوازی ئیمەیڵەکە
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('کۆرسەکەت پەسەندکرا!')
            ->line("پیرۆزە، کۆرسی '{$this->course->title}' لەلایەن کارگێڕییەوە پەسەند کرا.")
            ->action('بینینی کۆرس', url('/courses/' . $this->course->id));
    }

    /**
     * داتایەک کە لە خشتەی داتابەیس پاشەکەوت دەبێت
     */
    public function toArray(object $notifiable): array
    {
        return [
            'course_id' => $this->course->id,
            'title'     => $this->course->title,
            'message'   => 'کۆرسەکەت بە سەرکەوتوویی بڵاوکرایەوە.',
        ];
    }
}
```

---

## 🚀 چۆن ئاگادارییەکە بۆ بەکارهێنەر بنێرین؟

```php
$user->notify(new CourseApprovedNotification($course));
```

---

## 🎓 سەرچاوە فێرکارییە تایبەتەکان بۆ ئەم بابەتە

* 🎥 **Laracasts (کۆرسی نۆتیفیکەیشن):**  
  [Laracasts: Laravel Notifications System](https://laracasts.com/series/laravel-30-days-to-learn-it/episodes/23)
* 📺 **فێرکاری ڤیدیۆیی یوتیوب:**  
  [YouTube: Laravel Notifications Full Tutorial Database & Mail](https://www.youtube.com/results?search_query=laravel+notifications+tutorial)
* 📖 **بەڵگەنامەی فەرمی لارافێڵ:**  
  [Laravel Docs: Notifications](https://laravel.com/docs/notifications)
