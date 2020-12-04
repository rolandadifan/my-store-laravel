<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\ProductGallery;
use App\http\Requests\Admin\ProductRequest;


class DashboardProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['galleries', 'category'])->where('users_id', Auth::user()->id)->get();
        return view('pages.dashboard-products', [
            'products' => $products
        ]);
    }


    public function create()
    {
        $categories = Categorie::all();
        return view('pages.dashboard-products-create', [
            'categories' => $categories
        ]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);
        $gallery = [
            'products_id' => $product->id,
            'photos' => $request->file('photo')->store('assets/product', 'public')
        ];

        ProductGallery::create($gallery);

        return redirect()->route('dashboard-products');
    }

    public function details($id)
    {
        $product = Product::with(['galleries', 'user', 'category'])->findOrFail($id);
        $categories = Categorie::all();

        return view('pages.dashboard-products-detail', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $item = Product::findOrFail($id);

        $item->update($data);
        return redirect()->route('dashboard-products');
    }



    public function uploadGallery(Request $request)
    {
        $data = $request->all();
        $data['photos'] = $request->file('photos')->store('assets/product', 'public');
        ProductGallery::create($data);
        return redirect()->route('dashboard-products-detail', $request->products_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->back();
    }
}
