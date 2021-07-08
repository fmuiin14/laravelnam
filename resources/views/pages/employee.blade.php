@extends('layouts.app')

@section('title')
    Employee - App Penggajian Project
@endsection

@section('content')

    <div class="section-header">
        <h1>Data Karyawan</h1>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="float-right">
                <a href="{{ route('employee-create') }}" class="btn btn-icon icon-left btn-primary"><i
                        class="far fa-edit"></i> Tambah Data Karyawan</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-employee">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Foto</th>
                                    <th>Data</th>
                                    <th>Action</th>
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
                                </select>
                            </div>
                        </div>

                        <!-- <div class="form-group">
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
                            </div> -->
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
    var SITEURL = '{{URL::to('')}}';
        $(document).ready(function() {

            var table = $('#table-employee').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('employee') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_pegawai',
                        name: 'nama_pegawai'
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin'
                    },
                    {
                        data: 'photo',
                        name: 'photo',
                        render: function(data, type, full, meta) {
                            return "<img src=\"/storage/" + data + "\" height=\"50\"/>";
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
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
            var masterJabatan;
            $('body').on('click', '.edit-product', function() {
                var product_id = $(this).data('id');
                var url = 'employee/edit/' + product_id;
                if (masterJabatan == null) {
                    url += '/0';
                } else url += '/1';

                $.get(url, function(respond) {
                    console.log(respond);
                    if (respond.status) {
                        if (masterJabatan == null) {
                            masterJabatan = respond.others.jabatan;
                        }

                        var data = respond.others.employee;
                        console.log(data.jenis_kelamin + ' hasil');

                        $('#productCrudModal').html("Edit Data");
                        $('#btn-save').val("edit-product");
                        $('#ajax-product-modal').modal('show');
                        $('#product_id').val(data.id);
                        $('#nik').val(data.nik);
                        $('#nama_pegawai').val(data.nama_pegawai);
                        render_jabatan(data.jabatan_id);
                    } else {
                        alert(respond.message);
                    }
                })
            });

            function render_jabatan(jabatanID) {
                // console.log(jabatanID + ' data render');
                var temp = '';
                $.each(masterJabatan, function(index, el) {
                    temp += '<option value="' + el.id + '">' + el.nama_jabatan + '</option>';
                });

                $("#jabatan_id").find('option').remove().end().append(temp).val(jabatanID);
            }

            // end edit

            // edit action start
            if($("#productForm").length > 0) {
                $("#productForm").validate({
                    submitHandler: function(form) {
                        var actionType = $('#btn-save').val();
                        $('#btn-save').addClass("btn-progress");
                        
                        $.ajax({
                            data: $('#productForm').serialize(),
                            url: 
                        });
                    }
                });
            }
            // edit action end


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
