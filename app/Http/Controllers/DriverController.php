<?php

namespace App\Http\Controllers;

use App\Models\ModelDriver;
use App\Models\ModelPemesanan;
use App\Models\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    protected $driver;
    protected $pemesanan;
    public function __construct()
    {
        $this->driver = new ModelDriver();
        $this->pemesanan = new ModelPemesanan();
    }
    public function index()
    {
        $content = [
            'title' => 'Driver',
            'data' => $this->driver->showDriver()
        ];
        return view('driver', $content);
    }
    public function create()
    {
        $this->authorize('any', User::class);
        $max = $this->driver->whereRaw('kode_driver =(select max(`kode_driver`)from driver)')->first();
        $kdAwal = str_replace('DRIV', '', $max->kode_driver);
        $kdCount = (int)$kdAwal + 1;
        $kodedriver = 'DRIV' . sprintf('%04s', $kdCount);
        $content = [
            'title' => 'Input | Driver',
            'kode' => $kodedriver
        ];
        return view('create.createDriver', $content);
    }
    public function store(Request $request)
    {
        $this->authorize('any', User::class);
        $this->driver->createDriver($request);
        return redirect()->to('/driver')->with('success', 'Driver berhasil ditambah');
    }
    public function update(Request $request,)
    {
        $this->authorize('any', User::class);
        $this->driver->updateDriver($request);
        return redirect()->back()->with('warning', 'Driver berhasil diupdate');
    }
    public function destroy(Request $request)
    {
        $this->authorize('any', User::class);
        $cek = $this->pemesanan
            ->where('driver_id', '=', $request->id)
            ->get();
        foreach ($cek as $cekAkhir) {
            $driver_id = $cekAkhir->driver_id;
        }
        if (empty($driver_id)) {
            $this->driver->destroy([
                'id_driver' => $request->id
            ]);
            return redirect()->back()->with('primary', 'Driver berhasil  dihapus');
        } else {
            return redirect()->back()->with('danger', 'Driver  Telah Dipesan, Data Gagal dihapus');
        }
    }
}
