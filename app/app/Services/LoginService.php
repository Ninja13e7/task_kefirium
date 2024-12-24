<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;


class LoginService
{
    /**
     * Метод проверки авторизованных пользователей
     *
     * @return RedirectResponse|View
     */
    public function login(): RedirectResponse|View
    {
        if (Auth::viaRemember()) {
            return redirect(route('welcome'));
        }

        return view('auth.login');
    }

    /**
     * Метод авторизации
     *
     * @param Request $request класс запроса
     * @return RedirectResponse
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return back()->withErrors([
                'email' => 'Пользователь не найден',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect(route('welcome'));
    }

    /**
     * Метод перенаправления пользователя в форму авторизации Google
     *
     * @return RedirectResponse
     */
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Метод обрабатывает обратный вызов от Google OAuth.
     *
     * @return RedirectResponse
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(uniqid()),
                'remember_token'=> Str::random(10)
            ]
        );

        Auth::login($user);

        return redirect()->route('welcome');
    }
}
