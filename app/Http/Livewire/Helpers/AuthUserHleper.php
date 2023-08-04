<?php

namespace App\Http\Livewire\Helpers;

use Illuminate\Support\Facades\Auth;

class AuthUserHleper
{
    public static function login(array $data): bool
    {
        return Auth::attempt($data);
    }
}
