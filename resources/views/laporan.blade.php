@extends('layouts.layout')
@section('content')
<div class="container-fluid p my-5 mx-2">
    <div class="col-5">
        <div class="card">
            <div class="card-header">
                <h5>Laporan Pemesanan</h5>
            </div>
            <div class="card-body">
                Silahkan Download Laporan Disini, Document Laporan Berbentuk Excel
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end align-content-end">
                    <a href="/pemesanan/excel" class="btn btn-success">Download</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
