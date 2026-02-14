<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Enums\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Thread;
use App\Models\Post;

class MemberSeeder extends Seeder
{
    /**
     * ローカル専用データ
     * DatabaseSeederの方で使う使わないを切り替え
     */
    public function run(): void
    {
        // member不在デバッグ
        // dd('PostFactory called');

        // memberを作る
        $members = [
        [
            'name' => 'member1',
            'email' => 'member1@example.com',
            'password' => 'password1',
        ],
        [
            'name' => 'member2',
            'email' => 'member2@example.com',
            'password' => 'password2',
        ],
    ];

    foreach($members as $member){
        User::updateOrCreate(
            ['email' => $member['email']],
            [
                'name' => $member['name'],
                'password' => Hash::make($member['password']),
                'role' => Role::Member->value,
                'is_active' => true,
            ]
        );
    }

    //     // memberを作る
    //     User::updateOrCreate(
    //     // 初めの[]は検索条件
    //     ['email' => 'member@example.com'],
    //     // 次の[]は更新 or 作成する内容
    //     ['name' => 'member',
    //     'password' => Hash::make(config('member.password')),
    //     'role' => Role::Member->value,
    //     ]
    // );
    //     User::factory()
    //     ->state(['role' => Role::Member->value])
    //     ->count(2)
    //     ->has(
    //         Thread::factory()
    //         ->count(1)
    //         ->has(Post::factory()->count(1))
    //     )
    //     ->create();
    }
}

