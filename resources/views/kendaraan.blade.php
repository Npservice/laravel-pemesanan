@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kendaraan</h1>
    <hr>
    @if (Auth::User()->role == 'admin')
    @if ($message = Session::get('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if ($message = Session::get('primary'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kendaraan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kendaraan</th>
                            <th>Jenis Kendaraan</th>
                            <th>No Polisi</th>
                            <th>Status</th>
                            <th>Total Pakai</th>
                            <th>Keterangan</th>
                            @if (Auth::User()->role == 'admin')
                            <th>Opsi</th>
                            @endif
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Kendaraan</th>
                            <th>Jenis Kendaraan</th>
                            <th>No Polisi</th>
                            <th>Status</th>
                            <th>Total Pakai</th>
                            <th>Keterangan</th>
                            @if (Auth::User()->role == 'admin')
                            <th>Opsi</th>
                            @endif
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                        $no =1
                        @endphp
                        @foreach ($data as $row )
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$row->nama_kendaraan}}</td>
                            <td>{{$row->jenis_kendaraan}}</td>
                            <td>{{$row->no_pol}}</td>
                            <td>{{$row->status_kendaraan}}</td>
                            <td>
                                <center>
                                    {{$row->total_pakai}}
                                </center>
                            </td>
                            <td>{{$row->keterangan_kendaraan}}</td>
                            @if (Auth::User()->role == 'admin')
                            <td>
                                <center>
                                    <button class="btn btn-danger" class="btn btn-primary" data-toggle="modal"
                                        data-target="#del{{$row->id_kendaraan}}"><i class="fas fa-trash"></i></button>
                                    <button class="btn btn-success" data-toggle="modal"
                                        data-target="#update{{$row->id_kendaraan}}"><i class="fas fa-edit"></i></button>
                                </center>
                            </td>
                            @endif
                        </tr>
                        @if (Auth::User()->role == 'admin')
                        {{-- delete --}}
                        <div class="modal fade" id="del{{$row->id_kendaraan}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apa anda yakin menghapus data kendaraan
                                        <strong>{{$row->nama_kendaraan}}</strong> dengan nomer
                                        polisi <strong>{{$row->no_pol}}</strong> ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <form action="/kendaraan/delete" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$row->id_kendaraan}}">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- update --}}
                        <div class="modal fade" id="update{{$row->id_kendaraan}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Kendaraan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/kendaraan/update" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$row->id_kendaraan}}">
                                            <div class="form-group">
                                                <label for="nama_kendaraan">Nama Kendaran</label>
                                                <input type="text" class="form-control" name="nama_kendaraan"
                                                    value="{{$row->nama_kendaraan}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_kendaraan">Jenis Kendaran</label>
                                                <select type="text" class="form-control" name="jenis_kendaraan"
                                                    required>
                                                    <option value="{{$row->jenis_kendaraan}}">{{$row->jenis_kendaraan}}
                                                    </option>
                                                    <option value="Bus">Bus</option>
                                                    <option value="Truck">Truck</option>
                                                    <option value="Mobil">Mobil</option>
                                                    <option value="Mini Bus">Mini Bus</option>
                                                    <option value="Dump Truck">Dump Truck</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nomer">No Polisi</label>
                                                <input type="text" class="form-control" name="no_pol"
                                                    value="{{$row->no_pol}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="keterangn">Keterangan</label>
                                                <select type="text" class="form-control" name="keterangan" required>
                                                    <option value="{{$row->keterangan_kendaraan}}">
                                                        {{$row->keterangan_kendaraan}}</option>
                                                    <option value="lama">lama</option>
                                                    <option value="baru">baru</option>
                                                </select>
                                            </div>
                                            <div class="d-flex justify-content-end align-content-end">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
