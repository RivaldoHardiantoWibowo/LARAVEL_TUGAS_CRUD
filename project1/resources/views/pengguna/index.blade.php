@extends('layouts.template')

@section('content')
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::get('deleted'))
            <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
        @endif
        <div class="d-flex justify-content-between">
            <br>
            <a href="{{ route('pengguna.create') }}" class="btn btn-primary">Tambah Buku</a>
        </div>
        <br>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp

            @foreach ($pengguna as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['email'] }}</td>
                        <td>{{ $item['role'] }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('pengguna.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Hapus</button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-litle" id="exampleModalLabel">Anda Yakin Ingin Menghapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('pengguna.delete', $item['id']) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
            @endforeach
        </tbody>
    </table>
    
@endsection