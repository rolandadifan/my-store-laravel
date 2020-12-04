<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categorie;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Categorie::take(6)->get();
        $products = Product::with(['galleries'])->take(8)->latest()->get();
        return view('pages.home', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function success()
    {
        return view('pages.success');
    }
}
