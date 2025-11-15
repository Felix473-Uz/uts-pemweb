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
                    <h3 class="card-title"><i class="fas fa-users mr-1"></i> Produk</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProdukModal">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <table id="produkTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Foto Cover</th>
                                <th>Foto </th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($produks as $produk)
                        <tr>
                            <td>{{ $produk->nama_produk }}</td>
                            <td>{{ $produk->kategori->nama_kategori }}</td>
                            <td>{{ $produk->deskripsi }}</td>
                            <td>{{ $produk->harga }}</td>
                            <td><img src="{{ asset('storage/' . $produk->foto_cover) }}" alt="Foto Utama" width="100"></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#fotoModal{{ $produk->id_produk }}">
                                    <i class="fas fa-images"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <!-- Tombol Edit -->
                                <button class="btn btn-sm bg-warning" data-toggle="modal" data-target="#editModal{{ $produk->id_produk }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('produk.destroy', $produk->id_produk) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm bg-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Carousel Foto Produk -->
                        <div class="modal fade" id="fotoModal{{ $produk->id_produk }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Foto Produk </h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @php $fotoLain = json_decode($produk->foto, true); @endphp
                                        @if (!empty($fotoLain))
                                        <div id="carousel{{ $produk->id_produk }}" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($fotoLain as $i => $foto)
                                                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $foto) }}" class="d-block w-100" alt="Foto {{ $i+1 }}">
                                                </div>
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#carousel{{ $produk->id_produk }}" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carousel{{ $produk->id_produk }}" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                        @else
                                        <p class="text-center">Tidak ada foto lain untuk produk ini.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $produk->id_produk }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <form method="POST" action="{{ route('produk.update', $produk->id_produk) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Data Produk</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <!-- Form Inputs -->
                                        <div class="form-group">
                                            <label>Nama Produk</label>
                                            <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select name="id_kategori" class="form-control" required>
                                                <?php foreach($kategoris as $kategori){?>
                                                    <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" required>{{ $produk->deskripsi }}</textarea>
                                        </div>
                                        
                                        <!-- Foto Utama -->
                                            <div class="form-group">
                                                <label>Foto Cover</label><br>
                                                <img src="{{ asset('storage/' . $produk->foto_cover) }}" alt="Foto Cover" class="img-thumbnail mb-2" width="150">
                                                <input type="file" name="foto_cover" class="form-control-file" accept="image/*">
                                                <small class="form-text text-muted">Sneakers Jakarta Storeongkan jika tidak ingin mengganti.</small>
                                            </div>

                                            <!-- Foto Lain-lain -->
                                            <div class="form-group">
                                                <label>Foto Lain-lain</label><br>
                                                @php
                                                    $fotoLain = json_decode($produk->foto, true);
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
<!-- Modal Tambah Produk -->
<div class="modal fade" id="addProdukModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
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
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_kategori" class="form-control" required>
                            <?php foreach($kategoris as $kategori){?>
                                <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" required></textarea>
                    </div>

                    <!-- Foto Utama -->
                    <div class="form-group">
                        <label>Foto Cover</label>
                        <input type="file" name="foto_cover" class="form-control-file" id="fotoCoverInput" accept="image/*" required>
                        <div id="previewFotoCover" class="mt-2"></div>
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
    $('#fotoCoverInput').change(function(e) {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#previewFotoCover').html('<img src="'+e.target.result+'" class="img-thumbnail" width="200"/>');
        }
        reader.readAsDataURL(this.files[0]);
    });

    // Tambah Foto Lain-lain
    $('#tambahFotoLain').click(function() {
        $('#fotoLainContainer').append(`
            <div class="input-group mb-2 foto-lain-item">
                <input type="file" name="foto[]" class="form-control-file fotoLainInput" accept="image/*" required>
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
