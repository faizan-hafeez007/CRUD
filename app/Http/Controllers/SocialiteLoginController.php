<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Laravel\Socialite\Facades\Socialite;

class SocialiteLoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $socialiteUser = Socialite::driver('google')->user();

        $user = Product::firstOrCreate(
            [
                'email' => $socialiteUser->getEmail(),
            ],
            [
                'name' => $socialiteUser->getName(),
            ]
        );

        Product::firstOrCreate(
            [
                'user_id' => $user->id,
                'provider' => 'google',
            ],
            [
                'provider_id' => $socialiteUser->getId()
            ]
        );

        auth()->login($user);

        return redirect(route('dashboard'));
    }
}