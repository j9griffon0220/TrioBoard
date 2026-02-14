<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\Role;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\MemberSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // adminとviewerは本番でも必要なユーザー

        // admin（管理者）を固定で作る
        User::updateOrCreate(
            // 初めの[]は検索条件
            ['email' => config('admin.email')],
            // 次の[]は更新 or 作成する内容
            ['name' => 'admin',
            'password' => Hash::make(config('admin.password')),
            'role' => Role::Admin->value,
            ]
        );

        // viewer（閲覧者）を固定でつくる
        // 後でviewerをOFFにしたいときはDBでfalseにする
        User::updateOrCreate(
            // 初めの[]は検索条件
            ['email' => config('viewer.email')],
            // 次の[]は更新 or 作成する内容
            ['name' => 'viewer',
            'password' => Hash::make(config('viewer.password')),
            'role' => Role::Viewer->value,
            'is_active' => true,
            ]
        );

        // ローカル時のみMemberSeederを実行
        if(app()->environment('local')){
            $this->call(MemberSeeder::class);
        }

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
