<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $brands = Brand::query();

        if ($request->search) {
            $brands = $brands->where('name', 'like', '%' . $request->search . '%');
        }
        
        $brands = $brands->latest()->paginate(5);
        return view("Admin.Brand.index", compact('brands'));
        
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
        $name = $request->name;
        $nameResize = str_replace(" ","", $name);
        $http = "http://" . $_SERVER['HTTP_HOST'] . "/";

        //For Photo Upload
        if ($request->file("file")) {
            $img = $request->file("file");
            $imgPathName = $img->getClientOriginalName();
            $ExplodeImg = explode(".", $imgPathName);
            $endImg = end($ExplodeImg);
            $RandomPath = $nameResize.'Img'. rand(5,150) . "." . $endImg;
            $uploadPhoto = $http . "Brands/" . $RandomPath;
            $img->move(public_path("Brands/"), $RandomPath);

        }else{
            $uploadPhoto = null;
        }

        Brand::create([
            'name' => $name,
            'photo' => $uploadPhoto,
            'status' => $request->status
        ]);
        return redirect()->back()->with('success',"Brand Created Success");
        
    }
    public function brandstatuschange(Request $request){
      
        $brand = Brand::findOrFail($request->id);
        $status = ($request->status === "active") ? "in-active" : "active";
    
        $brand->status = $status;
        $brand->update();
        return redirect()->back()->with('success',"Brand Status Change Success");

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
    public function edit(Brand $brand)
    {
        return response()->json($brand,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Brand $brand)
    {
        $name = $request->name;
        $http = "http://" . $_SERVER['HTTP_HOST'] . "/";
        $nameResize = str_replace(" ","", $name);


        // Brand Image Updated
        if ($request->file("file")) {
            $img = $request->file("file");
            $imgPathName = $img->getClientOriginalName();
            $ExplodeImg = explode(".", $imgPathName);
            $endImg = end($ExplodeImg);
            $RandomPath = $nameResize.'Img'. rand(5,150) . "." . $endImg;
            $uploadPhoto = $http . "Brands/" . $RandomPath;
            $img->move(public_path("Brands/"), $RandomPath);

            // old image delete system
            $oldImg = $brand->photo;
            $explodeOldImg = explode("/", $oldImg);
            $endOldImg = end($explodeOldImg);
            $deletePublicPath = public_path("Brands/".$endOldImg);
            if(File::exists($deletePublicPath)){
                File::delete($deletePublicPath);
            }
        }else{
            $uploadPhoto = $brand->photo;
        }

        $brand->name = $name;
        $brand->photo = $uploadPhoto;
        $brand->status = $request->status;
        $brand->save();
        return redirect()->back()->with("success","Brand Update Success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if($brand){
            //Doctor image check and delete
             if($brand->photo) {
                 $img = $brand->photo;
                 $explodeImg = explode("/", $img);
                 $EndImg = end($explodeImg);
                 $deletePath = public_path("Brands/" .$EndImg);
                 if (File::exists($deletePath)) {
                     File::delete($deletePath);
                 }
             }
         
             $brand->delete();
             return redirect()->back()->with('deleted',"Brand Data Deleted");
         }
    }
}
