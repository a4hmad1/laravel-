# 🎓 پڕۆژەی فێرکاری و نەخشەی تەلارسازی لارافێڵ (Laravel Architecture Masterclass)

بەخێربێن بۆ ئەم پڕۆژە فێرکارییە! ئەم پڕۆژەیە بە شێوازێکی تایبەت و زانستی دیزاین کراوە بۆ قوتابیان و پەرەپێدەران، تا لە ئاستی سەرەتاییەوە (**Junior**) دەستپێبکەن و بە هەنگاوی زانستی بگەنە ئاستی باڵا (**Senior Developer**).

هەر فۆڵدەرێک لە ناو ئەم پڕۆژەیەدا خاوەنی فایلی تایبەتی `README.md`ـی خۆیەتی لەگەڵ نموونەی کۆدی ڕاستەقینە، ڕێڕەوی کارکردن (Workflow)، و بەستەری فێرکاری.

---

## 🗺️ نەخشەی خوێندن: لە سەرەتاوە بۆ ئاستی پێشکەوتوو (Junior to Senior Roadmap)

بۆ ئەوەی فێرخواز بە شێوازێکی تەندروست فێری لارافێڵ بێت و سەرلێشێواو نەبێت، خوێندنی فۆڵدەرەکان بەم ڕیزبەندییە ٣ قۆناغییە پەیڕەو بکەن:

```
[قۆناغی ١: دەستپێک و بنەماکان (Junior)]
   │
   ├── 1. routes/                 (ڕێڕەوە سەرەکییەکان)
   ├── 2. app/Http/Controllers/   (کۆنتڕۆڵەرەکان)
   ├── 3. resources/views/        (ڕووکار بە مۆتۆڕی Blade)
   ├── 4. database/migrations/    (دروستکردنی خشتەکان)
   ├── 5. app/Models/             (مۆدێلەکان و Eloquent ORM)
   ├── 6. database/seeders/       (داتای سەرەتایی و تاقیکردنەوە)
   └── 7. app/Http/Requests/      (پشکنین و ڤالیدەیشنی داتاکان)
   │
   ▼
[قۆناغی ٢: ڕێکخستنی کۆد و پڕۆژەی ڕاستەقینە (Mid-Level)]
   │
   ├── 8.  app/Http/Middleware/   (فلتەرەکانی پاراستن و دۆخ)
   ├── 9.  app/Http/Resources/    (شێوازی ستانداردی API و JSON)
   ├── 10. app/Enums/             (بەها جێگیرە نەگۆڕەکان)
   ├── 11. app/Services/          (جیاکردنەوەی لۆجیکی ئاڵۆز لە کۆنتڕۆڵەر)
   ├── 12. app/Mail/ & Notifications/ (ناردنی ئیمەیڵ و ئاگادارکردنەوە)
   ├── 13. tests/                 (تاقیکردنەوەی خۆکار بە PHPUnit)
   ├── 14. app/Rules/             (یاسای تایبەت بۆ ڤالیدەیشن)
   └── 15. app/View/Components/   (کۆمپۆنێنتە دووبارەبووەکانی دیزاین)
   │
   ▼
[قۆناغی ٣: تەلارسازی پێشکەوتوو و بەڕێوەبردنی سێرڤەر (Senior)]
   │
   ├── 16. app/Actions/           (تەلارسازی کڵاسی تاک ئەرک - Single Action)
   ├── 17. app/DTOs/              (گواستنەوەی داتای پێکهاتەدار - Typesafe Data)
   ├── 18. app/Jobs/              (ئەرکە پاشبنەماییەکان بە Queue)
   ├── 19. app/Events/ & Listeners/ (سیستەمی کارکردن بەپێی ڕووداوەکان)
   ├── 20. app/Policies/ & Observers/ (دەسەڵاتەکان و چاودێری مۆدێل)
   ├── 21. app/Contracts/         (جێبەجێکردنی بنەماکانی SOLID و Interface)
   ├── 22. app/Repositories/     (دابڕینی داتابەیس لە لۆجیک)
   ├── 23. app/Broadcasting/      (پەخشی ڕاستەوخۆ بە WebSockets)
   ├── 24. app/Casts/ & Scopes/   (تایبەتمەندییە قووڵەکانی Eloquent)
   ├── 25. app/Console/Commands/  (فەرمانەکانی Artisan و Task Scheduling)
   └── 26. app/Providers/ & Exceptions/ (کڕۆکی لارافێڵ و Service Container)
```

---

## 📂 نەخشەی تەواوی فۆڵدەرەکانی پڕۆژەکە (Interactive Directory Tree)

کلیك لەسەر هەر فۆڵدەرێک بکە بۆ خوێندنەوەی بەڵگەنامە و کورتە کۆرسەکەی:

