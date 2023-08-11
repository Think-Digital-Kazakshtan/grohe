<?php

namespace App\Rules;

use Closure;
use App\Models\Verification;
use Illuminate\Contracts\Validation\ValidationRule;

class VerifyPhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (
            !session()->has('verification')
            || session()->get('verification') == null
            || Verification::where('phone', session()->get('verification')['phone'])->where('otp', $value)->doesntExist()
        ) {
            $fail('validation.otp_invalid')->translate();
        }
    }
}