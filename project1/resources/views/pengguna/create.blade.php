@extends('layouts.template')

@section('content')
        <form action="{{ route('pengguna.store') }}" method="post" class="card p-5">
            @csrf
            @if (Session::get('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama :</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label">Tipe Pengguna :</label>
                <div class="col-sm-10">
                    <select name="role" id="role" class="form-select">
                        <option selected disabled hidden>Pilih.</option>
                        <option value="admin">Admin</option>
                        <option value="cashier">Kasir</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
        </form>
@endsection