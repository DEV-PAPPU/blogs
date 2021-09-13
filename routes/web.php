<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\frontend\PublicBlogController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\OOPController;

Auth::routes();
Route::get('/op', [OOPController::class, 'OOP']);

Route::get('/oop', function () {

    App\Models\Post::latest()->get();

    // class Fruit {
    //   // Properties
    //   public $frist = 5;
    //   public $second = 5;


    //         // Methods
    //         function sum() {

    //             Product::with('category')->latest()->paginate('4');

    //             return $this->frist + $this->second;
    //         }

    //         // function sum($frist , $second) {

    //         //     return $frist + $second;
    //         // }
    // }

    // $get_sum = new Fruit();

    // $total = $get_sum->sum();

    // echo $total;

    });


Route::get('/form', [PosController::class, 'stripteform']);

Route::post('/stripe', [PosController::class, 'stripe_payment'])->name('stripe.payment');


Route::get('/', [HomeController::class, 'home'])->name('main-home');



//Auth Access
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Admin Dashboard
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/{any?}', function () {
        return view('admin.layouts.master');
    })->where('any', '[\/\w\.-]*');

Route::get('/admin', [AdminController::class, 'Admin_Home'])->name('admin');

});

Route::get('/{any?}', function () {
    return view('/website.layouts.master');
})->where('any', '[\/\w\.-]*');







