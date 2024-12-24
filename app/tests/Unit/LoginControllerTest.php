<?php

namespace Tests\Unit;

use App\Http\Controllers\LoginController;
use App\Services\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mockery;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    protected $loginServiceMock;

    public function setUp(): void
    {
        parent::setUp();

        $this->loginServiceMock = Mockery::mock(LoginService::class);
        $this->app->instance(LoginService::class, $this->loginServiceMock);
        Route::get('/welcome', fn () => 'Welcome Page')->name('welcome');
    }

    /** @test */
    public function it_calls_login_method_on_login_service()
    {
        $this->loginServiceMock->shouldReceive('login')
            ->once()
            ->andReturn(redirect(route('welcome')));

        $controller = new LoginController();
        $response = $controller->login($this->loginServiceMock);

        $this->assertEquals(redirect(route('welcome')), $response);
    }

    /** @test */
    public function it_calls_authenticate_method_on_login_service_with_request()
    {
        $request = Request::create('/authenticate', 'POST', [
            'email' => 'user@example.com',
            'password' => 'password',
        ]);

        $this->loginServiceMock->shouldReceive('authenticate')
            ->once()
            ->with($request)
            ->andReturn(redirect(route('welcome')));

        $controller = new LoginController();
        $response = $controller->authenticate($this->loginServiceMock, $request);

        $this->assertEquals(redirect(route('welcome')), $response);
    }

    /** @test */
    public function it_calls_redirect_to_google_method_on_login_service()
    {
        $this->loginServiceMock->shouldReceive('redirectToGoogle')
            ->once()
            ->andReturn(redirect('https://accounts.google.com'));

        $controller = new LoginController();
        $response = $controller->redirectToGoogle($this->loginServiceMock);

        $this->assertEquals(redirect('https://accounts.google.com'), $response);
    }

    /** @test */
    public function it_calls_handle_google_callback_method_on_login_service()
    {
        $this->loginServiceMock->shouldReceive('handleGoogleCallback')
            ->once()
            ->andReturn(redirect(route('welcome')));

        $controller = new LoginController();
        $response = $controller->handleGoogleCallback($this->loginServiceMock);

        $this->assertEquals(redirect(route('welcome')), $response);
    }
}
