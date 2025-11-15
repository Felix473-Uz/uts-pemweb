@extends('layouts.app_customer')

@section('content')
<div class="colorlib-product">
			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-md-12">
						<div class="product-name d-flex">
							<div class="one-eight "></div>
							<div class="one-forth text-left px-4">
								<span>Detail Produk</span>
							</div>
							<div class="one-eight text-center">
								<span>Harga Satuan</span>
							</div>
							<div class="one-eight text-center">
								<span>Jumlah</span>
							</div>
							<div class="one-eight text-center">
								<span>Total</span>
							</div>
						</div>
                        <?php $total=0;foreach($checkout as $c){?>
						<div class="product-cart d-flex">
							<div class="one-eight "></div>
							<div class="one-forth">
								<div class="product-img" style="background-image: url({{ asset('storage/' . $c->produk->foto_cover) }});">
								</div>
								<div class="display-tc">
									<h3><?=$c->produk->nama_produk?></h3>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<span class="price">Rp {{ number_format($c->produk->harga, 0, ',', '.') }}</span>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<input type="text" id="quantity" name="quantity" class="form-control input-number text-center" value="<?=$c->qty?>" min="1" max="100" readonly>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<span class="price">Rp <?= number_format(($c->qty*$c->produk->harga), 0, ',', '.') ?></span>
								</div>
							</div>
						</div>
                        <?php $total += ($c->qty*$c->produk->harga);}?>
					</div>
				</div>
				<div class="row row-pb-lg">
					<div class="col-md-12">
						<div class="total-wrap">
							<div class="row">
								<div class="col-sm-8">
									<form action="#">
										<div class="row form-group">
											<div class="col-sm-2">
											</div>
											<div class="col-sm-3">
												<button id="pay-button"  class="btn btn-primary" style="background-color:#FE3810; border:0;">Checkout</button>
											</div>
										</div>
									</form>
								</div>
								<div class="col-sm-4 text-center">
									<div class="total">
										<div class="grand-total">
											<p><span><strong>Total:</strong></span> <span>Rp <?= number_format(($total), 0, ',', '.') ?></span></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
        <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function () {
            snap.pay("{{ $snapToken }}", {
            onSuccess: function(result) {
                window.location.href = "{{ route('payment') }}";
            }

            });
        });
        </script>
@endsection

