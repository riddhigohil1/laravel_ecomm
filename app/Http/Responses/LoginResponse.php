<?php

namespace App\Http\Responses;

use App\Enum\RolesEnum;
use App\Services\CartService;
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
        
        if ($user->hasAnyRole([RolesEnum::User])) {
           (new CartService())->moveCartItemsToDatabase($user->id);
        }
        return redirect()->route('home');
    }
}