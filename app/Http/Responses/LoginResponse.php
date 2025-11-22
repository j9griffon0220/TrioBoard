<?php

namespace App\Http\Responses;
// namespace App\Actions\Fortify;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\Request;
use App\Enums\Role;

// viewerのみLoginするとDashboardに行かずにThread一覧画面に移動
// resources/views/livewire/auth/login.blade.php の方で制御するのでこちらは一旦見合わせ

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        dd($request->all())；
        dd($user->role)；
        // dd('LoginResponse called');
        $user = $request->user();
        if($user->role === Role::Viewer){
            return intended()->route('threads.index');
            // return redirect()->route('threads.index');
        }
        return redirect(config('fortify.home'));
    }
}

?>
