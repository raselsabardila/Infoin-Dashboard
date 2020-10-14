@extends('templates_backend.home')

@section('title')
    Verification Eo
@endsection

@section('sub-title')
    Verification Eo
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <center>
                        <img src="{{ asset("resources/images/KTP.svg") }}" width="60%" alt="">
                    </center>
                    <br>
                    <div class="alert alert-info" role="alert">
                        Fotokan diri dan ktp anda dengan posisi seperti ilustrasi diatas.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route("eo.storeVerification") }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <label for="" class="section-title" style="margin-top: -50px">File gambar</label>
                        <div class="custom-file">
                            <input type="file" name="ktp" class="custom-file-input @error("ktp") is-invalid @enderror" id="site-favicon">
                            <label class="custom-file-label">Pilih File</label>
                        </div>
                        <div class="form-text text-muted">ukuran gambar tidak lebih dari 2mb | format : png, jpg, jpeg</div>
                        @error('ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary btn-block mt-3">Verifikasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection