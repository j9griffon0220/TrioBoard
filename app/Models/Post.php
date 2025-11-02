<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Thread;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    // 代入を許可するカラム
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'thread_id',
        'is_edited',
    ];

    // リレーション（他のモデルとのつながり）
    // ポスト（投稿）には1人の作成したユーザーがいる
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ポスト（投稿）には所属するThreadが1つある
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
}
