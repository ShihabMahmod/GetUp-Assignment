<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Services\auth\LoginService;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }
    public function login(LoginRequest $request)
    {
        try {

            $result = $this->loginService->login($request->validated());
            if(!$result['user']){
                return response()->json([
                    'message' => $result['message'],
                ], 200);
            }
            return response()->json([
                'user' => $result['user'],
                'token' => $result['token']
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred during login.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

}
