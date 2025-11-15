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
                    <h3 class="card-title"><i class="fas fa-users mr-1"></i> Pemesanan</h3>
                    <div class="card-tools">
                        <button id="downloadExcel" class="btn btn-success mb-3">
                            <i class="fas fa-file-excel"></i> Download Excel
                        </button>

                    </div>
                </div>
                
                <div class="card-body">
                    <form method="GET" action="{{ route('pemesanans.index') }}" class="form-inline mb-3">
                        <div class="form-group mr-2">
                            <label for="bulan" class="mr-2">Bulan</label>
                            <select name="bulan" id="bulan" class="form-control">
                                <option value="">-- Semua Bulan --</option>
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group mr-2">
                            <label for="tahun" class="mr-2">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control">
                                <option value="">-- Semua Tahun --</option>
                                @for ($y = date('Y'); $y >= 2020; $y--)
                                    <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>

                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <table id="pemesananTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Pemesan</th>
                                <th>Kamar</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Status Pembayaran</th>
                                <th>Tanggal Konfirmasi</th>
                                <th>Bukti Pembayaran</th>
                                @if(Auth::user()->role === "admin")
                                <th class="no-export">Delete</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemesanans as $pemesanan)
                                <tr>
                                <td>{{ $pemesanan->penyewa->nama ?? '-' }}</td>
                                <td>{{ $pemesanan->kamar->nama_kamar ?? '-' }}</td>
                                <td>{{ $pemesanan->tanggal_masuk ?? '-' }}</td>
                                <td>{{ $pemesanan->tanggal_keluar ?? '-' }}</td>
                                <td>{{ $pemesanan->status_pembayaran ?? '-' }}</td>
                                <td>{{ $pemesanan->konfirmasiPembayaran->tanggal_konfirmasi ?? '-' }}</td>
                                <td>
                                    @if(!empty($pemesanan->bukti_pembayaran))
                                        <img src="{{ asset('storage/' . $pemesanan->bukti_pembayaran) }}" 
                                            alt="Bukti Pembayaran" 
                                            width="100" 
                                            class="img-thumbnail zoomable" 
                                            data-toggle="modal" 
                                            data-target="#zoomModal" 
                                            data-image="{{ asset('storage/' . $pemesanan->bukti_pembayaran) }}">


                                    @else
                                        -
                                    @endif
                                </td>
                                @if(Auth::user()->role === "admin")
                                    <td class="text-center no-export">
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
    </section>
</div>
                                        <!-- Modal Zoom Image -->
<div class="modal fade" id="zoomModal" tabindex="-1" role="dialog" aria-labelledby="zoomModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="" id="modalImage" class="img-fluid" alt="Zoomed Image">
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
    $('#downloadExcel').click(function () {
        // Sembunyikan kolom dengan class "no-export"
        $('.no-export').hide();

        // Clone tabel tanpa kolom delete
        let tableClone = $('#pemesananTable').clone();

        // Export dengan SheetJS
        let wb = XLSX.utils.table_to_book(tableClone[0], { sheet: "Pemesanan" });
        XLSX.writeFile(wb, 'pemesanan.xlsx');

        // Tampilkan kembali kolom "no-export"
        $('.no-export').show();
    });
    $(document).on('click', '.zoomable', function () {
        const imageSrc = $(this).data('image');
        $('#modalImage').attr('src', imageSrc);
    });
</script>


@endsection
