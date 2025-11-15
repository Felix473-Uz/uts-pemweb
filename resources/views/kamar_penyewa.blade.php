@extends('layouts.app_penyewa')

@section('content')
<main id="main" class="mt-5" style="min-height:600px">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                @foreach($kamars as $kamar)
                    <div class="col-4 mb-4" style="padding:15px">
                        <div class="card">
                            <div class="card-header text-center" style="padding:0px">
                                <img class="card-img-top" src="{{ asset('storage/' . $kamar->foto_utama) }}" alt="Card image" style="width:100%;height:300px">
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <h6 class="card-title text-center fw-bold mb-2">{{ $kamar->nama_kamar }}</h6>
                                    <p class="text-primary fw-semibold text-center mb-1" style="font-size: 1.1rem;">
                                        Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                                    </p>
                                    <p class="text-muted small text-center mb-3">
                                        {{ \Illuminate\Support\Str::limit($kamar->deskripsi, 150, '...') }}
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-sm btn-outline-info w-45" data-toggle="modal" data-target="#detailModal{{ $kamar->id }}">
                                            Lihat Detail
                                        </button>
                                        @if ($status === "terisi")
                                            <button class="btn btn-sm btn-info text-white w-45" data-toggle="modal" data-target="#sewaModal{{ $kamar->id }}">
                                                Sewa Sekarang
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-info text-white w-45" onclick="alert('Data Diri Anda Belum Lengkap, Silahkan Isi Data Diri Terlebih Dahulu')">
                                                Sewa Sekarang
                                            </button>       
                                        @endif
                                        
                                    </div>
                                </div>

                                <!-- Modal Sewa -->
                                <div class="modal fade" id="detailModal{{ $kamar->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Kamar</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                @php
    $fotoLain = json_decode($kamar->foto_lain_lain, true); // pastikan decode jadi array
@endphp

<!-- Carousel -->
<div id="carouselKamar{{ $kamar->id }}" class="carousel slide mb-3" data-ride="carousel">
    <div class="carousel-inner rounded">
        <div class="carousel-item active">
            <img src="{{ asset('storage/' . $kamar->foto_utama) }}" class="d-block w-100" alt="Foto Utama {{ $kamar->nama_kamar }}">
        </div>
        @foreach ($fotoLain as $foto)
            <div class="carousel-item">
                <img src="{{ asset('storage/' . $foto) }}" class="d-block w-100" alt="Foto {{ $loop->iteration }} {{ $kamar->nama_kamar }}">
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselKamar{{ $kamar->id }}" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Sebelumnya</span>
    </a>
    <a class="carousel-control-next" href="#carouselKamar{{ $kamar->id }}" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Berikutnya</span>
    </a>
</div>

<!-- Thumbnail Selector -->
<div class="d-flex justify-content-center flex-wrap mb-4">
    <img src="{{ asset('storage/' . $kamar->foto_utama) }}" class="img-thumbnail mx-1" style="width: 70px; height: 50px; cursor: pointer;" data-target="#carouselKamar{{ $kamar->id }}" data-slide-to="0">
    @foreach ($fotoLain as $index => $foto)
        <img src="{{ asset('storage/' . $foto) }}" class="img-thumbnail mx-1" style="width: 70px; height: 50px; cursor: pointer;" data-target="#carouselKamar{{ $kamar->id }}" data-slide-to="{{ $index + 1 }}">
    @endforeach
</div>
                                                    <p>{{ $kamar->deskripsi }}</p>
                                                    <b>Fasilitas :</b> {{ $kamar->fasilitas }}</br>
                                                    <b>Harga :</b> Rp {{ number_format($kamar->harga, 0, ',', '.') }}/bulan</br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <!-- End Modal -->

                                <!-- Modal Sewa -->
                                <div class="modal fade" id="sewaModal{{ $kamar->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <form method="POST" action="{{ route('kamars.penyewa_store', $kamar->id) }}"   enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Sewa Kamar</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Tanggal Masuk</label>
                                                        <input type="date" name="tanggal_masuk" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Keluar</label>
                                                        <input type="date" name="tanggal_keluar" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Bukti Pembayaran</label>
                                                        <input type="file" name="bukti_pembayaran" class="form-control" accept="image/*">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info">Sewa</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- End About Section -->
    
    <!-- Modal Sewa -->
    <div class="modal fade" id="harus" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    Data Diri Anda Belum Lengkap, Silahkan Isi Data Diri Terlebih Dahulu
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
                                <!-- End Modal -->
</main>
@endsection
