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
                    <h3 class="card-title"><i class="fas fa-users mr-1"></i> Kamar</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addKamarModal">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <table id="kamarTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Foto Informasi</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($kamars as $kamar)
                        <tr>
                            <td>{{ $kamar->judul }}</td>
                            <td>{{ $kamar->deskripsi }}</td>
                            <td><img src="{{ asset('storage/' . $kamar->foto_informasi) }}" alt="Foto Utama" width="100"></td>
                            
                            <td class="text-center">
                                <!-- Tombol Edit -->
                                <button class="btn btn-sm bg-warning" data-toggle="modal" data-target="#editModal{{ $kamar->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('kamars.destroy', $kamar->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm bg-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $kamar->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <form method="POST" action="{{ route('kamars.update', $kamar->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Data Kamar</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form edit -->
                                            <div class="form-group">
                                                <label>Nama Kamar</label>
                                                <input type="text" name="nama_kamar" class="form-control" value="{{ $kamar->nama_kamar }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tipe Kamar</label>
                                                <input type="text" name="tipe_kamar" class="form-control" value="{{ $kamar->tipe_kamar }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga</label>
                                                <input type="number" name="harga" class="form-control" value="{{ $kamar->harga }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Fasilitas</label>
                                                <input type="text" name="fasilitas" class="form-control" value="{{ $kamar->fasilitas }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" required>{{ $kamar->deskripsi }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control" required>
                                                    <option value="kosong" {{ $kamar->status == 'kosong' ? 'selected' : '' }}>Sneakers Jakarta Storeong</option>
                                                    <option value="terisi" {{ $kamar->status == 'terisi' ? 'selected' : '' }}>Terisi</option>
                                                </select>
                                            </div>

                                            <!-- Foto Utama -->
                                            <div class="form-group">
                                                <label>Foto Utama</label><br>
                                                <img src="{{ asset('storage/' . $kamar->foto_utama) }}" alt="Foto Utama" class="img-thumbnail mb-2" width="150">
                                                <input type="file" name="foto_utama" class="form-control-file" accept="image/*">
                                                <small class="form-text text-muted">Sneakers Jakarta Storeongkan jika tidak ingin mengganti.</small>
                                            </div>

                                            <!-- Foto Lain-lain -->
                                            <div class="form-group">
                                                <label>Foto Lain-lain</label><br>
                                                @php
                                                    $fotoLain = json_decode($kamar->foto_lain_lain, true);
                                                @endphp
                                                @if (!empty($fotoLain))
                                                    <div class="mb-2 d-flex flex-wrap">
                                                        @foreach ($fotoLain as $foto)
                                                            <img src="{{ asset('storage/' . $foto) }}" class="img-thumbnail mr-2 mb-2" width="100">
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <input type="file" name="foto_lain[]" class="form-control-file" accept="image/*" multiple>
                                                <small class="form-text text-muted">Bisa pilih lebih dari satu foto untuk mengganti semua foto lain-lain.</small>
                                            </div>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-warning">Update</button>
                                        </div>
                                    </div>
                                </form>
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
<!-- Modal Tambah Kamar -->
<div class="modal fade" id="addKamarModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('kamars.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Form Inputs -->
                    <div class="form-group">
                        <label>Nama Kamar</label>
                        <input type="text" name="nama_kamar" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tipe Kamar</label>
                        <input type="text" name="tipe_kamar" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Fasilitas</label>
                        <input type="text" name="fasilitas" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="kosong">Sneakers Jakarta Storeong</option>
                            <option value="terisi">Terisi</option>
                        </select>
                    </div>

                    <!-- Foto Utama -->
                    <div class="form-group">
                        <label>Foto Utama</label>
                        <input type="file" name="foto_utama" class="form-control-file" id="fotoUtamaInput" accept="image/*" required>
                        <div id="previewFotoUtama" class="mt-2"></div>
                    </div>

                    <!-- Foto Lain-lain -->
                    <div class="form-group">
                        <label>Foto Lain-lain</label>
                        <div id="fotoLainContainer"></div>
                        <button type="button" class="btn btn-sm btn-success mt-2" id="tambahFotoLain">Tambah Foto</button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- jQuery Preview Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Preview Foto Utama
    $('#fotoUtamaInput').change(function(e) {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#previewFotoUtama').html('<img src="'+e.target.result+'" class="img-thumbnail" width="200"/>');
        }
        reader.readAsDataURL(this.files[0]);
    });

    // Tambah Foto Lain-lain
    $('#tambahFotoLain').click(function() {
        $('#fotoLainContainer').append(`
            <div class="input-group mb-2 foto-lain-item">
                <input type="file" name="foto_lain[]" class="form-control-file fotoLainInput" accept="image/*" required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger btn-hapus-foto">Hapus</button>
                </div>
                <div class="preview-foto-lain mt-2"></div>
            </div>
        `);
    });

    // Hapus Foto Lain-lain
    $('#fotoLainContainer').on('click', '.btn-hapus-foto', function() {
        $(this).closest('.foto-lain-item').remove();
    });

    // Preview Foto Lain-lain
    $('#fotoLainContainer').on('change', '.fotoLainInput', function() {
        let previewDiv = $(this).siblings('.preview-foto-lain');
        let reader = new FileReader();
        reader.onload = (e) => {
            previewDiv.html('<img src="'+e.target.result+'" class="img-thumbnail" width="200"/>');
        }
        reader.readAsDataURL(this.files[0]);
    });
});
</script>

@endsection
