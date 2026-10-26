# 📧 ناردنی ئیمەیڵ — Mailables (`app/Mail`)

> **ئاستی پێویست:** ئاستی ناوەند (Mid-Level Developer - هەنگاوی ١٢)  
> **ئامانجی سەرەکی:** داڕشتن، ڕێکخستن و ناردنی ئیمەیڵ بە شێوازی پرۆفیشناڵ و جوان بۆ بەکارهێنەران.

---

## 📌 مەیڵ (Mailable) بە کوردییەکی زۆر سادە چییە؟

مەیڵ واتە: **نامەیەکی فەرمی بە دیزاینێکی جوان بۆ ناو ئیمەیڵی بەکارهێنەر.**  
لە پڕۆژەی لارافێڵدا، تۆ ناچیت کۆدی پیسی HTML لە ناو کۆنتڕۆڵەر بنووسیت و بە فرمانی سەرەتایی بینێریت؛ بەڵکو کڵاسێکی تایبەت لە ناو فۆڵدەری `app/Mail` دروست دەکەیت.  
ئەم کڵاسە بەرپرسە لە:
1. دیاریکردنی ناونیشانی ئیمەیڵەکە (Subject).
2. کێشکردنی داتای بەکارهێنەر (وەک ناوی کەسەکە، کۆدی دڵنیابوونەوە، یان فایلی PDFـی پسوڵە).
3. بەستنەوەی بە دیزاینێکی ڕێکی Blade.

---

## 🔄 نەخشەی چۆنیەتی دروستبوون و ناردنی ئیمەیڵ

```text
[ بەکارهێنەر داوای چالاککردن دەکات ]
                 │
                 ▼
     [ Controller / Job ]
                 │
                 ▼
       [ WelcomeMail Class ] ──► (داتاکان ڕێکدەخات لەگەڵ دیزاینی Blade)
                 │
                 ▼
   [ سێرڤەری ئیمەیڵ (Resend / Mailgun / SMTP) ]
                 │
                 ▼
       [ ئیمەیڵی کڕیار لە مۆبایلەکەی دەنگ دەدات ]
```

---

## 💻 نموونەی کۆد (`WelcomeMail.php`)

```php
namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user) {}

    /**
     * ناونیشان و نێرەری ئیمەیڵ
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'بەخێربێیت بۆ قوتابخانەی زیرەک!',
        );
    }

    /**
     * دیزاینی ناوەڕۆکی ئیمەیڵەکە لە فۆڵدەری views
     */
    public function content(): Content
    {
        return new Content(
            view: 'resources.views.emails.welcome',
        );
    }
}
```

---

## 🚀 چۆن ئیمەیڵەکە بنێرین لە کۆدەوە؟

```php
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

// ناردنی دەستبەجێ:
Mail::to($user->email)->send(new WelcomeMail($user));

// یان ناردن لە پاشبنەما (Queue) بەبێ ئەوەی بەکارهێنەر بوەستێت:
Mail::to($user->email)->queue(new WelcomeMail($user));
```

---

## 🎓 سەرچاوە فێرکارییە تایبەتەکان بۆ ئەم بابەتە

* 🎥 **Laracasts (فێربوونی ناردنی ئیمەیڵ):**  
  [Laracasts: Mailables from Scratch in Laravel](https://laracasts.com/series/laravel-30-days-to-learn-it/episodes/22)
* 📺 **فێرکاری ڤیدیۆیی یوتیوب:**  
  [YouTube: How to Send Emails in Laravel Step by Step](https://www.youtube.com/results?search_query=laravel+mailables+tutorial)
* 📖 **بەڵگەنامەی فەرمی لارافێڵ:**  
  [Laravel Docs: Mail](https://laravel.com/docs/mail)
