@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Pemesanan</h1>
    <hr>
    <div class="col-6 mb-3">
        <div class="card">
            <div class="card-header">
                NB
            </div>
            <div class="card-body">
                <span>Persetujuan 1 = Persetujan Manager Tranportasi</span>
                <br />
                <span>Persetujuan 2 = Persetujan HRD</span>
            </div>
        </div>
    </div>
    @if (Auth::User()->role == 'admin')
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
    @endif
    @if ($message = Session::get('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pemesanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="2200px" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemesan</th>
                            <th>Jabatan</th>
                            <th>Tanggal</th>
                            <th>Kendaraan</th>
                            <th>Jenis Kendaraan</th>
                            <th>No Pol</th>
                            <th>Nama Driver</th>
                            <th>Kode Driver</th>
                            <th>Persetujuan 1</th>
                            <th>Persetujuan 2</th>
                            <th>Keteranagn</th>
                            <th>Opsi</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemesan</th>
                            <th>Jabatan</th>
                            <th>Tgl Pemesanan</th>
                            <th>Kendaraan</th>
                            <th>Jenis Kendaraan</th>
                            <th>No Pol</th>
                            <th>Nama Driver</th>
                            <th>Kode Driver</th>
                            <th>Persetujuan 1</th>
                            <th>Persetujuan 2</th>
                            <th>Keterangan</th>
                            <th>Opsi</th>
                        </tr>
                    </tfoot>
                    @php
                    $no =1;
                    @endphp
                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$row->nama_pemesan}}</td>
                            <td>{{$row->jabatan_pemesan}}</td>
                            <td>{{ date('d-m-Y',strtotime($row->tanggal_pemesanan))}}</td>
                            <td>{{$row->nama_kendaraan}}</td>
                            <td>{{$row->jenis_kendaraan}}</td>
                            <td>{{$row->no_pol}}</td>
                            <td>{{$row->nama_driver}}</td>
                            <td>{{$row->kode_driver}}</td>
                            <td>{{$row->setuju_1}}</td>
                            <td>{{$row->setuju_2}}</td>
                            <td>
                                <center>
                                    <h5>{{$row->keterangan_pemesanan}}</h5>
                                </center>
                            </td>
                            <td>
                                @if (Auth::User()->role == 'admin')
                                <center>
                                    <button class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete{{$row->id_pemesanan}}"><i
                                            class="fas fa-trash"></i></button>
                                    <button class="btn btn-success" class="btn btn-primary" data-toggle="modal"
                                        data-target="#update{{$row->id_pemesanan}}"><i class="fas fa-edit"></i></button>
                                </center>
                                @endif
                                @if (Auth::User()->role == 'atasan')
                                <center>
                                    <button class="btn btn-success" data-toggle="modal"
                                        data-target="#cek{{$row->id_pemesanan}}"><i class="fas fa-check "></i></button>
                                </center>
                                @endif
                            </td>
                        </tr>
                        @if (Auth::User()->status == 'manager')
                        <div class="modal fade" id="cek{{$row->id_pemesanan}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Persetujuan Manager</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/pemesanan/setuju/1" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$row->id_pemesanan}}">
                                            <select name="persetujuan_1" class="form-control" id="" required>
                                                <option selected disabled value="">Choose..</option>
                                                <option value="setuju">Setuju</option>
                                                <option value="tidak setuju">Tidak Setuju</option>
                                            </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if (Auth::User()->status == 'human')
                        <div class="modal fade" id="cek{{$row->id_pemesanan}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Persetujuan HRD</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/pemesanan/setuju/2" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$row->id_pemesanan}}">
                                            <select name="persetujuan_2" class="form-control" id="" required>
                                                <option selected disabled value="">Choose..</option>
                                                <option value="setuju">Setuju</option>
                                                <option value="tidak setuju">Tidak Setuju</option>
                                            </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if (Auth::User()->role == 'admin')
                        <!-- update -->
                        <div class="modal fade" id="update{{$row->id_pemesanan}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/pemesanan/update" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$row->id_pemesanan}}">
                                            <input type="hidden" name="kendaraan_lama" value="{{$row->kendaraan_id}}">
                                            <input type="hidden" name="driver_lama" value="{{$row->driver_id}}">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Pemesan</label>
                                                <input type="text" class="form-control" name="nama_pemesan"
                                                    value="{{$row->nama_pemesan}}" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Jabatan Pemesan</label>
                                                <input type="text" class="form-control" name="jabatan_pemesan"
                                                    value="{{$row->jabatan_pemesan}}" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tanggal Pemesanan</label>
                                                <input type="date" class="form-control" name="tanggal"
                                                    value="{{$row->tanggal_pemesanan}}" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Kendaraan</label>
                                                <select type="text" class="form-control" name="kendaraan">
                                                    <option value="{{$row->id_kendaraan}}">{{$row->nama_kendaraan}}
                                                    </option>
                                                    @foreach ($kendaraan as $a )
                                                    <option value="{{$a->id_kendaraan}}">{{$a->nama_kendaraan}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Driver</label>
                                                <select type="text" class="form-control" name="driver"
                                                    id="exampleInputPassword1" required>
                                                    <option value="{{$row->id_driver}}">
                                                        {{$row->nama_driver}}</option>
                                                    @foreach ($driver as $b )
                                                    <option value="{{$b->id_driver}}">{{$b->nama_driver}}</option>
                                                    @endforeach
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
                        {{-- --}}
                        {{-- delete --}}
                        <!-- Modal -->
                        <div class="modal fade" id="delete{{$row->id_pemesanan}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apa Anda yakin Menghapus Pemesanan Kendaraan Ini ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <form action="/pemesanan/delete" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$row->id_pemesanan}}">
                                            <input type="hidden" name="kendaraan_lama" value="{{$row->kendaraan_id}}">
                                            <input type="hidden" name="driver_lama" value="{{$row->driver_id}}">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- --}}
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
