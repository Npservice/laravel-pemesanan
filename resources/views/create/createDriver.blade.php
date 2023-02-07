@extends('layouts.layout')
@section('content')
<div class="container-fluid mb-3">
    <center>
        <h4>FORM DRIVER</h4>
    </center>
    <hr>
    <form action="/driver/store" method="post">
        @csrf
        <div class="form-group row">
            <label for="nama_driver" class="col-sm-2 col-form-label">Nama Driver</label>
            <div class="col-sm-10">
                <input type="text" name="nama_driver" class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Kode Driver</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="kode_driver" name="kode_driver" value="{{$kode}}"
                    readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Keterangan</label>
            <div class="col-sm-10">
                <select type="text" class="form-control" name="keterangan" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="Baru">Baru</option>
                    <option value="Lama">Lama</option>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-end align-content-end">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
</div>
@endsection
