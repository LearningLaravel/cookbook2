<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;

class PagesController extends Controller
{
    public function home()
    {
        Alert::error('There is an error', 'Error')->autoclose(2000);
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
