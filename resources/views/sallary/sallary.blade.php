@extends('layouts.app')

@section('title')
    Sallary - App Penggajian Project
@endsection

@section('content')

    <div class="section-header">
        <h1>Data Jabatan</h1>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="float-right">
                <a href="{{ route('sallary.create') }}" class="btn btn-icon icon-left btn-primary"><i
                        class="far fa-edit"></i> Tambah Data Jabatan</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-sallary">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nama Jabatan</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan Transport</th>
                                    <th>Uang Makan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ajax-product-modal" style="background-color: rgba(10,10,10,0.45);" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="productCrudModal"></h4>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal">
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="form-group">
                            <label for="nik" class="col-sm-12 control-label">NIK</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" value=""
                                    disabled maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Nama Karyawan</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai"
                                    placeholder="Enter nama pegawai" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Jabatan</label>
                            <div class="col-sm-12">
                                <select class="form-control selectric" id="jabatan_id" name="jabatan_id">
                                    <option selected disabled>Pilih Jabatan</option>
                                    {{-- @foreach ($salaries as $sallary)
                                        <option value="{{ $sallary->id }}">{{ $sallary->nama_jabatan }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="j_k" class="col-sm-12 control-label">Jenis Kelamin</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="j_k">
                                    <option selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="M">Laki - Laki</option>
                                    <option value="F">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="j_k" class="col-sm-12 control-label">Tanggal Masuk</label>
                            <div class="col-sm-12">
                                <input type="date" name="date" class="form-control" id="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status_karyawan" class="col-sm-12 control-label">Status Karyawan</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="status">
                                    <option selected disabled>Pilih Status Karyawan</option>
                                    <option value="tetap">Karyawan Tetap</option>
                                    <option value="lepas">Karyawan Lepas</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12 control-label">Photo</label>
                            <div class="col-sm-12">
                                <input type="file" name="photo" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('datatable-data')

    <script type="text/javascript">
        $(document).ready(function() {

            var table = $('#table-sallary').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('sallary.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_jabatan',
                        name: 'nama_jabatan'
                    },
                    {
                        data: 'gaji_pokok',
                        name: 'gaji_pokok'
                    },
                    {
                        data: 'tj_transport',
                        name: 'tj_transport'
                    },
                    {
                        data: 'uang_makan',
                        name: 'uang_makan'
                    },
                    {
                        data: 'data',
                        name: 'data',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // Delete article Ajax request.
            var user_id;

            $(document).on('click', '.delete', function() {
                user_id = $(this).attr('id');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function() {
                $.ajax({
                    url: "employee/destroy/" + user_id,
                    success: function(data) {
                        setTimeout(function() {
                            $('#confirmModal').modal('hide');
                            $('#table-employee').DataTable().ajax.reload();
                            alert('Data Deleted');
                        }, 2000);
                    }
                })
            });
            // end delete

            // start edit
            /* When click edit user */
            $('body').on('click', '.edit-product', function() {
                var product_id = $(this).data('id');
                $.get('employee/edit/' + product_id, function(data) {
                    $('#productCrudModal').html("Edit Data");
                    $('#btn-save').val("edit-product");
                    $('#ajax-product-modal').modal('show');
                    $('#product_id').val(data.id);
                    $('#nik').val(data.nik);
                    $('#nama_pegawai').val(data.nama_pegawai);
                    $('#jabatan_id').val(data.nama_jabatan);
                })
            });
            // end edit


        });

    </script>

    {{-- delete modal start --}}
    <div class="modal fade" tabindex="-1" role="dialog" style="background-color: rgba(10,10,10,0.45);" id="confirmModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-primary">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    {{-- delete modal end --}}

@endsection
