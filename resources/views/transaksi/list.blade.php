@extends('adminlte::page')

@section('title', 'Transaksi')

@section('content_header')
    <h1>Transaksi</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="/transaksi/add" class="btn btn-primary">Tambah</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                                <th>Jenis</th>
                                <th>Wallet</th>
                                <th>Kategori</th>
                                <th>Nominal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($transaksi as $t)
                            {{-- ternary if --}}
                                {{-- <tr class="{{$t->in_out==='in'?'bg-success' : 'bg-danger'}}"> --}}
                                    <tr class="{{$t->background_row}}">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $t->tanggal }}</td>
                                    <td>{{ $t->deskripsi }}</td>
                                    <td>{{ $t->in_out }}</td>
                                    <td>{{ $t->Wallet->name }}</td>
                                    <td>{{ $t->Kategori->name }}</td>
                                    <td class="text-right">{{ number_format(
                                        $t->nominal,0,',',".") }}</td>
                                    <td>
                                        @if($t->dokumen== null)
                                        Tidak ada dokumen
                                        @else
                                        <a target="_blank"
                                        href="{{asset("storage/uploads/".$t->dokumen)}}" class="btn btn-info">
                                            Lihat File
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {!! $transaksi->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@stop
