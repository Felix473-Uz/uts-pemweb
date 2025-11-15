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
                    <h3 class="card-title"><i class="fas fa-users mr-1"></i> Konfirmasi Pembayaran</h3>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <table id="konfirmasiPembayaranTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Pemesan</th>
                                <th>Kamar</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Harga</th>
                                <th>Bukti Pembayaran</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($konfirmasiPembayarans as $konfirmasiPembayaran)
                                <tr>
                                    <td>{{ $konfirmasiPembayaran->penyewa->nama }}</td>
                                    <td>{{ $konfirmasiPembayaran->kamar->nama_kamar }}</td>
                                    <td>{{ $konfirmasiPembayaran->tanggal_masuk }}</td>
                                    <td>{{ $konfirmasiPembayaran->tanggal_keluar }}</td>
                                    <td>{{ $konfirmasiPembayaran->kamar->harga }}</td>
                                    <td>
                                        @if(!empty($konfirmasiPembayaran->bukti_pembayaran))
                                            <img src="{{ asset('storage/' . $konfirmasiPembayaran->bukti_pembayaran) }}" 
                                                alt="Bukti Pembayaran" 
                                                width="100" 
                                                class="img-thumbnail zoomable" 
                                                data-toggle="modal" 
                                                data-target="#zoomModal" 
                                                data-image="{{ asset('storage/' . $konfirmasiPembayaran->bukti_pembayaran) }}">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" action="{{ route('konfirmasi_pembayarans.store') }}" >
                                            @csrf
                                            <input type="hidden" name="id_pemesanan" class="form-control" value="<?= $konfirmasiPembayaran->id?>" required>
                                            <button class="btn btn-sm bg-info" type="submit">
                                                TERIMA
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" action="{{ route('konfirmasi_pembayarans.destroy') }}" >
                                            @csrf
                                            <input type="hidden" name="id_pemesanan" class="form-control" value="<?= $konfirmasiPembayaran->id?>" required>
                                            <button class="btn btn-sm bg-danger" type="submit">
                                                TOLAK
                                            </button>
                                        </form>
                                    </td>
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
    $(document).on('click', '.zoomable', function () {
        const imageSrc = $(this).data('image');
        $('#modalImage').attr('src', imageSrc);
    });
</script>


@endsection