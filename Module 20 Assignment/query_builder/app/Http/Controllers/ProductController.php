<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use validate;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Auth;
class ProductController extends Controller
{



    public function ProductRattingPage(Request $request){
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'title'      => 'required|string|max:255',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        $http = "http://" . $_SERVER['HTTP_HOST'] . "/";

         // Handle image upload
        if ($request->file("photo")) {
            $img = $request->file("photo");
            $imgPathName = $img->getClientOriginalName();
            $ExplodeImg = explode(".", $imgPathName);
            $endImg = end($ExplodeImg);
            $RandomPath = 'review' . time() . "." . $endImg;
            $uploadImg = $http . "Reviews/" . $RandomPath;
           // $img->move(public_path("Reviews/"), $RandomPath);
        } else {
            $uploadImg = null;
            
        }


        if (Auth::check()) {
            $user_id = Auth::id();

            // Check if the logged-in user has already reviewed the product
            $existingReview = Review::where('product_id', $request->product_id)
                ->where('user_id', $user_id)
                ->first();
            if ($existingReview) {
                return redirect()->back()->with('error', 'You have already submitted a review for this product.');
            }

        }else{
            $user_id = null;
        }

        

         // Save the review in the database
        $review = Review::create([
            'rating' => $request->ratting,
            'title' => $request->title,
            'photo' => $uploadImg,
            'description' => $request->description,
            'user_id' =>  $user_id,
            'product_id' => $request->product_id
        ]);

         // Calculate the average rating for the product
        $averageRating = Review::where('product_id', $request->product_id)->avg('rating');

        // Update the product's average rating
        $product = Product::find($request->product_id);
        $product->average_rating = $averageRating;
        $product->save();

        return redirect()->back()->with("success","Review Submit Success");

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($search = $request->input('search')) {
            $query->where('sku', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        // Sorting functionality
        if ($request->input('sort') && $request->input('order')) {
            $sort = $request->input('sort');
            $order = $request->input('order');

            $query->orderBy($sort, $order);
        }

        $products = $query->paginate(3);

        return view("Admin.product.index", compact("products"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view("Admin/product/create",compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Product::Rules());

        $name = $request->name;
        $nameResize = str_replace(" ", "", $name);
        $http = "http://" . $_SERVER['HTTP_HOST'] . "/";
        
        // Handle image upload
        if ($request->file("photo")) {
            $img = $request->file("photo");
            $imgPathName = $img->getClientOriginalName();
            $ExplodeImg = explode(".", $imgPathName);
            $endImg = end($ExplodeImg);
            $RandomPath = $nameResize . 'product' . rand(5, 150) . "." . $endImg;
            $uploadImg = $http . "product/" . $RandomPath;
            $img->move(public_path("product/"), $RandomPath);
            
            // Set status to 1 if a photo is uploaded
            $status = 1;
        } else {
            $uploadImg = null;
            // Set status to 0 if no photo is uploaded
            $status = 0;
        }
        
        // Replace spaces with hyphens and ensure lowercase
        if (!empty($sku)) {
            $sku = strtolower(str_replace(" ", "-", $sku));
        } else {
            // Generate a random SKU if empty and ensure lowercase
            $sku = strtolower('sku-' . Str::random(20));
        }
        
        // Insert into database
        Product::create([
            'name'               => $name,
            'price'              => $request->price,
            'stock'              => $request->stock,
            'sku'                => $sku, // Ensure 'sku' is present and validated
            'image'              => $uploadImg,
            'status'             => $status, // Default status to 0 if not provided
            'short_description'  => $request->short_description,
            'address'            => $request->address,
            'phone'              => $request->phone,
            'email'              => $request->email,
            'website'            => $request->website,
            'description'        => $request->description,
            'category_id'        => $request->category,
            'brand_id'           => $request->brand, // Fixed typo in 'brand_id ' (extra space removed)
        ]);
        
        return redirect()->back()->with("success", "Product Create Success");
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
       return view("Admin/product/show",compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view("Admin/product/edit",compact("product","categories","brands"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
    
        // Validation (allow SKU to be updated without validation failure)
        $request->validate(Product::Rules($product->id));

        $name = $request->name;
        $nameResize = str_replace(" ", "", $name);
        $http = "http://" . $_SERVER['HTTP_HOST'] . "/";

        // Handle image upload
        if ($request->file("photo")) {
            $img = $request->file("photo");
            $imgPathName = $img->getClientOriginalName();
            $ExplodeImg = explode(".", $imgPathName);
            $endImg = end($ExplodeImg);
            $RandomPath = $nameResize . 'product' . rand(5, 150) . "." . $endImg;
            $uploadImg = $http . "product/" . $RandomPath;
            $img->move(public_path("product/"), $RandomPath);

            // Delete the old image if it exists
            if ($product->image) {
                $oldImg = $product->image;
                $explodeOldImg = explode("/", $oldImg);
                $endOldImg = end($explodeOldImg);
                $deletePublicPath = public_path("product/".$endOldImg);  // Corrected folder path

                if (File::exists($deletePublicPath)) {
                    File::delete($deletePublicPath);  // Delete the file from public directory
                }
            }

        } else {
            // Retain the existing image if no new image is uploaded
            $uploadImg = $product->image;
        }

        // Replace spaces with hyphens and handle empty SKU
        if (empty($request->sku)) {
            $sku = strtolower('sku-' . Str::random(20));
        } else {
            // Generate a random SKU if not provided
            $sku = $request->sku;
        }
        // Update product in the database
        $product->update([
            'name'               => $name,
            'price'              => $request->price,
            'stock'              => $request->stock,
            'sku'                => $sku,
            'image'              => $uploadImg,
            'status'             => $request->status ?? 0, // Default status to 0 if not provided
            'short_description'  => $request->short_description,
            'address'            => $request->address,
            'phone'              => $request->phone,
            'email'              => $request->email,
            'website'            => $request->website,
            'description'        => $request->description,
            'category_id'        => $request->category,
            'brand_id'           => $request->brand,
        ]);

        return redirect()->route('products.index')->with("success", "Product updated successfully");
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

    public function productsinglepage($id)  {
        if ($id) {
            $product = Product::where( 'sku', $id)->with("reviews")->first();

            //dd(round());
            if (!$product) {
                // Handle case where product is not found
                return redirect()->back()->with('error', 'Product not found.');
            }
        } else {
            // Handle case where ID is not provided
            return redirect()->route('admin.product.index')->with('error', 'Product ID is required.');
        }
        
        return view('admin.product.single', compact('product'));
        
    }
}
