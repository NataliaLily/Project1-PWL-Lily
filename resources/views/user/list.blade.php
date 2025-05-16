@extends('adminlte::page')

@section('title', 'User')

@section('content_header')
    <h1>Data User</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="/user/add" class="btn btn-primary">Tambah</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->password }}</td>
                                    <td>
                                        <a href="{{ route('user.edit', [$user->id]) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type='button' data-email='{{ $user->email }}'
                                            data-id='{{ $user->id }}' class="btn btn-danger btn-sm btn-hapus">
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
                let email = $(this).data('email');
                let id = $(this).data('id');
                Swal.fire({
                    title: "Anda Yakin?",
                    text: `Anda akan menghapus user dengan email ${email}`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open(`/user/${id}/delete`);
                    }
                });
            });
        })
    </script>
@stop
