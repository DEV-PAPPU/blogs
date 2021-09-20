<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\PostCommentController;
use App\Http\Controllers\backend\UserProfileController;
use App\Http\Controllers\backend\PosController;
use App\Http\Controllers\frontend\PublicBlogController;
use App\Http\Controllers\backend\TaskController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Admin
Route::resource('users', UserController::class);
Route::resource('post', PostController::class);
Route::resource('category', CategoryController::class);
Route::resource('subcategory', SubCategoryController::class);
Route::resource('product', ProductController::class);
// Route::resource('task', TaskController::class);


Route::get('tasks',[TaskController::class,'index']);
Route::post('task/store',[TaskController::class,'store']);
Route::get('task/edit/{id}',[TaskController::class,'edit']);
Route::put('task/update/{id}',[TaskController::class,'update']);
Route::get('task/show/{id}',[TaskController::class,'show']);



//Pos
Route::resource('pos', PosController::class);
Route::post('/pos/search',[PosController::class,'Search']);
Route::post('/pos/add/user',[PosController::class,'Search']);


Route::post('pos/session',[PosController::class,'session_store']);

//Post Comment
Route::resource('comment', PostCommentController::class);

//Show Post Comment Public
Route::get('/comments/{id}',[PostCommentController::class,'Show_comments']);


// Auth User
Route::post('/user/password/update',[UserController::class,'User_Password_Update']);


// User Route-Controller
Route::middleware('auth')->group(function () {
 //User Post CRUD
 Route::resource('posts', UserProfileController::class);

 Route::get('/auth/user/data',[UserProfileController::class,'Auth_User_Data']);
 Route::get('/admin/home',[AdminController::class,'Admin_Home_Info']);
});


//Public Controller
Route::get('/public/posts',[PublicBlogController::class,'All_Posts']);
Route::post('/posts/shorting',[PublicBlogController::class,'Shorting']);

Route::get('/post-single/{slug}',[PublicBlogController::class,'Blog_single']);

Route::get('/post/search/{search}',[PublicBlogController::class,'postsearch']);

Route::post('/sentmail',[PublicBlogController::class,'Mail']);
Route::get('/home/category',[CategoryController::class,'home_Category']);
Route::get('/category/single/{slug}',[CategoryController::class,'Category_single']);

Route::get('/post/of/category',[CategoryController::class,'Post_Of_Category']);


