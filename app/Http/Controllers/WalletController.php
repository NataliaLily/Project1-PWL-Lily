<?php
namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function list()
    {
        // $wallet = Wallet::all();
        // return view('wallet/list', [
        //     'wallet' => $wallet
        // ]);

        $wallet = Wallet::where('user_id', \Auth::id())->get();
        return view('wallet/list', [
            'wallet' => $wallet]);
    }

    public function add()
    {
        return view('wallet/add');
    }

    public function store(Request $request)
    {
        $wallet = new Wallet();
        $wallet->code = $request->code;
        $wallet->name = $request->name;
        $wallet->user_id = auth()->id(); // Dapatkan user_id dari user yang sedang login
        $wallet->save();
    
        return redirect('/wallet');
    }


    public function edit($id)
    {
        #fungsi find adalah untuk mencari data berdasarkan primary key nya
        $wallet = Wallet::find($id);
        if ($wallet == null) {
            abort(404);
        }
        #kondini dimana data usernya ada
        return view('wallet/edit', [
            'wallet' => $wallet
        ]);
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'code' => 'required',
            'name' => 'required|string',
        ]);
        $wallet = Wallet::find($request->id);
        if ($wallet == null) {
            abort(404);
        }
        #user ada
        $wallet->code = $request->code;
        $wallet->name = $request->name;
    
        $wallet->save();
        return redirect('/wallet');
    }

    public function delete($id)
    {
        #fungsi find adalah untuk mencari data berdasarkan primary key nya
        $wallet = Wallet::find($id);
        if ($wallet == null) {
            abort(404);
        }
        #kondini dimana data usernya ada
        $wallet->delete();
        return redirect('/wallet');
    }
}
