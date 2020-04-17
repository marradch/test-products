<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class FrontController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();

        return view('welcome', ['categories' => $categories]);
    }
}
