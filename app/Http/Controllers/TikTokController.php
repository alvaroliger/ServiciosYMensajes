<?php
namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class TikTokController extends Controller
{
    public function redirigirATiktok()
    {
        return Socialite::driver('tiktok')
        //Enrutamiento
            ->scopes(['user.info.basic'])
            ->redirect();
    }

    public function vincular()
    {
        $tiktokUser = Socialite::driver('tiktok')->user();

        if (!$tiktokUser) {
            return redirect()->route('profile.show')->with('error', 'Error al vincular cuenta TikTok.');
        }

        $user = Auth::user();

        $user->tiktok_id = $tiktokUser->getId();
        $user->tiktok_username = $tiktokUser->getNickname() ?? 'sin_nickname';
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Cuenta TikTok vinculada correctamente.');
    }
}

