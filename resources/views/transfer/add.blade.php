@extends('adminlte::page')

@section('title', 'Transfer Antara Wallet')

@section('content_header')
    <h1>Transfer Antar Wallet</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="/transfer/store" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Dari Wallet</label>
                            <select name="wallet_id_out" id="" class="form-control">
                                @foreach ($wallets as $w)
                                    <option value="{{ $w->id }}">{{ $w->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Ke Wallet</label>
                            <select name="wallet_id_in" id="" class="form-control">
                                @foreach ($wallets as $w)
                                    <option value="{{ $w->id }}">{{ $w->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Transfer</label>
                            <input type="date" name="tanggal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Nominal Transfer</label>
                            <input type="text" name="nominal" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
