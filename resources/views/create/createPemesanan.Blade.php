@extends('layouts.layout')
@section('content')
<div class="container-fluid my-3">
    <center>
        <h4>FORM PEMESANAN</h4>
    </center>
    <hr>
    <form action="/pemesanan/store" method="POST">
        @csrf
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationDefault01">Kendaraan</label>
                <select type="text" class="form-control" name="kendaraan" required>
                    <option selected disabled value="">Choose..</option>
                    @foreach ($kendaraan as $a )
                    <option value="{{$a->id_kendaraan}}">{{$a->nama_kendaraan}}</option>
                    @endforeach
                    <select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationDefault02">Driver</label>
                <select type="text" class="form-control" name="driver" required>
                    <option selected diasabled value="">Choose..</option>
                    @foreach ($driver as $b )
                    <option value="{{$b->id_driver}}">{{$b->nama_driver}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationDefault05">Tanggal Pemesanan</label>
                <input type="date" class="form-control" name="tanggal" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationDefault03">Nama Pemesan</label>
                <input type="text" class="form-control" name="nama_pemesan" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationDefault04">Jabatan Pemesan</label>
                <select class="custom-select" name="jabatan_pemesan" id="validationDefault04" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="Distributor">Distributor</option>
                    <option value="Driver Truck">Driver Truck</option>
                    <option value="Staff">Staff</option>
                    <option value="Satpam">Satpam</option>
                    <option value="Karyawan">Karyawan</option>
                    <option value="Office boy">Office Boy</option>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-end align-content-end">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>
</div>
@endsection
