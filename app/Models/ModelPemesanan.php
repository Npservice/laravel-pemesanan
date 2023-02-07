<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelPemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';
    protected $fillable = ['kendaraan_id', 'driver_id', 'tanggal_pemesanan', 'nama_pemesan', 'jabatan_pemesan', 'setuju_1', 'setuju_2', 'keterangan_pemesanan'];

    public function createPemesanan($request)
    {
        DB::table('kendaraan')
            ->where('id_kendaraan', $request->kendaraan)
            ->update(['status_kendaraan' => 'booking']);
        DB::table('driver')
            ->where('id_driver', $request->driver)
            ->update(['status_driver' => 'booking']);
        ModelPemesanan::insert([
            'kendaraan_id' => $request->kendaraan,
            'driver_id' => $request->driver,
            'nama_pemesan' => $request->nama_pemesan,
            'tanggal_pemesanan' => $request->tanggal,
            'jabatan_pemesan' => $request->jabatan_pemesan,
            'keterangan_pemesanan' => 'menungu'
        ]);
    }
    public function dataPemesanan()
    {
        $data = DB::table('pemesanan')
            ->join('kendaraan', 'kendaraan.id_kendaraan',  '=', 'pemesanan.kendaraan_id')
            ->join('driver', 'driver.id_driver', '=', 'pemesanan.driver_id')
            ->select()
            ->get();
        return $data;
    }
    public function updatePemesanan($request)
    {
        DB::table('kendaraan')
            ->where('id_kendaraan', $request->kendaraan)
            ->update(['status_kendaraan' => 'booking']);
        DB::table('driver')
            ->where('id_driver', $request->driver)
            ->update(['status_driver' => 'booking']);
        ModelPemesanan::where('id_pemesanan', $request->id)
            ->update([
                'kendaraan_id' => $request->kendaraan,
                'driver_id' => $request->driver,
                'nama_pemesan' => $request->nama_pemesan,
                'tanggal_pemesanan' => $request->tanggal,
                'jabatan_pemesan' => $request->jabatan_pemesan,
            ]);
        return;
    }
}
