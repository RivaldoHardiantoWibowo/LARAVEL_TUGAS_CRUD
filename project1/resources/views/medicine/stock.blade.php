@extends('layouts.template')

@section('content')
    <div id="msg-success"></div>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Stock</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($medicines as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td style="{{ $item['stock'] <= 3 ? 'background: red; color:white' : 'background: none; color:black' }}">
                        {{ $item['stock'] }}</td>
                        <td class="d-flex justify-content-center">
                            <div onclick="edit('{{ $item['id'] }}')" class="btn btn-primary me-3" style="cursor:pointer">Tambah Stock</div>
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modal" tabindex="-1" id="edit-stock">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-litle">Ubah Data Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="form-stock">
                    <div class="modal-body">
                        <div class="msg"></div>

                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Obat</label>
                            <input type="text" name="name" id="name" class="form-control" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Nama Obat</label>
                            <input type="number" name="stock" id="stock" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('script')
        <script type="text/javascript">

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function edit(id) {
                var url = "{{ route('medicine.stock.edit', ":id") }}";
                url = url.replace(':id', id);
                $.ajax({
                    type:"GET",
                    url: url,
                    dataType: 'json',
                    success: function (res) {
                        $('#edit-stock').modal('show');
                        $('#id').val(res.id);
                        $('#name').val(res.name);
                        $('#stock').val(res.stock);
                    }
                });
            }

            $('form#-stock').submit(function(e) {
                e.preventDefault();

                var id= $('#id').val();
                var urlForm = "{{ route('medicine.stock.update', ":id") }}";
                urlForm = urlForm.replace(':id', id);

                var data = {
                    stock: $('#stock').val(),
                }

                $.ajax({
                    type:"PATCH",
                    url: urlForm,
                    data: data,
                    cache:false,
                    success: (data) => {
                        $('#edit-stock').modal('hide');
                        sessionStorage.reloadAfterPageLoad = true;
                        window.location.reload();
                    },
                    error: function(data) {
                        $('#msg').attr("class", "alert alert-danger");
                        $('#msg').text(data.responseJSON.masage);
                    }
                });


            });

            $(function () {
                if (sessionStorage.reloadAfterPageLoad) {
                    $('#msg-success').attr("class", "alert alert-success");
                    $('#msg-success').text("Berhasil menambahkan data stock!");
                    sessionStorage.clear();
                }
            })
        </script>
        
    @endpush
@endsection