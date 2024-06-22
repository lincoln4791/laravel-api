<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //return Brand::all();
        //$brands = Brand::paginate(500);

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

    public function getBrands(Request $request){
        $size = 500;
        $page = 1;
        if($request->has('size')){
            $size = $request->input('size');
        }

        if($request->has('page')){
            $page = $request->input('page');
        }

        $brands = Brand::paginate($size, ['*'], 'page', $page);
        if($brands){
            $resArray = [];
            $resArray['data'] = $brands;;
            return response()->json($resArray,200);
        }
        else{
            $resArray = [];
            $resArray['error'] = "Something is wrong";
            return response()->json($resArray,200);
        }

    }

}
