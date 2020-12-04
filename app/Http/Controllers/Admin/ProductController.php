<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use App\Models\ProductGallery;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Product::with(['user', 'category']);

            return DataTables::of($query)->addColumn('action', function ($item) {
                return '
                <div class="btn-group">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Aksi
                        </button>
                        <div class="dropdown-menu">
                            <a href="' . route('product.edit', $item->id) . '" class="dropdown-item">
                            Sunting
                            </a>

                            <form action="' . route('product.destroy', $item->id) . '" method="post">
                            ' . method_field('delete') . csrf_field() . '
                                <button class="dropdown-item text-danger" type="submit">
                                delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                ';
            })->rawColumns(['action'])->make();
        }
        return view('pages.admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $categories = Categorie::all();
        return view('pages.admin.product.create', [
            'users' => $users,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        Product::create($data);
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $categories = Categorie::all();
        $item = Product::with(['user', 'category'])->findOrFail($id);
        return view('pages.admin.product.edit')->with([
            'users' => $users,
            'categories' => $categories,
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $item = Product::findOrFail($id);

        $item->update($data);
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $item->delete();

        // ProductGallery::findOrFail($id)->deleted();

        return redirect()->route('product.index');
    }
}
