<!-- <?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\RedirectResponse;
use App\Enums\Role;

class FilamentLoginResponse implements LoginResponseContract
{
    public function toResponse($request): RedirectResponse
    {
        $user = auth()->user();

        if ($user->role === Role::Admin) {
            return redirect()->route('/admin');
        }

        if ($user->role === Role::Member) {
            return redirect()->route('/member');
        }

        if ($user->role === Role::Viewer) {
            return redirect()->route('threads.index');
        }

        return redirect()->route('home');
    }
}

?> -->
