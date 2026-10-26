# ⏳ ئەرکە پاشبنەماییەکان — Queue Jobs (`app/Jobs`)

> **ئاستی پێویست:** ئاستی پێشکەوتوو (Senior Developer - هەنگاوی ١٨)  
> **ئامانجی سەرەکی:** خێراکردنی وێبگەڕ و ئەنجامدانی کارە قورسەکان لە پاشبنەمای سێرڤەر (Background).

---

## 🖼️ وێنەی ڕێڕەوی کارکردن (Visual Workflow)

![Workflow Diagram](diagram.svg)


## 📌 جۆب (Job) بە کوردییەکی سادە چییە؟

جۆب واتە: **کارێک مەخەرە سەر شانی بەکارهێنەر کە کاتی پێوە بڕوات!**  
کاتێک مامۆستایەک فایلێکی Excel دادەنێت کە ناوی ٥،٠٠٠ قوتابی تێدایە و دەیەوێت بڕوانامەیان بۆ دروست بکات و ئیمەیڵیان بۆ بنێرێت؛ ئەگەر ئەم کارە ڕاستەوخۆ لەناو کۆنتڕۆڵەر ئەنجام بدرێت، لاپەڕەی وێبگەڕەکە ٥ خولەک دەسوڕێتەوە و لەوانەیە سێرڤەرەکە لەکار بکەوێت!

بەڵام چارەسەری **Senior** چییە؟  
کۆنتڕۆڵەر دەستبەجێ بە مامۆستاکە دەڵێت: «فایلەکەت وەرگیرا، دەتوانیت پەڕەکە دابخەیت». پاشان کارەکە دەخرێتە ناو فۆڵدەری **Jobs** و سێرڤەرەکە لە پاشبنەما (Queue) یەکە یەکە و لەسەرخۆ بەبێ وەستاندنی کەس کارەکان جێبەجێ دەکات.

---

## 🔄 نەخشەی چۆنیەتی کارکردنی Queue

```text
بەکارهێنەر دوگمە دادەگرێت
       │
       ▼
[ Controller ] ──► (کارەکە دەخاتە سەر ڕیز لە داتابەیس یان Redis) ──► پەیام دەگەڕێنێتەوە: «سەرکەوتوو بوو»
                                                                         (لە کەمتر لە ٠.١ چرکەدا!)
       │
       ▼ (لە پاشبنەمادا بە تەنها کار دەکات)
[ Queue Worker (Job) ] ──► دروستکردنی PDF ──► ناردنی ئیمەیڵ ──► نوێکردنەوەی داتابەیس
```

---

## 💻 نموونەی کۆد (`SendWelcomeEmailJob.php`)

```php
namespace App\Jobs;

use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public User $user)
    {
    }

    public function handle(): void
    {
        // ئەم کۆدە لە پاشبنەمادا کار دەکات بەبێ ئەوەی بەکارهێنەر بوەستێت
        Mail::to($this->user->email)->send(new WelcomeMail($this->user));
    }
}
```

---

## 🛠️ چۆن جۆبەکە ڕابکێشین لە کۆنتڕۆڵەر؟

```php
SendWelcomeEmailJob::dispatch($user);
```

---

## 🎓 سەرچاوە فێرکارییە تایبەتەکان بۆ ئەم بابەتە

* 🎥 **Laracasts (کۆرسی مەزنی کارپێکردنی ڕیز و جۆبەکان):**  
  [Laracasts: Laravel Queues Mastery](https://laracasts.com/series/laravel-queues-in-action)
* 📺 **فێرکاری ڤیدیۆیی یوتیوب:**  
  [YouTube: Laravel Queues and Jobs Crash Course](https://www.youtube.com/results?search_query=laravel+queues+jobs+tutorial)
* 📖 **بەڵگەنامەی فەرمی لارافێڵ:**  
  [Laravel Docs: Queues](https://laravel.com/docs/queues)
