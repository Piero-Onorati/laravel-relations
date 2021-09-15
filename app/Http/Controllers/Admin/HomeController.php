<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class HomeController extends Controller
{
    public function index(){
        return view('admin.home');
    }

    public function category(){
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }
}
