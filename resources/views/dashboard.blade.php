@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 col-12">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><sup style="font-size: 20px">Rp</sup>{{number_format($totalUang)}}</h3>

                <p>Total Saldo Anda</p>
            </div>
            <div class="icon">
                <i class="fas fa-coins"></i>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @foreach ($wallets as $w)
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><sup style="font-size: 20px">Rp</sup>{{number_format($w->saldo)}}</h3>

                <p>{{$w->name}}</p>
            </div>
            <div class="icon">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="col-12">
    <h3>5 Transaksi Terakhir</h3>
    </div>
    <div class="col-12">

        @foreach ($lastTransactions as $l)
        <div class="callout callout-{{$l->in_out=="in"?"success":"danger"}}">
            <h5>Rp {{number_format($l->nominal)}} : {{$l->Wallet->name}}</h5>
            {{$l->deskripsi}} <br>
            {{$l->created_at}}
        </div>
        @endforeach
    </div>
</div>
@stop
