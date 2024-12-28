<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Validator;

class UserController extends Controller
{
    public function registration(Request $request){
        $isValidate = Validator::make(request()->all(),[
            'name'=> 'required',
            'email'=> 'required|email',
            'password'=> 'required',
            'c_password'=> 'required|same:password',
        ]);

        if($isValidate->fails()){
            return response()->json($isValidate->errors(),200);
        }

        $allData = $request->all();
        $allData['password'] = bcrypt($allData['password']);

        $user = User::create($allData);

        $tok = $user->createToken('api-application')->accessToken;

        $resArray = [];
        $resArray['token'] = $tok;
        $resArray['user'] = $user;;
        return response()->json($resArray,200);

    }

    public function login(Request $request){

        Log::info('Login Called');

        if(Auth::attempt(
            [
                'email'=>$request->email,
                'password'=>$request->password
            ]
        )){
            $user = Auth::user();


            $existingToken = $user->tokens()->where('name', 'auth_token')->first();

            if ($existingToken) {
                Log::info('Existing token found');
                // If the token exists and is not revoked, return it
                return response()->json([
                    'access_token' => $existingToken->id,
                    'token_type' => 'Bearer',
                ]);
            }
            else{
                Log::info('Existing token No found');
            }


            $user -> access_token = $user->createToken('api-application')->accessToken;;
            $resArray = [];
            $resArray['code'] = '200';
            $resArray['is_success'] = true;
            $resArray['data'] = [
                'login'=> $user
            ];

            //$resArray['user'] = $user;

            return response()->json($resArray,200);
        }
        else{
            $resArray = [];
            $resArray['error'] = 'Unauthorized';

            return response()->json($resArray,401);
        }
    }

}
