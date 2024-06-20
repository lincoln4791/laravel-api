<?php

namespace App\Http\Controllers;

use App\Models\SSL;
use App\Models\User;
use Illuminate\Http\Request;

class SSLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tran_id' => 'required|string',
            'val_id' => 'nullable|string',
            'amount' => 'nullable|numeric',
            'card_type' => 'nullable|string',
            'store_amount' => 'nullable|numeric',
            'card_no' => 'nullable|string',
            'bank_tran_id' => 'nullable|string',
            'status' => 'nullable|string',
            'tran_date' => 'nullable|date',
            'currency' => 'nullable|string',
            'card_issuer' => 'nullable|string',
            'card_brand' => 'nullable|string',
            'card_issuer_country' => 'nullable|string',
            'card_issuer_country_code' => 'nullable|string',
            'store_id' => 'nullable|string',
            'verify_sign' => 'nullable|string',
            'verify_key' => 'nullable|string',
            'cus_fax' => 'nullable|string',
            'currency_type' => 'nullable|string',
            'currency_amount' => 'nullable|numeric',
            'currency_rate' => 'nullable|numeric',
            'base_fair' => 'nullable|numeric',
            'value_a' => 'nullable|string',
            'value_b' => 'nullable|string',
            'value_c' => 'nullable|string',
            'value_d' => 'nullable|string',
            'risk_level' => 'nullable|integer',
            'risk_title' => 'nullable|string',
        ]);

        // Create a new transaction record
        $transaction = SSL::create($validatedData);



        if($transaction){

            if($transaction->value_a!=null){
                $user = User::find($transaction->value_a);
                $user->isPremium = true;
                $result = $user->save();

                if($result){
                    return response()->json([
                        'message' => 'Transaction created successfully',
                        'transaction' => $transaction
                    ], 201);
                }
                else{
                    return response()->json([
                        'message' => 'Falied',
                        'transaction' => $transaction
                    ], 200);
                }
            }

        }
        else{
            return response()->json([
                'message' => 'Falied',
                'transaction' => $transaction
            ], 200);
        }

        // Return a response

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
