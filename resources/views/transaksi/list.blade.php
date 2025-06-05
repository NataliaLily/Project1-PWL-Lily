@extends('adminlte::page')

@section('title', 'Transaksi')

@section('content_header')
    <h1>Transaksi</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="/transaksi/add" class="btn btn-primary float-right ">Tambah</a>
                </div>
                {{-- membuat filter untuk transaksi --}}
                <div class="card-body">
                    <div class="col-12">
                        <form>
                            <select name="in_out" id="" class="form-control-sm">
                                <option value="">Semua Tipe</option>
                                <option value="in" {{request()->in_out == "in" ? "selected" : ""}}>Uang Masuk</option>
                                <option value="out" {{request()->in_out == "out" ? "selected" : ""}}>Uang Keluar</option>
                            </select>
                            <select name="wallet_id" id="" class="form-control-sm">
                                <option value="">Semua Wallet</option>
                                @foreach ($wallet as $w)
                                    <option value="{{ $w->id }}" 
                                        {{$w->id == request()
                                        ->wallet_id ? "selected" : ""}}>{{ $w->name }}</option>
                                @endforeach
                            </select>
                            <select name="kategori_id" id="" class="form-control-sm">
                                <option value="">Semua Kategori</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}" 
                                        {{$k->id == request() 
                                        ->kategori_id ? "selected" : ""}}>{{ $k->name }}</option>
                                @endforeach
                            </select>
                            <input type="date" value="{{request()->tanggal}}" name = "tanggal" class="form-control-sm">
                            <button type="submit" class="btn btn-sm btn-info">Filter</button>
                            <a href="/transaksi" class="btn btn-sm btn-dark">Reset</a>
                            {{-- export excel --}}
                            <input type="submit" name="excel" class="btn btn-sm btn-success" value="Excel">
                        </form>
                    </div>
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
                                <tr class="{{ $t->background_row }}">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $t->tanggal }}</td>
                                    <td>{{ $t->deskripsi }}</td>
                                    <td>{{ $t->in_out }}</td>
                                    <td>{{ $t->Wallet->name }}</td>
                                    <td>{{ $t->Kategori->name }}</td>
                                    <td class="text-right">
                                        {{ number_format($t->nominal, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        @if ($t->dokumen == null)
                                            Tidak ada dokumen
                                        @else
                                            <a target="_blank" href="{{ asset('storage/uploads/' . $t->dokumen) }}"
                                                class="btn btn-info">
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
            {{-- pagination --}}
            {!! $transaksi->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@stop
