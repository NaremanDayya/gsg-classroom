<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AccessTokensController extends Controller
{
    public function index()
    {
        return Auth::user()->tokens;
    }


    public function store(Request $request)

    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'device_name' => ['sometimes', 'required'],
            'abilities' => ['array']
        ]);
        // Auth::guard('sunctum')->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);
        $user = User::whereEmail($request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $name = $request->post('device-name', $request->userAgent());
            $abilities = $request->post('abilities', ['*']);
            $token = $user->createToken($name, $abilities, now()->addDays(90));

            return Response::json([
                'token' => $token->plainTextToken,
                'user' => $user,
            ], 201);
        }
        return  Response::json([
            'message' => __('Invalid Credentials')
        ], 401);
    }

    public function destroy($id = null)
    {
        $user = Auth::guard('sanctum')->user();
        if ($id) {
            //Revoke from current device -logout
            if ($id == 'current') {
                $user->currentAccessToken()->delete();
            } else {
                $user->tokens()->findOrFail($id)->delete();
            }
        }else{
            $user->tokens()->delete();
        }
        
    }
}
