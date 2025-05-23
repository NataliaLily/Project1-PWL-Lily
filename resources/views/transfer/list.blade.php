@extends('adminlte::page')

@section('title', 'Transfer Antar Wallet')

@section('content_header')
    <h1>Transfer Antar Wallet</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="/transfer/add" class="btn btn-primary">Tambah Transfer</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Wallet</th>
                                <th>Tipe</th>
                                <th>Nominal</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no=1)
                            @foreach ($transfers as $t)
                                <tr class="{{$t->background_row}}">
                                    <td>{{$no++}}</td>
                                    <td>{{$t->Wallet->name}}</td>
                                    <td>{{$t->in_out}}</td>
                                    <td>{{$t->nominal_label}}</td>
                                    <td>{{$t->tanggal}}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
