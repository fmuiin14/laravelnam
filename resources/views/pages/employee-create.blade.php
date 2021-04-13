@extends('layouts.app')

@section('title')
    Employee Create - App Penggajian Project
@endsection

@section('content')

    <!-- Main Content -->
    <div class="section-header">
        <h1>Tambah Data Karyawan</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('employee-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Karyawan</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="nama">
                                    @if ($errors->has('nama'))
                                        <span class="text-danger">{{ $errors->first('nama') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jabatan</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" name="jabatan_id">
                                        <option selected disabled>Pilih Jabatan</option>
                                        @foreach ($salaries as $sallary)
                                            <option value="{{ $sallary->id }}">{{ $sallary->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('jabatan_id'))
                                        <span class="text-danger">{{ $errors->first('jabatan_id') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Kelamin</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" name="j_k">
                                        <option selected disabled>Pilih Jenis Kelamin</option>
                                        <option value="M">Laki - Laki</option>
                                        <option value="F">Perempuan</option>
                                    </select>
                                    @if ($errors->has('j_k'))
                                        <span class="text-danger">{{ $errors->first('j_k') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Masuk</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="date" name="datenya" class="form-control">
                                    @if ($errors->has('datenya'))
                                        <span class="text-danger">{{ $errors->first('datenya') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Karyawan</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" name="status">
                                        <option selected disabled>Pilih Status Karyawan</option>
                                        <option value="tetap">Karyawan Tetap</option>
                                        <option value="lepas">Karyawan Lepas</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Photo</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="file" name="photo" class="form-control">
                                    @if ($errors->has('photo'))
                                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
