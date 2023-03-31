<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        
        $this->validateLogin($request);
        

        if(Auth::attempt($request->only('email','password'))){
            
            if($request->user()->role == 'employee'){
                $branch = Branch::find($request->user()->branch_id)->id;
            }else{
                $branch = null;
            }

            
            return response()->json([
                'token'=>$request->user()->createToken('react-mobile')->plainTextToken,
                'role'=>$request->user()->role,
                'branch'=>$branch,
                'message'=> 'Success'
            ]);
        }

        return response()->json([
            'message'=> 'Unauthorized'
        ]);
    }

    public function validateLogin(Request $request){
        
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

    }
}
