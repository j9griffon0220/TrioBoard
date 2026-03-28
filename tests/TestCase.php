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
    protected function createRoleAdmin()
    {
        return User::factory()->create([
            'role' => Role::Admin,
        ]);
    }

    // Memberはデフォルトだがテスト用に明示
    protected function createRoleMember()
    {
        return User::factory()->create([
            'role' => Role::Member,
        ]);
    }

    // Viewer（閲覧のみの方）
    protected function createRoleViewer()
    {
        return User::factory()->create([
            'role' => Role::Viewer,
        ]);
    }

    // 未ログインユーザー（その他の人）は作らない！
    // User::factory()->create([...]) を呼ぶと 必ずユーザーがDBに作成される
    // → つまり「存在するユーザー」になってしまう


    // 共通アサーション

    // 403 Forbidden（アクセスできない）の結果をまとめる
    // GET専用（可読性を優先して分ける）
    protected function assertGetForbidden($user, string $uri)
    {
        $response = $this->actingAs($user)->get($uri);
        $response->assertStatus(403);
    }

    // POST専用
    protected function assertPostForbidden($user, string $uri, array $data = [])
    {
        $response = $this->actingAs($user)->post($uri, $data);
        $response->assertStatus(403);
    }
}
