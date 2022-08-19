<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);
        // if($fields->fails()){
        //     $response = [
        //         'success'=> false,
        //         'message' => $validator->errors()
        //     ];
        //     return response()->json($response, 400);
        // }


        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('Nexus')->accessToken;

        $response = [
            'user'=>$user,
            'token'=> $token
        ];

        return response()->json($response, 201);

    }
    public function login(Request $request){
        $fields = $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        //Check Email
        $user = User::where('email',$fields['email'])->first();

        //Check Password
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message'=>'Bad credentials'
            ], 401);
        }
        // $tokenResponse = parent::issueToken($request);
        // $refreshToken = $tokenResponse['refresh_token'];

        $token = $user->createToken('NexusIn')->accessToken;

        return response([
            'user'=>$user,
            'access_token'=>$token,
            // 'refreshToken'=>$refreshToken,
        ],201);

    }
    public function logout(){
        auth()->user()->tokens()->delete();
    }
}
