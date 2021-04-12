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
                <a href="{{route('employee-create')}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Tambah Data Karyawan</a>
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
                                    <th>Action</th> 
                                    <!-- <th>Status</th> -->
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('datatable-data')
<script type="text/javascript">
    $(function () {
      
      var table = $('#table-employee').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('employee') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'nama_pegawai', name: 'nama_pegawai'},
              {data: 'nik', name: 'nik'},
              {data: 'jenis_kelamin', name: 'jenis_kelamin'},
              {data: 'photo', name: 'photo',
                render: function(data, type, full, meta) {
                    return "<img src=\"/public/foto/" + data + "\" height=\"50\"/>";
                }
            },
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>
@endsection