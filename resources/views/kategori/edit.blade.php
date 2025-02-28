@extends('adminlte::page')

@section('title', 'Edit Kategori')

@section('content_header')
    <h1>Edit Kategori</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/kategori/update">
                        @csrf
                        <input type="hidden" name="id" value="{{$kategori->id}}" />
                        <div class="form-group">
                            <label for="">Kode</label>
                            <input type="string" name="code" class="form-control
                            @error('code') is-invalid @enderror"
                                value="{{ $kategori->code }}">
                            @error('code')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nama Kategori</label>
                            <input type="string" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ $kategori->name }}">
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
