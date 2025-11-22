<?php

namespace App\Policies;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Enums\Role;

// Policyは必要な権限だけを定義

class ThreadPolicy
{
    /**
     * Thread一覧ページを見ることができるか（全員可）
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [Role::Admin, Role::Member, Role::Viewer]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Thread $thread): bool
    {
        return false;
    }

    /**
     *Threadを新規作成できるか（Admin、Memberのみ）
     */
    public function create(User $user): bool
    {
        return in_array($user->role, [Role::Admin, Role::Member]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Thread $thread): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Thread $thread): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Thread $thread): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Thread $thread): bool
    {
        return false;
    }
}
