<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventarisasi;
use App\Models\KartuRuang;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $ruangan = KartuRuang::orderBy('nama_ruangan')->get();

        $url = route('laporan.cetak', ['nama_ruangan' => $ruangan]);
        $qr = \QrCode::size(250)->generate($url);

        return view('laporan.index', [
            'pageTitle' => 'Laporan',
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => route('home')],
                ['label' => 'Laporan'],
            ],
        ], compact('qr', 'url', 'ruangan'));
    }

    public function cetak(Request $request)
    {
        $ruangId = $request->get('kartu_ruang_id');

        $query = Inventarisasi::with('kartu_ruang')
            ->orderBy('id');

        if ($ruangId) {
            $query->where('kartu_ruang_id', $ruangId);
        }

        // ⚠️ BATASI DATA
        $inventarisasi = $query->get();

        $pdf = \Pdf::loadView('laporan.cetak', compact('inventarisasi'))
            ->setPaper('legal', 'landscape');

        return $pdf->stream('laporan-inventarisasi-per-ruangan.pdf');
    }
}
