@extends('adminlte::page')

@section('title', 'Kategori')

@section('content_header')
    <h1>Daftar Kategori</h1>

@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="/kategori/add" class="btn btn-primary">Tambah</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $kategori)
                                <tr>
                                    <td>{{ $kategori->code }}</td>
                                    <td>{{ $kategori->name }}</td>
                                    <td>
                                        <a href="{{ route('kategori.edit', [$kategori->id]) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type='button' data-name='{{ $kategori->name }}'
                                            data-id='{{ $kategori->id }}' class="btn btn-danger btn-sm btn-hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function() {
            $('.btn-hapus').click(function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let code = $(this).data('code');
                Swal.fire({
                    title: "Anda Yakin?",
                    text: `Anda akan menghapus kategori dengan nama ${name}`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open(`/kategori/${id}/delete`);
                    }
                });
            });
        })
    </script>
@stop