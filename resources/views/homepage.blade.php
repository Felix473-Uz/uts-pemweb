@extends('layouts.app_customer')

@section('content')
    <aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url({{ asset('assets_customer/images/sjs.jpg') }});">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">Langkah Nyaman, Gaya Maksimal</h1>
					   					<p class="category"><span>Temukan koleksi sepatu terbaru untuk segala aktivitasmu – dari kasual hingga formal, semua ada di sini.</span></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url({{ asset('assets_customer/images/sjs2.jpg') }});">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">Sneakers Jakarta Store Online Terpercaya</h1>
					   					<p class="category"><span>Belanja sepatu premium dengan mudah, aman, dan cepat. Nikmati promo dan diskon setiap hari!</span></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url({{ asset('assets_customer/images/sjs3.jpg') }})">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">Jejak Gaya Dimulai di Sini</h1>
					   					<p class="category"><span>Koleksi eksklusif sepatu pria dan wanita dengan desain kekinian dan kualitas terbaik, hanya satu klik dari rumahmu.</span></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>
		<div class="colorlib-about">
			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-sm-6 mb-3">
						<div class="video colorlib-video" style="background-image: url({{ asset('assets_customer/images/about.jpg') }});">
						</div>
					</div>
					<div class="col-sm-6">
              <div class="about-wrap">
                  <h2>Sneakers Jakarta Store - Sneakers Jakarta Store Online Terpercaya</h2>
                  <p>Selamat datang di <strong>Sneakers Jakarta Store</strong>, tempat terbaik untuk menemukan sepatu berkualitas yang cocok untuk setiap aktivitas dan gaya hidup Anda. Kami percaya bahwa sepatu bukan hanya kebutuhan, tapi juga bagian penting dari identitas dan kenyamanan Anda.</p>
                  <p>Dengan berbagai pilihan sepatu untuk pria dan wanita, kami menghadirkan koleksi yang stylish, nyaman, dan tahan lama. Belanja di Sneakers Jakarta Store mudah dan aman, dengan dukungan layanan pelanggan yang ramah dan pengiriman cepat ke seluruh Indonesia.</p>
              </div>
          </div>

				</div>
			</div>
		</div>

		<div class="colorlib-product">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
						<h2>Best Sellers</h2>
					</div>
				</div>
				<div class="row row-pb-md">
          <?php foreach($produks as $produk){?>
            <div class="col-lg-3 mb-4 text-center">
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



          <?php }?>
					
				</div>
				<div class="row">
					<div class="col-md-12 text-center">
						<p><a href="{{route('produk_customer')}}" class="btn btn-primary btn-lg">Shop All Products</a></p>
					</div>
				</div>
			</div>
		</div>
@endsection

