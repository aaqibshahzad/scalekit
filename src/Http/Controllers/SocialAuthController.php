<?php

namespace AaqibShahzad\ScaleKit\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the provider's authentication page.
     *
     * @param  string  $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Obtain the user information from the provider.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $provider
     * @return \Illuminate\Http\JsonResponse
     */
    public function callback(Request $request, $provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        // Find or create user
        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? $socialUser->getEmail(),
                // create a random password - not used for social logins
                'password' => bcrypt(Str::random(24)),
            ]
        );

        // Optionally assign default role (if Spatie enabled)
        if (config('scalekit.roles.enabled')) {
            if (method_exists($user, 'assignRole')) {
                $user->assignRole(config('scalekit.default_role', 'user'));
            }
        }

        // Create a Sanctum token and return it
        $token = $user->createToken('scalekit-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user->only(['id', 'name', 'email'])
        ]);
    }
}