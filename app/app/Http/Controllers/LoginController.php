<?php

namespace App\Http\Controllers;

use App\Services\LoginService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function login(LoginService $service)
    {
        return $service->login();
    }

    public function authenticate (LoginService $service, Request $request)
    {
        return $service->authenticate($request);
    }

    public function redirectToGoogle(LoginService $service)
    {
        return $service->redirectToGoogle();
    }

    public function handleGoogleCallback(LoginService $service)
    {
        return $service->handleGoogleCallback();
    }
}
