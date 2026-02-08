<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Enums\Role;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * ローカル専用データ
     * DatabaseSeederの方で使う使わないを切り替え
     */
    public function run(): void
    {
        // memberを作る
        User::updateOrCreate(
        // 初めの[]は検索条件
        ['email' => 'member@example.com'],
        // 次の[]は更新 or 作成する内容
        ['name' => 'member',
        'password' => Hash::make(config('member')),
        'role' => Role::Member->value,
        ]
    );

        // ダミーデータ2名をランダムに生成
        User::factory()
        ->count(2)
        ->hasThreads(2)
        ->hasPosts(1)
        ->create();

    }
}

