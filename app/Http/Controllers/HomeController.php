<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $role = Auth::user()->role;

        if(Auth::check() && $role == '0'){

            // return view('admin.layouts.master');
            return redirect('admin');

        }

        elseif(Auth::check() && $role == '1'){

            return view('website.pages.home');
        }

        else{
            return "Something is wrong";
        }
    }
}
