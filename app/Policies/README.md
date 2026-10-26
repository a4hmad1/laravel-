# 👮 Policies (`app/Policies`)

> **ئاستی فێربوون**: 🔴 Senior (هەنگاوی ٢٠)

## 📌 ئەم فۆڵدەرە چییە؟
بۆ کۆنتڕۆڵکردنی دەسەڵات (Authorization) لەسەر مۆدێلەکان؛ کێ بۆی هەیە پۆستێک دەستکاری بکات یان بیسڕێتەوە؟

```php
public function update(User $user, Post $post): bool
{
    return $user->id === $post->user_id;
}
```
