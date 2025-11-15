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
                    <h3 class="card-title"><i class="fas fa-info-circle mr-1"></i> Informasi</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addInformasiModal">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <table id="informasiTable" class="table table-bordered table-striped">
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
                        @foreach($informasis as $informasi)
                        <tr>
                            <td>{{ $informasi->judul }}</td>
                            <td>{{ $informasi->deskripsi }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $informasi->foto_informasi) }}" alt="Foto Informasi" width="100">
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm bg-warning" data-toggle="modal" data-target="#editModal{{ $informasi->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('informasis.destroy', $informasi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm bg-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $informasi->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('informasis.update', $informasi->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Informasi</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Judul</label>
                                                <input type="text" name="judul" class="form-control" value="{{ $informasi->judul }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" required>{{ $informasi->deskripsi }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Foto Informasi</label><br>
                                                <img src="{{ asset('storage/' . $informasi->foto_informasi) }}" class="img-thumbnail mb-2" width="150">
                                                <input type="file" name="foto_informasi" class="form-control-file" accept="image/*">
                                                <small class="form-text text-muted">Sneakers Jakarta Storeongkan jika tidak ingin mengganti.</small>
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

<!-- Modal Tambah Informasi -->
<div class="modal fade" id="addInformasiModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('informasis.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Informasi</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Foto Informasi</label>
                        <input type="file" name="foto_informasi"  id="fotoInformasiInput" class="form-control-file" accept="image/*" required>
                        <div id="previewFotoInformasi" class="mt-2"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
    $('#fotoInformasiInput').change(function(e) {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#previewFotoInformasi').html('<img src="'+e.target.result+'" class="img-thumbnail" width="200"/>');
        }
        reader.readAsDataURL(this.files[0]);
    });

});
</script>
@endsection
