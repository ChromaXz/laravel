@extends('admin.layouts.app')
@section('konten')

<div class="container-fluid px-4">
    <h1 class="mt-4">Pelanggan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Tables</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
            <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
            .
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <a href="{{ route('pelanggan.create') }}" class="btn btn-md btn-primary">
                <i class="fa-solid fa-square-plus"></i>
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Email</th>
                        <th>Kartu</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Email</th>
                        <th>Kartu</th>
                        <th>Action</th>
                        
                    </tr>
                </tfoot>
                <tbody>
                    @php $no=1 @endphp
                    @foreach ($pelanggan as $p)
                        
                    
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $p ->kode }}</td>
                        <td>{{ $p ->nama }}</td>
                        <td>{{ $p ->jk }}</td>
                        <td>{{ $p ->tmp_lahir }}</td>
                        <td>{{ $p ->tgl_lahir }}</td>
                        <td>{{ $p ->email }}</td>
                        <td>{{ $p ->kartu->nama }}</td>
                        <td>
                            <a href="{{ route('pelanggan.show', $p->id) }}" class="btn btn-sm btn-success">
                                <i class="fa-solid fa-eye"></i><!--font awesome-->
                            </a>
                            <a href="{{ route('pelanggan.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <!--ini untuk modal hapus-->
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-ms btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $p->id }}">
                                    <i class="fa-solid fa-trash-can"></i><!--font awesome hapus-->
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Produk</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin akan menghapus data {{ $p->nama }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                    <!--form delete-->
                                                    <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection