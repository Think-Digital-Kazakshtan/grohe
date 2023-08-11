<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Verification;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Rules\VerifyPhoneNumber;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

class RegisterController extends RegisteredUserController
{
    public function store(
        Request $request,
        CreatesNewUsers $creator
    ): RegisterResponse {
        $registration = $creator->create($request->all());
        if ($registration['type'] == 'email') {
            event(new Registered($registration['user']));
            $this->guard->login($registration['user']);
            notify('Регистрация успешно прошла. На ваш е-мейл адрес отправлено письмо для активации аккаунта.');
        } else {
            $verification = $registration['verification'];
            $verification->send();
            session()->put('verification', ['id' => $verification->id, 'phone' => $verification->phone, 'otp' => $verification->otp]);
            notify('На ваш номер телефона (' . $verification->phone . ') отправлен код активации аккаунта.');
        }
        return app(RegisterResponse::class);
    }

    public function verifyAndLogin(Request $request)
    {
        Validator::make($request->all(), [
            'otp' => ['required', 'numeric', new VerifyPhoneNumber],
        ])->validate();
        $session_verification = session()->get('verification');
        $otp = $request->only('otp');
        $phone = $session_verification['phone'];
        $verification = Verification::where('phone', $phone)->where('otp', $otp)->first();
        $customer = Customer::create(['name' => $verification->name, 'phone' => $verification->phone, 'password' => $verification->password, 'email' => null]);
        $this->guard->login($customer);
        session()->forget('verification');
        event(new Registered($customer));
        notify('Добро пожаловать ' . $customer->name . '!');
        $verification->delete();
        return redirect()->to(RouteServiceProvider::HOME);
    }

    public function sendOtpAgain(Request $request)
    {
        Validator::make($request->all(), [
            'id' => ['required', 'numeric', 'exists:verifications,id'],
        ])->validate();
        $verification = Verification::find($request->post('id'));
        $verification->otp = rand(1111, 9999);
        $verification->save();
        $verification->send();
        notify('На ваш номер телефона (' . $verification->phone . ') отправлен код активации аккаунта.');
        session()->forget('verification');
        session()->put('verification', ['id' => $verification->id, 'phone' => $verification->phone, 'otp' => $verification->otp]);
        return app(RegisterResponse::class);
    }
}