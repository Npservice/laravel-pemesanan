@extends('layouts.layout')
@section('content')
<div class="container-fluid mb-3">
    <center>
        <h4>FORM KENDARAAN</h4>
    </center>
    <hr>
    @error('no_pol')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @enderror
    <form action="/kendaraan/store" method="POST">
        @csrf
        <div class="form-group row">
            <label for="nama_kendaraan" class="col-sm-2 col-form-label">Nama Kendaraan</label>
            <div class="col-sm-10">
                <input type="text" name="nama_kendaraan" class="form-control" value="{{old('nama_kendaraan')}}"
                    required>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama_kendaraan" class="col-sm-2 col-form-label">Jenis Kendaraan</label>
            <div class="col-sm-10">
                <select type="text" name="jenis_kendaraan" class="form-control" required>
                    <option selected disabled value="">Choose..</option>
                    <option value="Bus">Bus</option>
                    <option value="Truck">Truck</option>
                    <option value="Mobil">Mobil</option>
                    <option value="Mini Bus">Mini Bus</option>
                    <option value="Dump Truck">Dump Truck</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama_kendaraan" class="col-sm-2 col-form-label">Nomer Polisi</label>
            <div class="col-sm-10">
                <input type="text" name="no_pol" class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama_kendaraan" class="col-sm-2 col-form-label">Keterangan</label>
            <div class="col-sm-10">
                <select type="text" name="keterangan" class="form-control" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="Baru">Baru</option>
                    <option value="Bekas">Bekas</option>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-end align-content-end">
            <button class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
