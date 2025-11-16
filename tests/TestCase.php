<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
use App\Enums\Role;

// abstract class TestCase extends BaseTestCase
// {
//     //
// }

// tests/TestCase.php はすべての Feature / Unit テストの親クラス
// このファイルに書けば、すべてのテストで使える

abstract class TestCase extends BaseTestCase
{
    // テスト用にAdminを共通化
    protected function createAdmin()
    {
        return User::factory()->create([
            'role' => Role::Admin,
        ]);
    }

    // Memberはデフォルトだがテスト用に明示
    protected function createMember(){
        return User::factory()->create([
            'role' => Role::Member,
        ]);
    }

    // Viewer（閲覧のみの方）
    protected function createViewer(){
        return User::factory()->create([
            'role' => Role::Viewer,
        ]);
    }
}
