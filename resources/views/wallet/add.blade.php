@extends('adminlte::page')

@section('title', 'Tambah Dompet')

@section('content_header')
    <h1>Tambah Dompet Pribadi</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="bg-danger">
                            <ul>
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="/wallet/store">
                        @csrf
                        <div class="form-group">
                            <label for="">Kode</label>
                            <input type="text" name="code"  
                            class="form-control @error('code') is-invalid @enderror"  
                            value="{{ old('code') }}">  
                            @error('code') 
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nama Dompet</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
@stop