<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    /** @use HasFactory<\Database\Factories\ThreadFactory> */
    use HasFactory;

    // 代入を許可するカラム
    protected $fillable = [
        'title',
        'user_id',
    ];

    // リレーション（他のモデルとのつながり）
    // スレッドには1人の作成したユーザーがいる
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // スレッドには複数の投稿がある
    public function posts()
    {
    return $this->hasMany(Post::class);
    }
}
