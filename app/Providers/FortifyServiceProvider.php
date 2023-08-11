<?php

namespace App\Providers;

use Inertia\Inertia;
use App\Models\Customer;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use App\Http\Responses\RegisterResponse;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Controllers\RegisterController;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::verifyEmailView(function () {
            return Inertia::render('Auth/VerifyEmail');
        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = Customer::where('email', $request->username)->orWhere('phone', $request->username)->first();

            if (
                $user &&
                Hash::check($request->password, $user->password)
            ) {
                return $user;
            }
        });

        $this->app->singleton(RegisteredUserController::class, RegisterController::class);
        // $this->app->singleton(RegisterResponseContract::class, RegisterResponse::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;
            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}