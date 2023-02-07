<?php

namespace App\Http\Controllers;

use App\Models\ModelKendaraan;
use App\Models\ModelPemesanan;
use App\Models\User;
use Illuminate\Http\Request;


class KendaraanController extends Controller
{

    protected $kendaraan;
    protected $pememsanan;
    public function __construct()
    {
        $this->kendaraan = new ModelKendaraan();
        $this->pememsanan = new ModelPemesanan();
    }
    public function index()
    {

        $content = [
            'title'  => 'Kendaraan',
            'data' =>  $this->kendaraan->showKendaraan()
        ];
        return view('kendaraan', $content);
    }
    public function create()
    {
        $this->authorize('any', User::class);
        $content = [
            'title' => 'Input | Kendaraan',
        ];
        return view('create.createKendaraan', $content);
    }
    public function store(Request $request)
    {
        $this->authorize('any', User::class);
        $request->validate(
            [
                'no_pol' => 'unique:kendaraan,no_pol',
            ],
            [
                'unique' => 'Nomer Polisi Sudah Ada'
            ]
        );
        $this->kendaraan->createKendaraan($request);
        return redirect()->to('/kendaraan')->with('success', 'Data berhasil ditambah');
    }
    public function update(Request $request)
    {
        $this->authorize('any', User::class);
        $this->kendaraan->updateKendaraan($request);
        return redirect()->back()->with('warning', 'Data berhasil diupdate');
    }
    public function destroy(Request $request)
    {
        $this->authorize('any', User::class);
        $cek = $this->pememsanan
            ->where('kendaraan_id', '=', $request->id)
            ->get();
        foreach ($cek as $cekAkhir) {
            $kendaraan_id = $cekAkhir->kendaraan_id;
        }
        if (empty($kendaraan_id)) {
            $this->kendaraan->destroy([
                'id_kendaraaan' => $request->id
            ]);
            return redirect()->back()->with('primary', 'Kendaraan berhasil  dihapus');
        } else {
            return redirect()->back()->with('danger', 'Kendaraan Telah di Pesan, Data Gagal dihapus');
        }
    }
}
