@extends('layouts.app_penyewa')

@section('content')
<div class="content-wrapper">

    <section class="content mt-5" >
        <div class="container-fluid mt-3">
        <div class="row" >
                <div class="col-3"></div>    
                <div class="col-6">
                    <div class="card" style="background-color:rgba(255,255,255,0.5)">
                    <div class="card-body">
                        <p><b>Nama</b> : {{ $penyewa->nama }}</p>
                        <p><b>Email</b> : {{ $penyewa->user->email }}</p>
                        <p><b>Nomor Telepon</b> : {{ $penyewa->user->no_telepon }}</p>
                        <p><b>Alamat</b> : {{ $penyewa->alamat }}</p>
                        <p><b>NIK</b> : {{ $penyewa->nik }}</p>
                        <p><b>Foto KTP</b> :</p><p>  @if($penyewa->foto_ktp !== '-')
                            <img src="{{ asset('storage/' . $penyewa->foto_ktp) }}" alt="KTP" width="300">
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                        
                        <div align="center"><button class="btn btn-sm bg-warning" data-toggle="modal" data-target="#editModal{{ $penyewa->id }}">
                            Edit
                        </button></div>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal{{ $penyewa->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <form method="POST" action="{{ route('penyewa.penyewa_update', $penyewa->id) }}"  enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Data</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Username</label>
                                                            <input type="" name="username" class="form-control" value="{{ $penyewa->user->username }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nomor Telepon</label>
                                                            <input type="number" name="no_telepon" class="form-control" value="{{ $penyewa->user->no_telepon }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" name="email" class="form-control" value="{{ $penyewa->user->email }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Password</label>
                                                            <input type="password" name="password" class="form-control" value="" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Penyewa</label>
                                                            <input type="text" name="nama" class="form-control" value="{{ $penyewa->nama }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Alamat</label>
                                                            <textarea name="alamat" class="form-control"  required>{{ $penyewa->alamat }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>NIK</label>
                                                            <input type="number" name="nik" class="form-control" value="{{ $penyewa->nik }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Foto KTP</label>
                                                            <input type="file" name="foto_ktp" class="form-control" accept="image/*">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-warning">Edit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                    </div>
                </div>
                <div class="col-3"></div>   
        </div>
            
        </div>
    </section>
</div>

<!-- Modal Tambah Kamar -->
<div class="modal fade" id="addKamarModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('kamars.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kamar</label>
                        <input type="text" name="nama_kamar" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Tipe Kamar</label>
                        <input type="text" name="tipe_kamar" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Fasilitas</label>
                        <input type="text" name="fasilitas" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="kosong">kosong</option>
                            <option value="terisi">terisi</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan data</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
