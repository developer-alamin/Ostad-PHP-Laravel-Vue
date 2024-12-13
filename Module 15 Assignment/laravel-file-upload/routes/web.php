<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('profile/{id}',[ProfileController::class,"index"])->name("index");



Route::get("/form-submit",function(Request $request){
    $email = $request->input("email");
    if ($email) {
        $data = [
            "status" => "success",
            "message" =>  "Form submitted successfully.",
            "email"=> $email
        ];
        return response()->json($data);
    }else {
        $data = [
            "status" => "failed",
            "message" =>  "Form submission failed."
        ];
        return response()->json($data);
    }
});

Route::get("/client-ip",function (Request $request){
    $clientIp = $request->ip();
    return $clientIp;
});
