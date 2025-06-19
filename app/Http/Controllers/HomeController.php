<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Wallet;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalUang = Jurnal::where("user_id", \Auth::id())->sum("nominal");
        $wallets = Wallet::where("user_id", \Auth::id())->get();
        $lastTransactions = Jurnal::with("Wallet")
            ->where("user_id", \Auth::id())
            ->orderBy("tanggal", "desc")->limit(5)->get();

        return view('dashboard', [
            'totalUang' => $totalUang,
            'wallets' => $wallets,
            'lastTransactions' => $lastTransactions
        ]);
    }
}


