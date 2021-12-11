<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index(Request $request)
    {
        return $request->user();
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = md5(time()) . '.' . md5($request->email);
            $token = $user->createToken('developer-access');
            $token = $token->plainTextToken;
            $user->forceFill([
                'remember_token' => $token
            ])->save();
            return response()->json([
                'token' => $token
            ]);
        }
        return response()->json([
            'message' => 'The provided credentials do not match our records.'
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        $request->user()->forceFill([
            'remember_token' => null
        ])->save();
        return response()->json([
            'message' => 'success logout'
        ]);
    }

    public function store(Request $request)
    {
        $Users = new User();
        $Users->remember_token = $request->remember_token;
        $Users->first_name = $request->first_name;
        $Users->second_name = $request->second_name;
        $Users->email = $request->email;
        $Users->email_verified_at = $request->email_verified_at;
        $Users->phone = $request->phone;
        $Users->password = $request->password;
        $Users->image = $request->image;
        $Users->type = $request->type;
        $Users->address = $request->address;
        $Users->date_of_create = Carbon::now();
        $Users->updated_at = $request->updated_at;
        $Users->status = $request->status;
        $result = $Users->save();
        if ($result)
            return ["Result" => "User added Successfully"];
        else
            return ["Result" => "Failed to add User"];
    }

    public function show($id)
    {
        //
        return $id ? User::find($id) : User::all();//If and Else  if find category with this id get it else get all categories
    }

    public function update(Request $request, $id)
    {
        $category = User::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $request->image;
        $category->statuss = $request->statuss;
        $category->date_of_create = Carbon::now();
        $result = $category->save();
        if ($result)
            return ["Result" => "Category update Successfully"];
        else
            return ["Result" => "Failed to update"];
    }
}
