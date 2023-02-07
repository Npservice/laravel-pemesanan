<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKendaraan extends Model
{
    use HasFactory;
    protected $table = 'kendaraan';
    protected $primaryKey = 'id_kendaraan';
    protected $fillable = ['nama_kendaraan', 'no_pol', 'status_kendaraan', 'jenis_kendaraan', 'keterangan_kendaraan', 'total_pakasi'];


    public function showKendaraan()
    {
        return ModelKendaraan::all();
    }

    public function updateKendaraan($request)
    {
        ModelKendaraan::where('id_kendaraan', $request->id)
            ->update([
                'nama_kendaraan' => $request->nama_kendaraan,
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'no_pol' => $request->no_pol,
                'keterangan_kendaraan' => $request->keterangan
            ]);
        return;
    }
    public function createKendaraan($request)
    {
        ModelKendaraan::insert([
            'nama_kendaraan' => $request->nama_kendaraan,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'no_pol' => $request->no_pol,
            'status_kendaraan' => 'siap',
            'total_pakai' => 0,
            'keterangan_kendaraan' => $request->keterangan,
        ]);
        return;
    }
    public function status($request)
    {
        ModelKendaraan::where('id_kendaraan', $request->kendaraan_lama)->update(['status_kendaraan' => 'siap']);
        return;
    }
}
