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
                    <h3 class="card-title"><i class="fas fa-users mr-1"></i> Penyewa</h3>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <table id="penyewaTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Nik</th>
                                <th>Foto KTP</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penyewas as $penyewa)
                                <tr>
                                    <td>{{ $penyewa->user->username }}</td>
                                    <td>{{ $penyewa->user->email }}</td>
                                    <td>{{ $penyewa->nama }}</td>
                                    <td>{{ $penyewa->alamat }}</td>
                                    <td>{{ $penyewa->nik }}</td>
                                    <td>@if($penyewa->foto_ktp !== '-')
                                        <img src="{{ asset('storage/' . $penyewa->foto_ktp) }}" alt="KTP" width="100">
                                    @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                    @endif</td>
                                    <td class="text-center">
                                        <form action="{{ route('penyewas.destroy', $penyewa->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm bg-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $penyewa->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <form method="POST" action="{{ route('penyewas.update', $penyewa->id) }}"  enctype="multipart/form-data">
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah Penyewa -->
<div class="modal fade" id="addPenyewaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('penyewas.store') }}" enctype="multipart/form-data">
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
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Penyewa</label>
                        <input type="text" name="nama" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" value="" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="number"name="nik" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Foto KTP</label>
                        <input type="file" name="foto_ktp" class="form-control" accept="image/*">
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
