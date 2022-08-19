<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function showUsers(Request $request){
        if($request->wantsJson()){
            $users = User::all();
            return response()->json($users);
        }else{
            return User::all();
        }
    }

    public function showSingleUser($id){
        $user = User::find($id);
        return response()->json($user);
    }

    public function deleteUser($id){
        $post = User::find($id);
        return $post->delete();
    }
}
