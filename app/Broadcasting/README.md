# 📡 پەخشی ڕاستەوخۆ — Broadcasting (`app/Broadcasting`)

> **ئاستی پێویست:** ئاستی پێشکەوتوو (Senior Developer - هەنگاوی ٢٣)  
> **ئامانجی سەرەکی:** ناردنی داتا و پەیامەکان بە شێوازی ڕاستەوخۆ (Real-time WebSockets) بەبێ پێویستی ڕیفریشکردنی پەڕەی وێبگەڕ.

---

## 📌 پەخشی ڕاستەوخۆ بە کوردییەکی زۆر سادە چییە؟

پەخشی ڕاستەوخۆ وەکو **بێتەل یان پەخشی تەلەڤزیۆنی ڕاستەوخۆ** وایە!  
لە ماڵپەڕی ئاساییدا، کاتێک کەسێک نامەیەکت بۆ دەنێرێت لە چاتدا، تا تۆ لاپەڕەکە ڕیفریش (Refresh) نەکەیتەوە، نامەکە نابینیت! ئەمەش زۆر ناخۆش و کۆنە.

بەڵام کاتێک **Broadcasting و WebSockets** بەکاردەهێنیت:
* پەیوەندییەکی هەمیشەیی کراوە لە نێوان وێبگەڕی بەکارهێنەر و سێرڤەرەکە دروست دەبێت.
* هەر کاتێک کڕیارێک نامەیەک نارد یان نۆتیفیکەیشنێک هات، سێرڤەر وەک بڵندگۆ (Broadcast) دەستبەجێ بەبێ هیچ ڕیفریشێک پەیامەکە دەخاتە سەر شاشەی کڕیارەکە (وەک چاتی واتسئاپ و تێلێگرام).

فۆڵدەری `app/Broadcasting` شوێنی ئەو کەناڵانەیە (Channel Classes) کە بڕیار دەدەن کێ بۆی هەیە گوێ لە کام پەخش بگرێت (بۆ نموونە: تەنها بەکارهێنەر بۆی هەیە گوێ لە پەخشی تایبەتی نۆتیفیکەیشنی خۆی بگرێت).

---

## 🔄 نەخشەی کارکردنی پەخشی ڕاستەوخۆ (Real-time Flow)

```text
[ بەکارهێنەری A پەیام دەنێرێت ]
               │
               ▼
      [ سێرڤەری لارافێڵ ] 
               │
      (Event Broadcast دەکرێت)
               ▼
[ بزوێنەری WebSocket (Laravel Reverb / Pusher) ]
               │
               ▼  (بە کەمتر لە ٠.٠١ چرکەدا دەگات)
[ وێبگەڕی بەکارهێنەری B (نامەکە لە شاشە دەردەکەوێت بەبێ ڕیفریش) ]
```

---

## 💻 نموونەی کڵاسی کەناڵ (`OrderChannel.php`)

```php
namespace App\Broadcasting;

use App\Models\Order;
use App\Models\User;

class OrderChannel
{
    /**
     * ئایا ئەم بەکارهێنەرە بۆی هەیە گوێ لەم کەناڵە بگرێت؟
     */
    public function join(User $user, Order $order): bool
    {
        // تەنها خاوەنی داواکارییەکە بۆی هەیە گوێ لە کەناڵی داواکارییەکەی بگرێت
        return $user->id === $order->user_id;
    }
}
```

---

## 🚀 چۆن لە ڕێگەی Event پەخشی بکەین؟

لە ناو کڵاسی ڕووداو (Event)، تەنها وشەی `implements ShouldBroadcast` زیاد دەکەیت:

```php
namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\PrivateChannel;

class NewMessageEvent implements ShouldBroadcast
{
    public function __construct(public string $message, public int $userId) {}

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('user.' . $this->userId);
    }
}
```

---

## 🎓 سەرچاوە فێرکارییە تایبەتەکان بۆ ئەم بابەتە

* 🎥 **Laracasts (کۆرسی مەزنی پەخشی ڕاستەوخۆ بە Laravel Reverb):**  
  [Laracasts: Real-Time Laravel with Reverb](https://laracasts.com/series/real-time-laravel-with-reverb)
* 📺 **فێرکاری ڤیدیۆیی یوتیوب:**  
  [YouTube: Laravel Realtime Broadcasting Full Tutorial Step by Step](https://www.youtube.com/results?search_query=laravel+reverb+broadcasting+tutorial)
* 📖 **بەڵگەنامەی فەرمی لارافێڵ:**  
  [Laravel Docs: Broadcasting](https://laravel.com/docs/broadcasting)
