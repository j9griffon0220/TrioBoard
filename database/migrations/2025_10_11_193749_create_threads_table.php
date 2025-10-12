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
        Schema::create('threads', function (Blueprint $table) {
            $table->id(); // 主キー
            $table->string('title'); //スレッドタイトル
            $table->foreignId('user_id')
            ->constrained('users')
            ->cascadeOnDelete(); // users削除時、threadsも削除
            $table->timestamps(); // created_at と updated_at を自動追加
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // dropIfExists がテーブルと外部キーをまとめて削除
        Schema::dropIfExists('threads');
    }
};
