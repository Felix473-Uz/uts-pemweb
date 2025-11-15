@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-file-invoice-dollar mr-1"></i> Daftar Transaksi</h3>
                </div>
                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <table id="transaksiTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksis as $transaksi)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d-m-Y H:i') }}</td>
                                    <td>{{ $transaksi->user->name ?? 'Tidak diketahui' }}</td>
                                    <td>{{ ucfirst($transaksi->status) }}</td>
                                    <td>
                                        Rp{{ number_format($transaksi->detail->sum(function ($item) {
                                            return $item->qty * ($item->produk->harga ?? 0);
                                        }), 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal{{ $transaksi->id_transaksi }}">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                                <!-- MODAL DETAIL -->
                                <div class="modal fade" id="detailModal{{ $transaksi->id_transaksi }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $transaksi->id_transaksi }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="detailModalLabel{{ $transaksi->id_transaksi }}">Detail Transaksi #{{ $transaksi->id_transaksi }}</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="row font-weight-bold border-bottom pb-2 mb-2">
                                                        <div class="col-md-4">Produk</div>
                                                        <div class="col-md-2">Harga</div>
                                                        <div class="col-md-2">Qty</div>
                                                        <div class="col-md-4">Subtotal</div>
                                                    </div>
                                                    @php $grandTotal = 0; @endphp
                                                    @foreach($transaksi->detail as $detail)
                                                        @php
                                                            $harga = $detail->produk->harga ?? 0;
                                                            $subtotal = $harga * $detail->qty;
                                                            $grandTotal += $subtotal;
                                                        @endphp
                                                        <div class="row mb-2">
                                                            <div class="col-md-4">{{ $detail->produk->nama_produk ?? '-' }}</div>
                                                            <div class="col-md-2">Rp{{ number_format($harga, 0, ',', '.') }}</div>
                                                            <div class="col-md-2">{{ $detail->qty }}</div>
                                                            <div class="col-md-4">Rp{{ number_format($subtotal, 0, ',', '.') }}</div>
                                                        </div>
                                                    @endforeach
                                                    <div class="row border-top pt-3 mt-3 font-weight-bold">
                                                        <div class="col-md-8 text-right">Grand Total:</div>
                                                        <div class="col-md-4">Rp{{ number_format($grandTotal, 0, ',', '.') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
