@extends('layouts.app_customer')

@section('content')
    <div class="colorlib-about">
        <div class="container">
            <h2 class="mb-4">Riwayat Transaksi Saya</h2>

            @if($transaksis->isEmpty())
                <p>Belum ada transaksi.</p>
            @else
                @foreach ($transaksis as $transaksi)
                    @php
                        $grandTotal = 0;
                    @endphp
                    <div class="card mb-3">
                        <div class="card-header text-white" style="background-color:#FE3810">
                            <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d-m-Y H:i') }} |
                            <strong>Status:</strong> {{ ucfirst($transaksi->status) }}
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach ($transaksi->detail as $item)
                                    @php
                                        $harga = $item->produk->harga ?? 0;
                                        $subtotal = $harga * $item->qty;
                                        $grandTotal += $subtotal;
                                    @endphp
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <img src="{{ asset('storage/' . $item->produk->foto_cover) }}" class="img-fluid" style="height:80px">
                                            </div>
                                            <div>
                                                <strong>{{ $item->produk->nama_produk ?? 'Produk tidak ditemukan' }}</strong><br>
                                                <small>Harga: Rp{{ number_format($harga, 0, ',', '.') }}</small><br>
                                                <small>Qty: {{ $item->qty }}</small>
                                            </div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div>
                                                <strong>Subtotal: Rp{{ number_format($subtotal, 0, ',', '.') }}</strong>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="text-right mt-3">
                                <strong>Grand Total: Rp{{ number_format($grandTotal, 0, ',', '.') }}</strong>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
