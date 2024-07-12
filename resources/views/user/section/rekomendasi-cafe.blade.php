@extends('user.perhitungan')

@section('content')
<main class="main">
    @include('user.partials.hero-rekomen')

    <section class="bobot p-2" id="bobot">
        <div class="container mt-3">
            <h2 class="text-center">Masukkan Bobot</h2>
            <p class="text-center">Silakan Masukkan Pembobotan Yang Sesuai Dengan Yang Anda Inginkan</p>
            <form action="{{ route('user.addData') }}" method="POST">
                @csrf
                <div class="row">
                    @php
                    $totalCount = 0;
                    $maxCount = 5;
                    @endphp

                    @foreach ($BobotColumns as $index => $column)
                    @foreach ($CafeColumns as $cafe)
                    @if ($totalCount >= $maxCount)
                    @break(2)
                    @endif

                    <div class="col-md-6 mb-2">
                        <label for="w{{ $loop->index + 1 }}" class="form-label">{{ ucfirst(str_replace('', ' ', $cafe)) }}</label>
                        <input type="number" class="form-control" id="w{{ $loop->index + 1 }}" name="w{{ $loop->index + 1 }}" required>
                    </div>

                    @php
                    $totalCount++;
                    @endphp
                    @endforeach
                    @endforeach
                    <div class="col-md-6 mb-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-dark btn-block">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section id="rekomendasi" class="section rekomendasi">
        @if ($latestBobot)
        <div class="container mt-4">
            <h2 class="text-center" data-aos="fade-up">Rekomendasi Cafe</h2>
            <p class="text-center">Silahkan Masukkan Pilih Cafe yang mau di hitung. Jika Nilai tidak sesuai dengan apa yang anda inginkan, anda dapat mengubah nilai tersebut.</p>
            <form method="POST" action="{{ route('user.addProduk') }}">
                @csrf
                <div class="row mb-4">
                    @if (isset($produk))
                    <div class="col-md-8" data-aos="fade-up" data-aos-delay="300">
                        <select name="produk" id="character-select" class="form-control">
                            <option value="">Pilih Cafe</option>
                            @foreach($produk as $produks)
                            <option value="{{ $produks->id }}">{{ $produks->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="350">
                        <button type="submit" class="btn btn-dark btn-block">Add</button>
                    </div>
                    @endif
                </div>
            </form>
            <div class="row">
                @foreach(session('produks', []) as $index => $produk)
                @if ($produk)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h5 class="card-title mt-2 text-bold" style="text-transform: uppercase;">{{ $produk->nama }}</h5>
                        </div>
                        <div class="card-body">
                            @foreach ($CafeColumns as $column)
                            <ul class="list-group list-group-unbordered m-2">
                                <li class="list-group-item" data-aos="fade-up" data-aos-delay="300">
                                    <div class="d-flex justify-content-between">
                                        <b>{{ $column }}</b> <span class="text-muted">{{ $produk->$column }}</span>
                                    </div>
                                </li>
                            </ul>
                            @endforeach
                            <div class="d-flex mt-3">
                                <button type="button" class="btn btn-info btn-sm mr-1" data-toggle="modal" data-target="#modalEditProduk{{ $produk->id }}">Edit</button>
                                <form method="POST" action="{{ route('user.deleteProduk', $produk->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            @if(!session('produks', []))
            <div class="col-12">
                <div class="toast justify-content-center align-items-center w-100 show" role="alert" aria-live="assertive" aria-atomic="true" style="box-shadow: none; background-color: rgba(255, 0, 0, 0.6); border: none;">
                    <div class="d-flex">
                        <div class="toast-body">
                            Anda Belum Memilih Cafe
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="row mt-4">
                <div class="col-md-2 mt-2" data-aos="fade-up" data-aos-delay="700">
                    <button id="showHasilButton" class="btn btn-dark btn-block" data-target="#modalPerhitungan" data-toggle="modal">Hasil Perhitungan</button>
                </div>
                <div class="col-md-2 mt-2" data-aos="fade-up" data-aos-delay="700">
                    <form id="showPerhitunganForm" method="GET" action="{{ route('showPerhitunganWP') }}">
                        @csrf
                        <button type="submit" class="btn btn-dark btn-block" id="showHasilButton">Hasil</button>
                    </form>
                </div>
            </div>
            @endif

            @if (isset($hasilWP))
            <div class="row mt-4">
                <div class="col-md-12">
                    <h4 class="text-bold">Hasil Perhitungan Weighted Product:</h4>
                    @foreach ($hasilWP as $hasil)
                    <p style="font-weight: 900;">RANK {{ $hasil['rank'] }}: <span style="font-weight: 400;">{{ $hasil['nama'] }}: {{ number_format($hasil['nilai'], 4) }}</span></p>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @else
        <div class="col-12">
            <div class="toast justify-content-center align-items-center w-100 show" role="alert" aria-live="assertive" aria-atomic="true" style="box-shadow: none; background-color: rgba(255, 0, 0, 0.6); border: none;">
                <div class="d-flex">
                    <div class="toast-body">
                        Anda Belum Memasukkan Bobot, Silahkan Masukkan Bobot Dahulu
                    </div>
                </div>
            </div>
        </div>
        @endif
    </section>

    @foreach(session('produks', []) as $index => $produk)
    @if ($produk)
    <!-- Modal Edit Produk -->
    <div class="modal fade" id="modalEditProduk{{ $produk->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditProduk{{ $produk->id }}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('user.updateProduk', $produk->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditProduk{{ $produk->id }}Label">Edit Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Cafe</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $produk->nama }}" required>
                        </div>
                        <!-- Tambahkan input untuk field lainnya sesuai kebutuhan -->
                        @foreach ($columnsCafe as $column)
                        @if ($column != 'id' && $column != 'created_at' && $column != 'updated_at')
                        <div class="form-group">
                            <label for="{{ $column }}">{{ ucwords(str_replace('_', ' ', $column)) }}</label>
                            <input type="text" class="form-control" id="{{ $column }}" name="{{ $column }}" value="{{ $produk->$column }}" required>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    @endforeach

</main>
@endsection
