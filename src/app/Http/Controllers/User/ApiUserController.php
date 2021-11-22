<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;

class ApiUserController extends Controller
{
    public function register(ApiRegisterRequest $request)
    {
        if($this->getUserByEmail($request->email) != null){
            return response()->json([
                'error' => 403,
                'email' => ['Email exits']
            ]);
        }
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json($user);
    }

    public function login(ApiLoginRequest $request)
    {
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            $user = $this->getUserByEmail($request->email);
            $user->token = $user->createToken('Token')->accessToken;
            return $user;
        }
        return response()->json([
            'error' => 403,
            'email' => ['Email or password not match']
        ]);
    }

    public function userInfo(Request $request)
    {
        return response()->json($request->user('api'));
    }

    private function getUserByEmail($email)
    {
        return User::whereEmail($email)->first();
    }
}
