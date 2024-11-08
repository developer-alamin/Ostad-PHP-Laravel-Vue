<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\Response;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("index");
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

        $request->validate(Product::validationRules());

        $name = $request->name;
        $nameResize = str_replace(" ","", $name);
        $http = "http://" . $_SERVER['HTTP_HOST'] . "/";

         if ($request->file("image")) {
            $img = $request->file("image");
            $imgPathName = $img->getClientOriginalName();
            $ExplodeImg = explode(".", $imgPathName);
            $endImg = end($ExplodeImg);
            $RandomPath = $nameResize.'img'. rand(5,150) . "." . $endImg;
            $uploadImg = $http . "product/" . $RandomPath;
            $img->move(public_path("product/"), $RandomPath);
        }


        Product::create([
            'product_id' => $request->product_id,
            'name' => $name,
            'description' => $request->description,
            'price' => $request->price,         
            'stock' => $request->stock,
            'image' => $uploadImg
        ]);
        return response()->json(['success' => true, 'message' => 'Product created successfully.'], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
       return response()->json([
            'success' => true,
            'product'   => $product
        ], Response::HTTP_OK);
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
