<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSettingController extends Controller
{
    public function store()
    {
        $user = Auth::user();
        $categories = Categorie::all();

        return view('pages.dashboard-settings', [
            'user' => $user,
            'categories' => $categories,
        ]);
    }

    public function account()
    {
        $user = Auth::user();
        $province = Province::all();
        $regencies = Regency::all();
        return view('pages.dashboard-accounts', [
            'user' => $user,
            'province' => $province,
            'regencies' => $regencies,
        ]);
    }

    public function update(Request $request, $redirect)
    {
        $data = $request->all();
        $item = Auth::user();

        $item->update($data);

        return redirect()->route($redirect);
    }
}
