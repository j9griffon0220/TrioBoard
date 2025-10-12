<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // 主キー
            $table->string('title'); // 投稿タイトル
            $table->text('body'); // 投稿本文

            $table->foreignId('user_id') // 投稿者
            ->constrained('users')
            ->cascadeOnDelete(); // 親ユーザー削除時、投稿も削除

            $table->foreignId('thread_id') // 所属スレッド
            ->constrained('threads')
            ->cascadeOnDelete(); // 親テーブル削除時、関連投稿も削除

            $table->boolean('is_edited')->default(false); //編集済みフラグ
            $table->softDeletes(); //削除済みフラグ（deleted_at）

            $table->timestamps(); // created_at と updated_at を自動追加
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // dropIfExists がテーブルと外部キーをまとめて削除
        Schema::dropIfExists('posts');
    }
};
