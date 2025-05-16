@extends('adminlte::page')

@section('title', 'Tambah Transaksi')

@section('content_header')
    <h1>Tambah Transaksi</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="/transaksi/store" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Wallet</label>
                            <select name="wallet_id" id="" class="form-control">
                                @foreach ($wallet as $w)
                                    <option value="{{ $w->id }}">{{ $w->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select name="kategori_id" id="" class="form-control">
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Transksi</label>
                            <select name="in_out" id="" class="form-control">
                                <option value="in">Uang Masuk</option>
                                <option value="out">Uang Keluar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nominal</label>
                            <input type="number" name="nominal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" value="{{date('Y-m-d')}}" name="tanggal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Dokumen</label>
                            <input type="file" name="dokumen" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
