<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Models\Jurnal;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\Wallet;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Uuid;


// use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function list(Request $request)
    {
        #export excel
        if ($request->excel != null) {
            return $this->exportExcel($request);
        }

        $transaksi = Transaksi::query()
            ->with(['Wallet', 'Kategori'])
            ->where('user_id', '=', Auth::user()->id)
            #untuk filter
            ->when($request->in_out, function ($q) use ($request) {
                $q->where('in_out', $request->in_out);
            })
            ->when($request->wallet_id, function ($q) use ($request) {
                $q->where('wallet_id', $request->wallet_id);
            })
            ->when($request->kategori_id, function ($q) use ($request) {
                $q->where('kategori_id', $request->kategori_id);
            })
            ->when($request->tanggal, function ($q) use ($request) {
                $q->whereDate('tanggal', $request->tanggal);
            })
            ->paginate(10); #untuk pagination per data = 10

        #mengambil data wallet dan kategori (untuk mencari data wallet dan kategori sesuai tanggal / filter)
        $wallet = Wallet::query()->where("user_id", "=", Auth::id())->get();
        $kategori = Kategori::query()->where("user_id", "=", Auth::id())->get();
        return view('transaksi.list', [
            'transaksi' => $transaksi,
            'wallet' => $wallet,
            'kategori' => $kategori
        ]);
    }

    private function exportExcel($request)
    {
        $transaksi = Transaksi::query()
            ->with(['Wallet', 'Kategori'])
            ->where('user_id', '=', Auth::user()->id)
            ->when($request->in_out, function ($q) use ($request) {
                $q->where("in_out", $request->in_out);
            })
            ->when($request->wallet_id, function ($q) use ($request) {
                $q->where("wallet_id", $request->wallet_id);
            })
            ->when($request->kategori_id, function ($q) use ($request) {
                $q->where("kategori_id", $request->kategori_id);
            })
            ->when($request->tanggal, function ($q) use ($request) {
                $q->where("tanggal", $request->tanggal);
            })
            ->get();
        return Excel::download(new TransaksiExport($transaksi, $request), 'transaksi.xlsx');
    }



    public function add()
    {
        $userID = Auth::user()->id;
        $wallet = Wallet::query()->where("user_id", "=", $userID)->get();
        $kategori = Kategori::query()->where("user_id", "=", $userID)->get();
        return view("transaksi.add", [
            'wallet' => $wallet,
            'kategori' => $kategori
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "wallet_id" => "required",
            "kategori_id" => "required",
            "nominal" => "required|numeric",
            "deskripsi" => "required",
            "tanggal" => "required",
            "dokumen" => "mimes:jpg,png,jpeg|max:2048",
        ]);
        \DB::beginTransaction();
        try {
            $transaksi = new Transaksi();
            $transaksi->wallet_id = $request->wallet_id;
            $transaksi->kategori_id = $request->kategori_id;
            $transaksi->nominal = $request->nominal;
            $transaksi->deskripsi = $request->deskripsi;
            $transaksi->in_out = $request->in_out;
            $transaksi->tanggal = $request->tanggal;
            $transaksi->user_id = Auth::user()->id;
            #cek apakah mengirimkan file atau tidak
            if ($request->hasFile("dokumen")) {
                #simpan file ke direktori
                $file = $request->file("dokumen");
                $ekstensi = $file->getClientOriginalExtension();
                $filename = Uuid::uuid7() . "." . $ekstensi;
                $filePath = $file->storeAs("uploads", $filename, "public");
                #setfilename ke object transaksi
                $transaksi->dokumen = $filename;
            }
            $transaksi->save();
            #simpan data
            $jurnal = new Jurnal();
            $jurnal->reference_table = $transaksi->getTable();
            $jurnal->reference_id = $transaksi->id;
            $jurnal->wallet_id = $transaksi->wallet_id;

            $jurnal->nominal = $transaksi->nominal;
            if ($transaksi->in_out === "out") {
                $jurnal->nominal = (int)$transaksi->nominal * -1;
            }
            $jurnal->in_out = $transaksi->in_out;
            $jurnal->deskripsi = $transaksi->deskripsi;
            $jurnal->tanggal = $transaksi->tanggal;
            $jurnal->user_id = $transaksi->user_id;
            $jurnal->save();

            \DB::commit();
            return redirect("/transaksi")->with('success', 'Transaksi Berhasil ditambahkan');
        } catch (Exception $e) {
            #kondisi jika ada error ->batallkan semua proses query db
            \DB::rollBack();
            return redirect("/transaksi")->with('error', 'Transaksi gagal ditambahkan : ' . $e->getMessage());
        }
    }
}
