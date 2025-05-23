@extends('adminlte::page')

@section('title', 'Wallet')

@section('content_header')
    <h1>Dompet Pribadi</h1>

@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="/wallet/add" class="btn btn-primary">Tambah</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Saldo</th>
                                <th>Report</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wallet as $wallet)
                                <tr>
                                    <td>{{ $wallet->code }}</td>
                                    <td>{{ $wallet->name }}</td>
                                    <td>{{ $wallet->saldo }}</td>
                                    <td>
                                        <a href="/wallet/{{$wallet->id}}/reportPDF" class="btn btn-danger">
                                            <i class="fa fa-file-pdf"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('wallet.edit', [$wallet->id]) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type='button' data-name='{{ $wallet->name }}'
                                            data-id='{{ $wallet->id }}' class="btn btn-danger btn-sm btn-hapus">
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
                    text: `Anda awn menghapus wallet dengan nama ${name}`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open(`/wallet/${id}/delete`);
                    }
                });
            });
        })
    </script>
@stop
