<?php

namespace App\Services\auth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginService{
    
    public function login(array $credentials): array
    {
        $user = User::where('email',$credentials['email'])->first();
        if($user){
            if (!Auth::attempt($credentials)) {
                return ['error'=>'Password Doesn\'t matches'];
            }
            $user = Auth::user();
            $token = $user->createToken('getup')->plainTextToken;

            return [
                'user' => $user,
                'token' => $token,
            ];
        }else{
            return [
                'user' => null,
                'token' => null,
                'message' => 'Email Not Found',
            ];
        }    
    }

}