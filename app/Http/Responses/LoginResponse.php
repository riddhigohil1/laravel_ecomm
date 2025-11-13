<?php

namespace App\Http\Responses;

use App\Enum\RolesEnum;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function toResponse($request)
    {
        $user = Auth::user();
        
        if ($user->hasAnyRole([RolesEnum::Admin, RolesEnum::Vendor])) 
        { 
          return Inertia::location(route('filament.admin.pages.dashboard'));
        } 
        elseif ($user->hasRole(RolesEnum::User)) 
        {
          return redirect()->route('home');
        } 

        return redirect()->route('login');
    }
}