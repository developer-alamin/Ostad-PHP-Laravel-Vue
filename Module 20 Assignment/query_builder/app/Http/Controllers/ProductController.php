<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use validate;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        
        $query = Product::query();
         // Search functionality
        if ($search = $request->input('search')) {
            $query->where('product_id', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }
        if ($request->input('sort') || $request->input('order')) {
           $sort = $request->input('sort');
           $order = $request->input('order');

           $query->orderBy($sort,$order);
        }

        $products = $query->paginate(5);
        return view("index",compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("create");
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

         if ($request->file("photo")) {
            $img = $request->file("photo");
            $imgPathName = $img->getClientOriginalName();
            $ExplodeImg = explode(".", $imgPathName);
            $endImg = end($ExplodeImg);
            $RandomPath = $nameResize.'img'. rand(5,150) . "." . $endImg;
            $uploadImg = $http . "img/" . $RandomPath;
            $img->move(public_path("img/"), $RandomPath);
        }else {
            $uploadImg = '';
        }


        Product::create([
            'product_id' => $request->product_id,
            'name' => $name,
            'description' => $request->description,
            'price' => $request->price,         
            'stock' => $request->stock,
            'image' => $uploadImg
        ]);
        return redirect()->back()->with("success","Product Create Success");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
       return view("show",compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view("edit",compact("product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

         $request->validate([
            'product_id' => 'required|unique:products,product_id,' . $product->id,
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $name = $request->name;
        $http = "http://" . $_SERVER['HTTP_HOST'] . "/";
        $nameResize = str_replace(" ","", $name);

        // product Image Updated
        if ($request->file("photo")) {
            $img = $request->file("photo");
            $imgPathName = $img->getClientOriginalName();
            $ExplodeImg = explode(".", $imgPathName);
            $endImg = end($ExplodeImg);
            $RandomPath = $nameResize.'img'. rand(5,150) . "." . $endImg;
            $uploadImg = $http . "img/" . $RandomPath;
            $img->move(public_path("img/"), $RandomPath);

            // old image delete system
             $oldImg = $product->image;
             $explodeOldImg = explode("/", $oldImg);
             $endOldImg = end($explodeOldImg);
             $deletePublicPath = public_path("img/".$endOldImg);
             if(File::exists($deletePublicPath)){
                
                File::delete($deletePublicPath);
             }
        }else{
            $uploadImg = $product->image;
        }


        // Update the product Date
        $product->product_id = $request->product_id;
        $product->name = $name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->image = $uploadImg;
        $product->update();
        return redirect()->route("products.index")->with("update","Product Update Success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
         // //rent image check and delete
        if ($product->image) {
            $img = $product->image;
            $explodeImg = explode("/", $img);
            $EndImg = end($explodeImg);
            $deletePath = public_path("img/" .$EndImg);
            if (File::exists($deletePath)) {
                File::delete($deletePath);
            }  
        }
        $product->delete();
        return redirect()->back()->with("update","Product Deleted Success");
    }
}