* 📁 [**`app/`**](app) - کۆدی سەرەکی ئەپڵیکەیشن
  * 🌐 **HTTP**:
    * 🎮 [Controllers](app/Http/Controllers) - کۆنتڕۆڵەری داواکارییەکان
    * 📝 [Requests](app/Http/Requests) - ڤالیدەیشنی فۆڕمەکان
    * 📦 [Resources](app/Http/Resources) - گۆڕینی داتا بۆ API
    * 🛡️ [Middleware](app/Http/Middleware) - فلتەری پاراستن و دۆخ
    * 📤 [Responses](app/Http/Responses) - وەڵامدانەوە پێوانەییەکان
  * 🗄️ **Database & Models**:
    * 📄 [Models](app/Models) - مۆدێلەکان و پەیوەندییەکان
    * 🔍 [Scopes](app/Models/Scopes) - فلتەری ئامادەکراوی کوێری
    * 🎭 [Casts](app/Casts) - گۆڕینی تایپی داتای ستوونەکان
  * ⚙️ **Business Logic & Architecture**:
    * 💼 [Services](app/Services) - لۆجیکی ئاڵۆزی پڕۆژەکە
    * ⚡ [Actions](app/Actions) - کڵاسی تاک ئەرک
    * 🏛️ [Repositories](app/Repositories) - چینی دەرهێنانی داتا
    * 🚚 [DTOs](app/DTOs) - ئۆبجێکتی گواستنەوەی داتا
    * 🏷️ [Enums](app/Enums) - بەها نەگۆڕەکان
    * 📋 [Contracts](app/Contracts) - ئینتەرفەیسەکان
    * 🧬 [Traits](app/Traits) - کۆدی هاوبەشی کڵاسەکان
  * ⚡ **Queues & Events**:
    * ⏳ [Jobs](app/Jobs) - ڕیزی ئەرکە قورسەکان
    * 📢 [Events](app/Events) - ڕووداوەکان
    * 👂 [Listeners](app/Listeners) - گوێگر و جێبەجێکاری ڕووداو
    * 📡 [Broadcasting](app/Broadcasting) - پەخشی ڕاستەوخۆ
  * 🔒 **Security & Quality**:
    * 👮 [Policies](app/Policies) - دەسەڵات و ڕێگەپێدان
    * ✅ [Rules](app/Rules) - یاسای تایبەتی پشکنین
    * 👀 [Observers](app/Observers) - چاودێری گۆڕانکاری مۆدێل
  * ✉️ **Communications**:
    * 📧 [Mail](app/Mail) - ناردنی ئیمەیڵ
    * 🔔 [Notifications](app/Notifications) - ئاگادارکردنەوەکان
  * 🖥️ **System**:
    * ⌨️ [Console/Commands](app/Console/Commands) - فەرمانەکانی تێرمیناڵ
    * ⚠️ [Exceptions](app/Exceptions) - بەڕێوەبردنی هەڵەکان
    * 🔌 [Providers](app/Providers) - بەستنەوەی خزمەتگوزارییەکان
    * 🧩 [View Components](app/View/Components) - پێکهاتەکانی ڕووکار
    * 🛠️ [Helpers](app/Helpers) - فەنکشنە یارمەتیدەرەکان

* 📁 [**`routes/`**](routes) - ڕێڕەوەکانی وێب و API
* 📁 [**`database/`**](database) - مایگرەیشن، فاکتۆری و سیدەرەکان
  * 🏗️ [Migrations](database/migrations)
  * 🏭 [Factories](database/factories)
  * 🌱 [Seeders](database/seeders)
* 📁 [**`resources/`**](resources) - دیزاین و فرۆنتێند
  * 🎨 [Views (Blade)](resources/views)
  * ⚡ [JavaScript & Assets](resources/js)
* 📁 [**`tests/`**](tests) - تاقیکردنەوەی خۆکار بە PHPUnit
* 📁 [**`storage/`**](storage) - کۆگای فایل و لۆگەکان
* 📁 [**`config/`**](config) - ڕێکخستنە گشتییەکانی سیستەم

---

## 🔗 سەرچاوە فێرکارییە گرنگەکان بۆ فێرخوازان (Learning Resources)

* 📖 [بەڵگەنامەی فەرمی لارافێڵ (Laravel Documentation)](https://laravel.com/docs)
* 🎥 [ماڵپەڕی فێرکاری فەرمی Laracasts](https://laracasts.com)
* 📺 [کۆرسی تەواوی لارافێڵ لەسەر YouTube (FreeCodeCamp)](https://www.youtube.com/watch?v=MYyJ4PuL4pY)
* 💡 [کۆرسی فەرمی دروستکردنی ئەپ بە لارافێڵ لە سەرەتاوە (Laravel Bootcamp)](https://bootcamp.laravel.com)
