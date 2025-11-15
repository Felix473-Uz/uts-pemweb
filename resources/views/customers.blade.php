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
                    <h3 class="card-title"><i class="fas fa-users mr-1"></i> Transaksi</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCustomerModal">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <table id="customerTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Show</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->customer_id }}</td>
                                    <td>{!! $customer->customer_name !!}</td>
                                    <td>{{ $customer->customer_phone }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm bg-info" data-toggle="modal" data-target="#showModal{{ $customer->id }}">
                                            <i class="fas fa-info"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm bg-warning" data-toggle="modal" data-target="#editModal{{ $customer->customer_id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('customers.destroy', $customer->customer_id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm bg-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $customer->customer_id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <form method="POST" action="{{ route('customers.update', $customer->customer_id) }}">
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
                                                        <label>Customer ID</label>
                                                        <input type="text" name="customer_id" class="form-control" value="{{ $customer->customer_id }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Customer Name</label>
                                                        <input type="text" name="customer_name" class="form-control" value="{{ $customer->customer_name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input type="number" name="phone" class="form-control" value="{{ $customer->customer_phone }}" required>
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

<!-- Modal Tambah Customer -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('customers.store') }}">
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
                        <label>Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="number" name="phone" class="form-control" value="{{ old('phone') }}" required>
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
