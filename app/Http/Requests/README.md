# 📝 Form Requests (`app/Http/Requests`)

> **ئاستی فێربوون**: 🟢 Junior (دەستپێک - هەنگاوی ٧)

## 📌 ئەم فۆڵدەرە چییە؟
کڵاسەکانی Form Request تایبەتن بە **پشکنین و پاراستنی داتای هاتووی فۆڕمەکان (Validation)** پێش ئەوەی کۆنتڕۆڵەر دەستی لێبدات. ئەگەر داتاکە هەڵە بێت، لارافێڵ دەستبەجێ بەکارهێنەر دەگەڕێنێتەوە لەگەڵ پەیامی هەڵە و ناڕواتە سەر کۆنتڕۆڵەر.

---

## 🔄 چۆنیەتی کارکردن (Workflow)

```
Form Submission (POST/PUT)
       │
       ▼
[FormRequest Validation] 
   ├── ❌ هەڵەیە ──► گەڕانەوە بۆ فۆڕم لەگەڵ پەیامی هەڵە (Errors)
   └── ✅ دروستە ──► چوونەژوورەوە بۆ ناو Controller Method
```

---

## 💻 نموونەی کۆد

```php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
```

---

## 🔗 سەرچاوەی فێربوون
* 📖 [Laravel Docs - Form Request Validation](https://laravel.com/docs/validation#form-request-validation)
* 🎥 [Laracasts - Dedicated Form Request Validation](https://laracasts.com)
