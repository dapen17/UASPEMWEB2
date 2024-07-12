@extends('layout.app')

@section('tittle')
Pengaturan Site
@endsection

@section('favicon')
<link href="data:image/jpeg/jpg/png/webp;base64,{{ $logoBase64 }}" rel="icon">
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pengaturan Site</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Form -->
                            <form action="#" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="namasite">Nama Site</label>
                                    <input type="text" id="namasite" name="nama" class="form-control" value="{{ $sites->sitename }}">
                                </div>
                                <div class="form-group">
                                    <label for="slogan">Slogan</label>
                                    <input type="text" id="slogan" name="slogan" class="form-control" value="{{ $sites->slogan }}">
                                </div>
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" id="logo" name="logo" class="form-control-file">
                                </div>
                                <div class="form-group">
                                    @if ($sites->logo)
                                    <div class="mt-2">
                                        <img src="data:image/jpeg/jpg/png/webp;base64,{{ $logoBase64 }}" alt="Logo" style="max-width: 200px;">
                                    </div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                            <!-- End Form -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection