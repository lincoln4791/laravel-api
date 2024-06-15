<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    //
    // public function login(Request $request){
    //     $user = User::Where('email',$request->email)->first();

    //     if(!$user || !Hash::check($request->password,$user->password)){
    //         return response(
    //             [
    //                 'message'=>'Invalid User'
    //             ],
    //             401
    //         );
    //     };

    //     $token = $user->createToken('my_aap_token');

    //     $resp = [
    //         'data'=>[
    //             'login' => [
    //                 'user'=>$user,
    //                 'token' => $token->plainTextToken
    //             ]
    //         ]

    //     ];

    //     // Return the response
    //     return response()->json($resp);


    // }

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
        if(Auth::attempt(
            [
                'email'=>$request->email,
                'password'=>$request->password
            ]
        )){
            $user = Auth::user();
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
