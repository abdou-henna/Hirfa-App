<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\craftsmen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    public function register(Request $request){       
        $validator = Validator::make($request->all(), [
            'firstName' => ['required', 'string', 'max:100' , 'min:3'],
            'lastName' => ['required', 'string', 'max:100' , 'min:3'],
            'email' => ['required', 'string', 'email', 'max:100', 'min:8','unique:users'],
            'password' => ['required', 'string', 'max:100', 'min:4'],
            'gender' => ['required', 'string', 'max:100'],
            'phone' => ['required','string'],
            'birthDate' => ['required', 'date'],
        ]);
        if($validator->fails()){
            return response()->json([
                'error' =>true,
                'message'=>$validator->errors()
            ],200);
        };
        if($request['role']=="client"){
            $user=User::create([
            'firstName' => $request['firstName'],
            'lastName' => $request['lastName'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'gender' => $request['gender'],
            'phone' => $request['phone'],
            'birthDate' => $request['birthDate'],
            ]);
        }else{
            $user=craftsmen::create([
            'firstName' => $request['firstName'],
            'lastName' => $request['lastName'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'gender' => $request['gender'],
            'phone' => $request['phone'],
            'birth_date' => $request['birthDate'],
            ]);
        }
        return response()->json([
            'error' =>false,
            'message'=>"Registration completed successfully",
            'data'=> $user,
            'role' => 'user'
        ],200);
    }
}
