<?php

namespace App\Actions\Fortify;

use App\Models\Customer;
use App\Models\Verification;
use App\Rules\EmailOrPhone;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): mixed
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', new EmailOrPhone, 'max:255', 'unique:customers,email', 'unique:customers,phone'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $data = [
            'name' => $input['name'],
            'phone' => null,
            'email' => null,
            'password' => Hash::make($input['password']),
        ];
        if (is_phone_number($input['username'])) {
            $data['phone'] = $input['username'];
            Verification::where('phone', $data['phone'])->delete();
            $verification = Verification::create([
                'otp' => rand(1111, 9999),
                'name' => $data['name'],
                'phone' => $data['phone'],
                'type' => 'phone',
                'password' => $data['password']
            ]);
            return ['type' => 'phone', 'verification' => $verification];
        } else {
            $data['email'] = $input['username'];
            $user = Customer::create($data);
            return ['type' => 'email', 'user' => $user];
        }
    }
}