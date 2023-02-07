<?php

namespace App\Http\Controllers;

use App\Models\ModelDriver;
use App\Models\ModelKendaraan;
use App\Models\ModelPemesanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        foreach (ModelKendaraan::all() as $data) {
            $nama[] = $data->nama_kendaraan;
            $total[] = $data->total_pakai;
        }
        $content = [
            'title' => 'Dashboard',
            'kendaraan' => $nama,
            'total' => $total,
            'totalKendaraan' => ModelKendaraan::count(),
            'totalDriver' => ModelDriver::count(),
            'totalPemesanan' => ModelPemesanan::count(),
            'manager' => ModelPemesanan::where('setuju_1', null)->count(),
            'human' => ModelPemesanan::where(['setuju_1' => 'setuju', 'setuju_2' => null])->count(),
        ];
        return view('dashboard', $content);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
