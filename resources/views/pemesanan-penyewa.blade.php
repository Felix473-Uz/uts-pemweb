@extends('layouts.app_penyewa')

@section('content')
<main id="main" class="mt-5" style="min-height:600px">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
    <div class="container">
        <div class="container-fluid">
            <div class="card" style="background-color:rgba(255,255,255,0.5)">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users mr-1"></i> Pemesanan</h3>
                </div>
                <div class="card-body" style="background-color:rgba(255,255,255,0.5)">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <table id="pemesananTable" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th>Pemesan</th>
                                <th>Kamar</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Status Pembayaran</th>
                                <th>Bukti Pembayaran</th>
                                @if(Auth::user()->role === "admin")
                                <th>Delete</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemesanans as $pemesanan)
                                <tr>
                                <td>{{ $pemesanan->penyewa->nama ?? '-' }}</td>
                                <td>{{ $pemesanan->kamar->nama_kamar ?? '-' }}</td>
                                <td>{{ $pemesanan->tanggal_pemesanan ?? '-' }}</td>
                                <td>{{ $pemesanan->tanggal_masuk ?? '-' }}</td>
                                <td>{{ $pemesanan->tanggal_keluar ?? '-' }}</td>
                                <td>{{ $pemesanan->status_pembayaran ?? '-' }}</td>
                                <td>
                                    @if(!empty($pemesanan->konfirmasiPembayaran->bukti_pembayaran))
                                        <img src="{{ asset('storage/' . $pemesanan->konfirmasiPembayaran->bukti_pembayaran) }}" alt="Payment Image" width="100">
                                    @else
                                        -
                                    @endif
                                </td>
                                @if(Auth::user()->role === "admin")
                                    <td class="text-center">
                                        <form action="{{ route('pemesanans.destroy', $pemesanan->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm bg-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                @endif
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section><!-- End About Section -->


    

  </main>

@endsection
