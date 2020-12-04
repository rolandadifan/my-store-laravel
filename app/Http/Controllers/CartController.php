<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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
        $items = Cart::with(['product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();
        return view('pages.cart', [
            'items' => $items
        ]);
    }

    public function delete($id)
    {
        $data = Cart::findOrFail($id);
        $data->delete();

        return redirect()->back();
    }
}
