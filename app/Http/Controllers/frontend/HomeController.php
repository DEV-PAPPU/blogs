<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('website.pages.home');
    }

    public function User_Profile()
    {
        return view('admin.user.profile');
    }
}
