<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Transfer;
use App\Models\Wallet;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function list()
    {
        $transfers = Transfer::query()
            ->with("Wallet")
            ->where('user_id', \Auth::id())
            ->get();
        return view("transfer.list", [
            "transfers" => $transfers
        ]);
    }

    public function add()
    {
        $wallets = Wallet::query()->where('user_id', \Auth::id())->get();
        return view("transfer.add", [
            'wallets' => $wallets
        ]);
    }

    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            #1.simpan ke transfer uang keluar
            $trfOut = new Transfer();
            $trfOut->wallet_id = $request->wallet_id_out;
            $trfOut->nominal = $request->nominal;
            $trfOut->tanggal = $request->tanggal;
            $trfOut->user_id = \Auth::id();
            $trfOut->in_out = 'out';
            $trfOut->save();
            #2.simpan ke transfer uang masuk
            $trfIn = new Transfer();
            $trfIn->wallet_id = $request->wallet_id_in;
            $trfIn->nominal = $request->nominal;
            $trfIn->tanggal = $request->tanggal;
            $trfIn->user_id = \Auth::id();
            $trfIn->in_out = 'in';
            $trfIn->save();
            #3.simpan ke jurnal uang keluar
            $jurnal = new Jurnal();
            $jurnal->reference_table = $trfOut->getTable();
            $jurnal->reference_id = $trfOut->id;
            $jurnal->wallet_id = $trfOut->wallet_id;
            $jurnal->nominal =(int)$trfOut->nominal * -1;
            $jurnal->in_out = $trfOut->in_out;
            $jurnal->deskripsi = "Transfer uang keluar";
            $jurnal->tanggal = $trfOut->tanggal;
            $jurnal->user_id = $trfOut->user_id;
            $jurnal->save();
            #4.simpan ke jurnal uang masuk
            $jurnal = new Jurnal();
            $jurnal->reference_table = $trfIn->getTable();
            $jurnal->reference_id = $trfIn->id;
            $jurnal->wallet_id = $trfIn->wallet_id;
            $jurnal->nominal = $trfIn->nominal;
            $jurnal->in_out = $trfIn->in_out;
            $jurnal->deskripsi = "Transfer uang masuk";
            $jurnal->tanggal = $trfIn->tanggal;
            $jurnal->user_id = $trfIn->user_id;
            $jurnal->save();
            \DB::commit();
            return redirect("/transfer")->with("success", "Transfer Berhasil disimpan");
        } catch (\Throwable $th) {
            \DB::rollBack();
            return redirect("/transfer")->with("error", "Transfer Gagal disimpan");
        }

    }
}
