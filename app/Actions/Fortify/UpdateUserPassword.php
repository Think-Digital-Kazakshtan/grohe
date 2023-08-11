<?php

namespace App\Actions\Fortify;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update(Customer $user, array $input)
    {
        Validator::make($input, [
            'current_password' => ['required', 'string', 'current_password:customer'],
            'password' => $this->passwordRules(),
        ], [
            'current_password.current_password' => __('Неверный текущий пароль.'),
        ])->validateWithBag('updatePassword');

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();

        notify('Пароль успешно изменен');
        return redirect()->back();
    }
}
