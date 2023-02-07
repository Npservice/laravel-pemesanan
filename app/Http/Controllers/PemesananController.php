<?php

namespace App\Http\Controllers;

use App\Models\ModelDriver;
use App\Models\ModelKendaraan;
use App\Models\ModelPemesanan;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PemesananController extends Controller
{
    protected $Pemesanan;
    protected $kendaraan;
    protected $driver;
    public function __construct()
    {
        $this->Pemesanan = new ModelPemesanan();
        $this->kendaraan = new ModelKendaraan();
        $this->driver = new ModelDriver();
    }
    public function index()
    {
        $content = [
            'title' => 'Pemesanan',
            'data' => $this->Pemesanan->dataPemesanan(),
            'kendaraan' => $this->kendaraan->where('status_kendaraan', 'siap')->get(),
            'driver' => $this->driver->where('status_driver', 'siap')->get(),
        ];
        return view('pemesanan', $content);
    }
    public function create()
    {
        $this->authorize('any', User::class);
        $content = [
            'title' => 'Input | Pemesanan',
            'kendaraan' => $this->kendaraan->where('status_kendaraan', 'siap')->get(),
            'driver' => $this->driver->where('status_driver', 'siap')->get(),
        ];
        return view('create.createPemesanan', $content);
    }
    public function store(Request $request)
    {
        $this->authorize('any', User::class);
        $this->Pemesanan->createPemesanan($request);
        return redirect()->to('/pemesanan')->with('success', 'Pemesanan Kendaraan Berhasil Dilakukan');
    }
    public function update(Request $request,)
    {
        $this->authorize('any', User::class);
        $cek = $this->Pemesanan->where('id_pemesanan', $request->id)->first();
        if ($cek->driver_id !== $request->driver) {
            $this->driver->status($request);
        }
        if ($cek->kendaraan_id != $request->kendaraan) {
            $this->kendaraan->status($request);
        }
        $this->Pemesanan->updatePemesanan($request);
        return redirect()->to('/pemesanan')->with('warning', 'Pemesanan Kendaraan Berhasil Update');
    }
    public function destroy(Request $request)
    {
        $this->authorize('any', User::class);
        $cek = $this->Pemesanan->where('id_pemesanan', $request->id)->first();
        if ($cek->keterangan_pemesanan == 'jalan') {
            return redirect()->to('/pemesanan')->with('danger', 'Kendaraan Masih di Perjalanan, gagal dihapus');
        }
        $this->driver->status($request);
        $this->kendaraan->status($request);
        $this->Pemesanan->where([
            'id_pemesanan' => $request->id
        ])->delete();
        return redirect()->to('/pemesanan')->with('primary', 'Pemesanan Kendaraan Berhasil Dihapus');
    }
    public function laporan()
    {
        $content = [
            'title' => 'Laporan'
        ];
        return view('laporan', $content);
    }
    public function excel()
    {
        $data = $this->Pemesanan->dataPemesanan();
        $spreadsheet = new Spreadsheet;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NO')
            ->setCellValue('B1', 'Nama Pemesan')
            ->setCellValue('C1', 'Jabatan Pemesan')
            ->setCellvalue('D1', 'Tanggal Pemesanan')
            ->setCellValue('E1', 'Nama Kendaraan')
            ->setCellValue('F1', 'No Polisi')
            ->setCellValue('G1', 'Nama Driver')
            ->setCellValue('H1', 'Kode Driver')
            ->setCellValue('I1', 'Persetujuan Manajer')
            ->setCellValue('J1', 'Persetujuan HRD')
            ->setCellValue('K1', 'Keterangan');

        $coloumn = 2;
        $no = 1;
        foreach ($data as $row) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $coloumn, $no++)
                ->setCellValue('B' . $coloumn, $row->nama_pemesan)
                ->setCellValue('C' . $coloumn, $row->jabatan_pemesan)
                ->setCellValue('D' . $coloumn, date('d-m-Y', strtotime($row->tanggal_pemesanan)))
                ->setCellValue('E' . $coloumn, $row->nama_kendaraan)
                ->setCellValue('F' . $coloumn, $row->no_pol)
                ->setCellValue('G' . $coloumn, $row->nama_driver)
                ->setCellValue('H' . $coloumn, $row->kode_driver)
                ->setCellValue('I' . $coloumn, $row->setuju_1)
                ->setCellValue('J' . $coloumn, $row->setuju_2)
                ->setCellValue('K' . $coloumn, $row->keterangan_pemesanan);
            $coloumn++;
        }
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Pemesanan';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
    public function setuju1(Request $request)
    {
        $cek = $this->Pemesanan->where('id_pemesanan', $request->id)->first();
        if ($cek->setuju_2 == null) {
            if ($request->persetujuan_1 == 'tidak setuju') {
                $this->Pemesanan->where('id_pemesanan', $request->id)
                    ->update(['setuju_1' => $request->persetujuan_1, 'setuju_2' => 'tidak setuju', 'keterangan_pemesanan' => 'gagal']);
                return redirect()->to('/pemesanan')->with('success', 'Persetujan Manager Telah Dilakukan');
            } else {
                $this->Pemesanan->where('id_pemesanan', $request->id)
                    ->update(['setuju_1' => $request->persetujuan_1, 'keterangan_pemesanan' => 'menungu']);
                return redirect()->to('/pemesanan')->with('success', 'Persetujan Manager Telah Dilakukan');
            }
        }
    }
    public function setuju2(Request $request)
    {
        $cek = $this->Pemesanan->where('id_pemesanan', $request->id)->first();
        if ($cek->setuju_1 == null) {
            return redirect()->to('/pemesanan')->with('danger', 'Mohon Menungu Persetujuan Manager Dahulu');
        } else {
            if ($cek->setuju_1 == $request->persetujuan_2) {
                if ($request->persetujuan_2 == 'tidak setuju') {
                    $this->Pemesanan->where('id_pemesanan', $request->id)
                        ->update(['setuju_2' => $request->persetujuan_2, 'keterangan_pemesanan' => 'gagal']);
                    return redirect()->to('/pemesanan')->with('success', 'Persetujan HRD Telah Dilakukan');
                } else {
                    $this->driver->where('id_driver', $cek->driver_id)->update(['status_driver' => 'dipesan']);
                    $kend = $this->kendaraan->where('id_kendaraan', $cek->kendaraan_id)->first();
                    $total = (int)$kend->total_pakai + 1;
                    $this->kendaraan->where('id_kendaraan', $cek->kendaraan_id)->update(['status_kendaraan' => 'dipesan', 'total_pakai' => $total]);
                    $this->Pemesanan->where('id_pemesanan', $request->id)
                        ->update(['setuju_2' => $request->persetujuan_2, 'keterangan_pemesanan' => 'berhasil']);
                    return redirect()->to('/pemesanan')->with('success', 'Persetujan HRD Telah Dilakukan');
                }
            } else {
                $this->Pemesanan->where('id_pemesanan', $request->id)
                    ->update(['setuju_2' => $request->persetujuan_2, 'keterangan_pemesanan' => 'gagal']);
                return redirect()->to('/pemesanan')->with('success', 'Persetujan HRD Telah Dilakukan');
            }
        }
    }
}
