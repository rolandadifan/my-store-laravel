<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Product;


class CategoryController extends Controller
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
        $categories = Categorie::all();
        $products = Product::with(['galleries'])->paginate(48);
        return view('pages.category', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function detail($slug)
    {
        $categories = Categorie::all();
        $category = Categorie::where('slug', $slug)->firstOrFail();
        $products = Product::with(['galleries'])->where('categories_id', $category->id)->paginate(48);
        return view('pages.category', [
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
