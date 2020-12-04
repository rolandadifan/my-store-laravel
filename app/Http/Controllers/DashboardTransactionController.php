<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;

class DashboardTransactionController extends Controller
{
    public function index()
    {
        $sellTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('product', function ($product) {
                $product->where('users_id', Auth::user()->id);
            })->get();
        $buyTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('transaction', function ($transaction) {
                $transaction->where('users_id', Auth::user()->id);
            })->get();

        return view('pages.dashboard-transactions', [
            'sellTransactions' => $sellTransactions,
            'buyTransactions' => $buyTransactions
        ]);
    }

    public function details($id)
    {
        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])->findOrFail($id);
        return view('pages.Dashboard-transactions-detail', [
            'transactions' => $transactions
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = TransactionDetail::findOrFail($id);
        $item->update($data);

        return redirect()->back();
    }
}
