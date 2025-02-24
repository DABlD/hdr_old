<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\{User, Patient};

class ApiController extends Controller
{
    // AUTHENTICATION
    // AUTHENTICATION
    // AUTHENTICATION

    public function getToken(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function revokeToken(Request $request){
        $request->user()->currentAccessToken()->delete();
    }

    public function unauthenticated(Request $request){
        return [
            "message" => "Unauthenticated."
        ];
    }
}
