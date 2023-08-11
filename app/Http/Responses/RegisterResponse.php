<?php
namespace App\Http\Responses;

use Laravel\Fortify\Fortify;
use \Laravel\Fortify\Http\Responses\RegisterResponse as RegisterResponseContract;

class RegisterResponse extends RegisterResponseContract
{

	public function toResponse($request)
	{
		return redirect()->intended(Fortify::redirects('register'));
	}
}