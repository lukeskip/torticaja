<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        
        $this->validateLogin($request);
        

        if(Auth::attempt($request->only('email','password'))){
            
            if($request->user()->role == 'employee'){
                $branch = Branch::find($request->user()->branch_id);
                $store = Store::find($branch->store_id);
                
                if(!$branch){
                    return response()->json([
                        'success'=>false,
                        'message'=> 'El usuario no tiene una sucursal asignada',
                        'status'=>401,
                    ],401);
                }else{
                    $branch = $branch->id;
                    return response()->json([
                        'token'=>$request->user()->createToken('react-mobile')->plainTextToken,
                        'name'=>$request->user()->name,
                        'role'=>$request->user()->role,
                        'branch'=>$branch,
                        'store'=>$store,
                        'message'=> 'Success',
                        'success'=>true,
                    ]);
                }
            
            
            }else{
                return response()->json([
                    'success'=>false,
                    'status'=>401,
                    'message'=> 'Unauthorized'
                ],401);
            }
        }

        return response()->json([
            'success'=>false,
            'status'=>401,
            'message'=> 'Unauthorized'
        ],401);
    }

    public function validateLogin(Request $request){
        
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

    }
}
