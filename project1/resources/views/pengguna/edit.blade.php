@extends('layouts.template')

@section('content')
        <form action="{{ route('pengguna.update', $pengguna['id']) }}" method="POST" class="card p-5">
            @csrf
            @method('PATCH')

            @if ($errors->any())
                <ul class="alert alert-danger p-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama :</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control" autocomplete="off" value="{{ $pengguna['name'] }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" autocomplete="off"  value="{{ $pengguna['email'] }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label">Tipe Pengguna :</label>
                <div class="col-sm-10">
                    <select name="role" id="role" class="form-select">
                        <option value="admin" {{ $pengguna['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="cashier" {{ $pengguna['role'] == 'chasier' ? 'selected' : '' }}>Chasier</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Ubah Password :</label>
                <div class="col-sm-10">
                    <input type="password" name="password" id="password" class="form-control d-flex" value="{{ $pengguna['password'] }}">
                    <label>Show Password <input type="checkbox" class="check-box" name="checkbox" id="showPasswordCheckbox"></label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
        </form>
        <script>
                    var passwordField = document.getElementById("password");
        var showPasswordCheckbox = document.getElementById("showPasswordCheckbox");

        showPasswordCheckbox.addEventListener("change", function () {
            if (showPasswordCheckbox.checked) {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        });
        </script>
@endsection