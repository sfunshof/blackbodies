<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\ResetPasswordViewResponse;
use Illuminate\Http\Request;

class CustomResetPasswordViewResponse implements ResetPasswordViewResponse
{
    public function toResponse($request)
    {
        
        //return view('auth.reset-password', ['request' => $request]);
    }
}