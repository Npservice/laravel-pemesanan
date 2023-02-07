<?php

namespace App\Models;

use App\Models\ModelDriver as ModelsModelDriver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\In;
use SebastianBergmann\CodeCoverage\Driver\Driver;

class ModelDriver extends Model
{
    use HasFactory;
    protected $table = 'driver';
    protected $primaryKey = 'id_driver';
    protected $fillable = ['nama_driver', 'kode_driver', 'status_driver', 'keterengan_driver'];

    public function showDriver()
    {
        return ModelDriver::all();
    }
    public function updateDriver($request)
    {
        ModelDriver::where('id_driver', $request->id)
            ->update([
                'nama_driver' => $request->nama_driver,
                'kode_driver' => $request->kode_driver,
                'keterangan_driver' => $request->keterangan,
            ]);

        return;
    }
    public function createDriver($request)
    {
        ModelDriver::insert([
            'nama_driver' => $request->nama_driver,
            'kode_driver' => $request->kode_driver,
            'status_driver' => 'siap',
            'keterangan_driver' => $request->keterangan
        ]);
        return;
    }
    public function status($request)
    {
        ModelDriver::where('id_driver', $request->driver_lama)->update(['status_driver' => 'siap']);
        return;
    }
}
