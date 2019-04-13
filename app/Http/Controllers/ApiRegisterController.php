<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;

class ApiRegisterController extends Controller
{
    //

//    public function register(Request $request)
//    {
//        $validate = Validator::make($request->all(), [
//                'email' => 'required|string|email|max:255|unique:users',
//                'name' => 'required',
//                'password' => 'required'
//            ]
//        );
//
//        if ($validate->fails()) {
//            return response()->json($validate->erros());
//        }
//
//        User::create([
//            'name' => $request->get('name'),
//            'email' => $request->get("email"),
//            'password' => $request->get('password')
//        ]);
//
//        $user = User::first();
//        $token = JWTAuth::fromUser($user);
//
//        return Response::json(compact('token'));
//
//    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
        $user = User::first();
        $token = JWTAuth::fromUser($user);

        return Response::json(compact('token'));
    }
}
