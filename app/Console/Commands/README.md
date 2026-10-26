# ⌨️ فەرمانەکانی تێرمیناڵ — Artisan Commands (`app/Console/Commands`)

> **ئاستی پێویست:** ئاستی پێشکەوتوو (Senior Developer - هەنگاوی ٢٥)  
> **ئامانجی سەرەکی:** دروستکردنی فەرمانی نوێ بۆ ناو تێرمیناڵ و کارپێکردنی ئۆتۆماتیکی لە ڕێگەی سێرڤەرەوە (Cron Jobs / Task Scheduler).

---

## 🖼️ وێنەی ڕێڕەوی کارکردن (Visual Workflow)

![Workflow Diagram](diagram.svg)


## 📌 فەرمانی تێرمیناڵ بە کوردییەکی سادە چییە؟

فەرمانی ئارتیزان واتە: **دروستکردنی دەستی جادووی بۆ سێرڤەرەکەت!**  
ڕۆژانە هەندێک کار هەیە کە ناکرێت بە وێبگەڕ بکرێت، وەک:
* هەموو شەوێک کاتژمێر ١٢:٠٠ی شەو، ئەژماری ئەو کەسانە چالاک بکەرەوە کە قەرزەکانیان داوە.
* هەموو سەرەتای مانگێک، ئۆتۆماتیکی پشکنین بکە بۆ ئەو کۆرسانەی ماوەیان بەسەرچووە و ئاگادارییان بۆ بنێرە.

کڵاسەکانی ناو ئەم فۆڵدەرە دەتوانیت بە دەست لە تێرمیناڵ لێیان بدەیت (وەک `php artisan students:remind`)، یان بیاندەیتە دەست سێرڤەر تا بە شێوەیەکی خۆکار هەموو شەوێک بە بێدەنگی جێبەجێیان بکات!

---

## 💻 نموونەی کۆد (`SendExamReminderCommand.php`)

```php
namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SendExamReminderCommand extends Command
{
    /**
     * ناوی فەرمانەکە لە ناو تێرمیناڵ
     */
    protected $signature = 'students:exam-reminder';

    /**
     * ڕوونکردنەوەی فەرمانەکە کاتێک لیست دەکرێت
     */
    protected $description = 'ناردنی ئاگاداری تاقیکردنەوە بۆ قوتابیان';

    public function handle(): int
    {
        $this->info('دەستکرا بە ناردنی ئاگادارییەکان...');

        // کۆدی ناردنی نامەکان...
        $this->info('هەموو ئاگادارییەکان بە سەرکەوتوویی نێردران!');

        return Command::SUCCESS;
    }
}
```

---

## 🎓 سەرچاوەی فێربوون
* 📖 [Laravel Docs: Artisan Console](https://laravel.com/docs/artisan)
* 🎥 [Laracasts: Scheduling Tasks with Artisan Commands](https://laracasts.com/series/laravel-30-days-to-learn-it/episodes/25)
