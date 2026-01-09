<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventarisasi;
use Illuminate\Support\Facades\DB;
use App\Models\KartuRuang;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $totalBarang = Inventarisasi::count();
        $barangBaik = Inventarisasi::where('keadaan', 'Baik')->count();
        $rusakRingan = Inventarisasi::where('keadaan', 'Kurang Baik')->count();
        $rusakBerat = Inventarisasi::where('keadaan', 'Rusak Berat')->count();
        
        $keyword = $request->keyword;

        if ($keyword) {
            // Query barang (jenis_barang)
            $q1 = DB::table('inventarisasi')
                ->join('kartu_ruang', 'inventarisasi.kartu_ruang_id', '=', 'kartu_ruang.id')
                ->select(
                    'inventarisasi.*',
                    'kartu_ruang.nama_ruangan AS ruangan'
                )
                ->where('inventarisasi.jenis_barang', 'like', "%$keyword%");

            // Query ruangan
            $q2 = DB::table('inventarisasi')
                ->join('kartu_ruang', 'inventarisasi.kartu_ruang_id', '=', 'kartu_ruang.id')
                ->select(
                    'inventarisasi.*',
                    'kartu_ruang.nama_ruangan AS ruangan'
                )
                ->where('kartu_ruang.nama_ruangan', 'like', "%$keyword%");

            // Gabungkan query
            $results = $q1
                ->unionAll($q2)
                ->orderBy('id', 'asc')
                ->paginate(10);
        } else {
            $results = null;
        }

        return view('home', [
            'pageTitle' => 'Dashboard',
            'breadcrumb' => [
                ['label' => 'Dashboard'],
            ],
        ], compact('totalBarang', 'barangBaik', 'rusakRingan', 'rusakBerat', 'results', 'keyword'));
    }
}
