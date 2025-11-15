@extends('layouts.app_penyewa')

@section('content')
<main id="main" class="mt-5" style="min-height:600px">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                @foreach($informasis as $informasi)
                    <div class="col-4 mb-4" style="padding:15px">
                        <div class="card">
                            <div class="card-header text-center" style="padding:0px">
                                <img class="card-img-top" src="{{ asset('storage/' . $informasi->foto_informasi) }}" alt="Card image" style="width:100%;height:300px">
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <h6 class="card-title text-center fw-bold mb-2">{{ $informasi->judul }}</h6>
                                    
                                    <p class="text-muted small text-justify mb-3">
                                        {{ \Illuminate\Support\Str::limit($informasi->deskripsi, 150, '...') }}
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-sm btn-outline-info w-45" data-toggle="modal" data-target="#detailModal{{ $informasi->id }}">
                                            Lihat Detail
                                        </button>
                                        
                                    </div>
                                </div>

                                <!-- Modal Sewa -->
                                <div class="modal fade" id="detailModal{{ $informasi->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Informasi</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    
                                                    <div class="d-flex justify-content-center flex-wrap mb-4">
                                                        <img src="{{ asset('storage/' . $informasi->foto_informasi) }}" class="img-thumbnail mx-1" style="width: 70px; height: 50px; cursor: pointer;" data-target="#carouselInformasi{{ $informasi->id }}" data-slide-to="0">
                                                    </div>
                                                    <p>{{ $informasi->deskripsi }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
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
</main>
@endsection
