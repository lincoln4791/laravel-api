<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = Auth::user();

        if($user){
            return response()->json(data:[
                'success'=>true,
                'data'=>$user,
            ]);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>'user not found'
            ],401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getProfile(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user
        if ($user) {
            return response()->json([
                'success' => true,
                'data' => $user->makeHidden(['token']),
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'User not found',
        ], 404);
    }


    public function updateProfile(Request $request){
        $user = $request->user();
        if($user){
            $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:15',
            ]);
            $user->update($request->only('name','email','phone'));
            return response()->json([
                'success' => true,
                'data' => $user,
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message'=>'user not found'
            ],401);
        }
    }


}
