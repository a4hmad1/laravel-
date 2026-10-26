# 📝 فۆڕم ڕیکوێست — Form Requests (`app/Http/Requests`)

> **ئاستی پێویست:** ئاستی سەرەتایی بۆ ناوەند (Junior to Mid-Level)  
> **ئامانجی سەرەکی:** پشکنین، خاوێنکردنەوە و پاراستنی داتای فۆڕمەکان (Data Validation & Security).

---

## 📌 فۆڕم ڕیکوێست بە کوردییەکی سادە چییە؟

فۆڕم ڕیکوێست وەکو **پاسەوانی بەردەرگای فەرمانگەیەک** وایە!  
پێش ئەوەی هاوڵاتییەکە بچێتە لای بەڕێوەبەر (کۆنتڕۆڵەر)، پاسەوانەکە تەماشای فۆڕمەکەی دەکات:
* ئایا ناسنامەی پێیە؟ (Required)
* ئایا ئیمەیڵەکەی دروست نووسیوە؟ (Valid Email)
* ئایا وشەی تێپەڕەکەی کەمتر نییە لە ٨ پیت؟ (Min 8 Characters)

ئەگەر فۆڕمەکە کەموکوڕی تێدابوو، بەڕێوەبەر هیچ کات بەفیڕۆ نادات؛ پاسەوانەکە لە بەردەرگا بەکارهێنەر دەگەڕێنێتەوە و پێی دەڵێت فڵانە خانەت بە هەڵە پڕکردووەتەوە!

---

## 🔄 نەخشەی چۆنیەتی پشکنینی داتا (Validation Flow)

```text
[ کڕیار فۆڕمێک پڕدەکاتەوە ]
           │
           ▼
[ FormRequest پشکنین دەکات ]
     ├── ❌ ئەگەر هەڵەی تێدابوو ──► دەستبەجێ دەگەڕێتەوە بۆ سەر فۆڕمەکە لەگەڵ پەیامی هەڵە
     │
     └── ✅ ئەگەر هەمووی دروست بوو ──► ڕێگەی پێدەدات بچێتە ناو Controller Method
```

---

## 💻 نموونەی کۆد (`StoreStudentRequest.php`)

```php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * دیاریکردنی ئەوەی ئایا ئەم بەکارهێنەرە ڕێگەی پێدراوە ئەم کارە بکات
     */
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * یاساکانی پشکنینی داتا (Validation Rules)
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'min:3', 'max:100'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'phone'    => ['required', 'regex:/^07[0-9]{9}$/'], // شێوازی ژمارەی عێراق/کوردستان
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * پەیامی هەڵە بە زمانی کوردی
     */
    public function messages(): array
    {
        return [
            'name.required'     => 'تکایە ناوی چواری قوتابی بنووسە.',
            'email.unique'      => 'ئەم ئیمەیڵە پێشتر بەکارهاتووە.',
            'password.min'      => 'وشەی تێپەڕ نابێت لە ٨ پیت کەمتر بێت.',
        ];
    }
}
```

---

## 🛠️ چۆن فایلی نوێ دروست بکەین بە تێرمیناڵ؟

```bash
php artisan make:request StoreStudentRequest
```

---

## 🎓 سەرچاوە فێرکارییە تایبەتەکان بۆ ئەم بابەتە

* 🎥 **Laracasts (کۆرسی پشکنینی فۆڕم):**  
  [Laracasts: Dedicated Form Request Validation](https://laracasts.com/series/laravel-30-days-to-learn-it/episodes/18)
* 📺 **فێرکاری ڤیدیۆیی لە یوتیوب:**  
  [YouTube: Laravel Form Request Validation Tutorial](https://www.youtube.com/results?search_query=laravel+form+request+validation)
* 📖 **بەڵگەنامەی فەرمی لارافێڵ:**  
  [Laravel Documentation: Validation](https://laravel.com/docs/validation#form-request-validation)
