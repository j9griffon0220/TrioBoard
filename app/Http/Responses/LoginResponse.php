<?php

namespace App\Http\Responses;
// namespace App\Actions\Fortify;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\Request;
use App\Enums\Role;


class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        // dd($request->all())；
        // dd($user->role)；
        // dd('LoginResponse called');
        $user = $request->user();
        if($user->role === Role::Viewer){
            return intended()->route('threads.index');
            // return redirect()->route('threads.index');
        }
        return redirect(config('fortify.home'));
    }
}

    // if ($user->role === Role::Admin) {
    // // admin（管理者）はadmin専用ダッシュボードへ。'filament.admin.auth.login'のルート名NG
    // $this->redirect(route('filament.admin.pages.dashboard'));
    // } elseif ($user->role === Role::Member) {
    // // memberはメンバー用管理画面へ
    // $this->redirect(route('filament.member.pages.dashboard'));
    // } elseif ($user->role === Role::Viewer) {
    // // viewerは管理画面に行かずに閲覧のみのためスレッド一覧へ
    // $this->redirect(route('threads.index'));
    // }



// viewerのみLoginするとDashboardに行かずにThread一覧画面に移動
// Fortify用・viewer用制御
// resources/views/livewire/auth/login.blade.php の方で制御するのでこちらは一旦見合わせ

// class LoginResponse implements LoginResponseContract
// {
//     public function toResponse($request)
//     {
//         // dd($request->all())；
//         // dd($user->role)；
//         // dd('LoginResponse called');
//         $user = $request->user();
//         if($user->role === Role::Viewer){
//             return intended()->route('threads.index');
//             // return redirect()->route('threads.index');
//         }
//         return redirect(config('fortify.home'));
//     }
// }

?>
