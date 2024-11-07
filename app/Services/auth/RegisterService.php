<?php

namespace App\Services\auth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterService{
    
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return [
            'user' => $user,
            'message' => 'Register Success! We will send a welcome email on your current email address',
        ];
    }

}