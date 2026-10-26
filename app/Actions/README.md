# ⚡ Actions (`app/Actions`)

> **ئاستی فێربوون**: 🔴 Senior (هەنگاوی ١٦)

## 📌 ئەم فۆڵدەرە چییە؟
کڵاسەکانی Action پەیڕەوی پرەنسیپی "تەنها یەک ئەرک" (Single Responsibility Principle) دەکەن. هەر Action تەنها یەک کرداری دیاریکراو ئەنجام دەدات (وەک `CreateUserAction`, `CancelOrderAction`).

---

## 💻 نموونەی کۆد

```php
namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateNewUser
{
    public function execute(array $data): User
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
```
