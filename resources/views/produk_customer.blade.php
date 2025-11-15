@extends('layouts.app_customer')

@section('content')
<div class="colorlib-product">
    <div class="container">

        {{-- Judul --}}
        <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
                <h2>All Product</h2>
            </div>
        </div>

        {{-- Tombol Filter --}}
        <div class="text-center mb-4">
            <button class="btn btn-outline-dark filter-btn" data-filter="all">Semua</button>
            @foreach($kategoris as $kategori)
                <button class="btn btn-outline-dark filter-btn" data-filter="{{ Str::slug($kategori->nama_kategori) }}">
                    {{ $kategori->nama_kategori }}
                </button>
            @endforeach
        </div>

        {{-- Produk --}}
        <div class="row row-pb-md">
        @foreach($produks as $produk)
            <div class="col-lg-3 mb-4 text-center produk-item" data-kategori="{{ Str::slug($produk->kategori->nama_kategori ?? 'lainnya') }}">
                <div class="product-entry border p-2">
                    <a href="#" data-toggle="modal" data-target="#produkModal{{ $produk->id_produk }}" class="prod-img">
                        <img src="{{ asset('storage/' . $produk->foto_cover) }}" class="img-fluid" style="height:300px">
                    </a>
                    <div class="desc mt-2">
                        <h2><a href="#">{{ $produk->nama_produk }}</a></h2>
                        <span class="price d-block mb-2">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                        <form action="{{ route('cart') }}" method="POST" class="d-flex justify-content-center align-items-center gap-2">
                            @csrf
                            <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">
                            <input type="number" name="qty" value="1" min="1" class="form-control form-control-sm text-center" style="width: 60px;">
                            <button type="submit" class="btn btn-sm btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Modal --}}
            <div class="modal fade" id="produkModal{{ $produk->id_produk }}" tabindex="-1" role="dialog" aria-labelledby="produkModalLabel{{ $produk->id_produk }}" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-body row">
                    <!-- Carousel -->
                    <div class="col-md-6">
                      <div id="carouselProduk{{ $produk->id_produk }}" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                          @php $fotos = json_decode($produk->foto, true); @endphp
                          @foreach($fotos as $index => $foto)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                              <img src="{{ asset('storage/' . $foto) }}" class="d-block w-100" alt="{{ $foto }}">
                            </div>
                          @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselProduk{{ $produk->id_produk }}" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselProduk{{ $produk->id_produk }}" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                    </div>

                    <!-- Detail -->
                    <div class="col-md-6">
                      <h4>{{ $produk->nama_produk }} <small class="text-muted">({{ $produk->kategori->nama_kategori ?? '-' }})</small></h4>
                      <p class="text-muted">{{ $produk->deskripsi }}</p>
                      <h5 class="text-danger">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h5>
                      <form action="{{ route('cart') }}" method="POST" class="d-flex justify-content-center align-items-center gap-2">
                        @csrf
                        <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">
                        <input type="number" name="qty" value="1" min="1" class="form-control form-control-sm text-center" style="width: 60px;">
                        <button type="submit" class="btn btn-sm btn-primary">Add</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.filter-btn').click(function() {
        var filter = $(this).data('filter');

        if (filter === 'all') {
            $('.produk-item').show();
        } else {
            $('.produk-item').each(function() {
                if ($(this).data('kategori') === filter) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });
});
</script>
@endsection
