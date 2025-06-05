<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class TransaksiExport implements FromView
{
    protected $dataTransaksi;
    protected $request;

    public function __construct($dataTransaksi, $request)
    {
        $this->dataTransaksi = $dataTransaksi;
        $this->request = $request;
    }
    public function view(): View
    {
        return view('transaksi.excel', [
            'transaksi' => $this->dataTransaksi,
            'request' => $this->request
        ]);
    }
}
