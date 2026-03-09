<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
  public function toResponse($request)
{
    $user = auth()->user();

    return match ($user->role) {
        'staff' => redirect()->route('staff.dashboard'),
        default => redirect()->route('guest.home'),
    };
}

}

