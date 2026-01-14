<?php

namespace App\Http\Controllers;

use App\Models\Inventarisasi;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use PDF;
use App\Models\KartuRuang;
use App\Models\GambarInv;
use App\Services\ImageService;

class InventarisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Inventarisasi::query();

        if ($request->filled('keadaan')) {
            $query->where('keadaan', $request->keadaan);
        }

        $inventarisasi = $query->orderBy('id', 'desc')->paginate(10)->onEachSide(1);
        return view('inventarisasi.index', [
            'pageTitle' => 'Inventarisasi',
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => route('home')],
                ['label' => 'Inventarisasi'],
            ],
        ], compact('inventarisasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ruangan = KartuRuang::all();
        return view('inventarisasi.create', [
            'pageTitle' => 'Tambah Inventarisasi',
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => route('home')],
                ['label' => 'Inventarisasi', 'url' => route('inventarisasi.index')],
                ['label' => 'Tambah Inventarisasi'],
            ],
        ], compact('ruangan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kartu_ruang_id' => 'required|exists:kartu_ruang,id',
            'kode_barang' => 'required|unique:inventarisasi,kode_barang',
            'kode_register' => 'required',
            'jenis_barang' => 'required',
            'nama_pemegang' => 'required',
            'merek_tipe' => 'required',
            'no_seri' => 'required',
            'bahan' => 'required',
            'cara_perolehan' => 'required',
            'tahun_beli' => 'required',
            'ukuran' => 'required',
            'satuan' => 'required',
            'keadaan' => 'required',
            'jumlah' => 'required',
            'harga' => 'required|numeric',
            'keterangan' => 'required',
            'gambar' => 'required|array|max:4',
            'gambar.*' => 'image|mimes:jpg,jpeg,png',
        ]);

        // jangan ikutkan gambar
        $inventarisasi = Inventarisasi::create(
            collect($validated)->except('gambar')->toArray()
        );

        // === CEK MAKS 4 GAMBAR (SEBELUM LOOP) ===
        $files = $request->file('gambar');
        if (count($files) > 4) {
            return back()->withErrors(['gambar' => 'Maksimal 4 gambar per inventarisasi']);
        }

        // === UPLOAD MULTI GAMBAR ===
        $folderPath = public_path('gambar_barang/'.$inventarisasi->id);
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        foreach ($files as $file) {
            $namaFile = ImageService::compressImage($file, $folderPath);

            GambarInv::create([
                'inv_id' => $inventarisasi->id, // ✅ konsisten
                'gambar' => $namaFile,
            ]);
        }

        // === QR CODE ===
        $qrPath = public_path('qr_codes');
        if (!file_exists($qrPath)) {
            mkdir($qrPath, 0777, true);
        }

        $qrFile = 'qr-' . $inventarisasi->id . '.png';
        $qrUrl = route('inventarisasi.pdf', $inventarisasi->id);

        QrCode::format('png')
            ->size(300)
            ->generate($qrUrl, $qrPath.'/'.$qrFile);

        $inventarisasi->update(['qr_code' => $qrFile]);

        return redirect()
            ->route('inventarisasi.index')
            ->with('success', 'Data berhasil disimpan');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $inventarisasi = Inventarisasi::findOrFail($id);
        return view('inventarisasi.show', [
            'pageTitle' => 'Detail Inventarisasi',
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => route('home')],
                ['label' => 'Inventarisasi', 'url' => route('inventarisasi.index')],
                ['label' => 'Detail Inventarisasi'],
            ],
        ],compact('inventarisasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $inventarisasi = Inventarisasi::findOrFail($id);
        $ruangan = KartuRuang::all();
        return view('inventarisasi.edit', [
            'pageTitle' => 'Edit Inventarisasi',
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => route('home')],
                ['label' => 'Inventarisasi', 'url' => route('inventarisasi.index')],
                ['label' => 'Edit Inventarisasi'],
            ],
        ], compact('inventarisasi', 'ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $inventarisasi = Inventarisasi::findOrFail($id);

        $validated = $request->validate([
            'kartu_ruang_id' => 'required|exists:kartu_ruang,id',
            'kode_barang' => 'required|unique',
            'kode_register' => 'required',
            'jenis_barang' => 'required',
            'nama_pemegang' => 'required',
            'merek_tipe' => 'required',
            'no_seri' => 'required',
            'bahan' => 'required',
            'cara_perolehan' => 'required',
            'tahun_beli' => 'required',
            'ukuran' => 'required',
            'satuan' => 'required',
            'keadaan' => 'required',
            'jumlah' => 'required',
            'harga' => 'required|numeric',
            'keterangan' => 'required',
            'gambar' => 'nullable|array|max:4',
            'gambar.*' => 'image|mimes:jpg,jpeg,png',
        ]);

        // Update data utama
        $inventarisasi->update(
            collect($validated)->except('gambar')->toArray()
        );

        // === JIKA ADA GAMBAR BARU ===
        if ($request->hasFile('gambar')) {

            $existingCount = $inventarisasi->gambar_inv()->count();
            $newFiles = $request->file('gambar');

            if (($existingCount + count($newFiles)) > 4) {
                return back()->withErrors([
                    'gambar' => 'Total gambar maksimal 4 per inventarisasi'
                ]);
            }

            $folderPath = public_path('gambar_barang/'.$inventarisasi->id);
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            foreach ($newFiles as $file) {
                $namaFile = ImageService::compressImage($file, $folderPath);

                GambarInv::create([
                    'inv_id' => $inventarisasi->id,
                    'gambar' => $namaFile,
                ]);
            }
        }

        // === REGENERATE QR (AMAN) ===
        $qrPath = public_path('qr_codes');
        if (!file_exists($qrPath)) {
            mkdir($qrPath, 0777, true);
        }

        if ($inventarisasi->qr_code && file_exists($qrPath.'/'.$inventarisasi->qr_code)) {
            unlink($qrPath.'/'.$inventarisasi->qr_code);
        }

        $qrFile = 'qr-' . $inventarisasi->id . '.png';
        $qrUrl = route('inventarisasi.pdf', $inventarisasi->id);

        QrCode::format('png')
            ->size(300)
            ->generate($qrUrl, $qrPath.'/'.$qrFile);

        $inventarisasi->update(['qr_code' => $qrFile]);

        return redirect()
            ->route('inventarisasi.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $inventarisasi = Inventarisasi::findOrFail($id);

        // Hapus file QR jika ada
        if ($inventarisasi->qr_code) {
            $qrPath = public_path('qr_codes/' . $inventarisasi->qr_code);

            if (file_exists($qrPath)) {
                unlink($qrPath); // hapus file fisik
            }
        }

        // Hapus foto barang jika ada
        $folderPath = public_path('gambar_barang/'.$inventarisasi->id);
        if (\File::exists($folderPath)) {
            \File::deleteDirectory($folderPath);
        }

        // Hapus data dari database
        $inventarisasi->delete();

        return redirect()->route('inventarisasi.index')
                        ->with('success', 'Data berhasil dihapus');
    }

    public function cetakviaqr($id)
    {
        $inv = Inventarisasi::with('kartu_ruang')->findOrFail($id);

        $pdf = PDF::loadView('inventarisasi.pdf', compact('inv'));

        return $pdf->stream('Inventaris-'.$inv->id.'.pdf');
    }

    
    public function print($id)
    {
        $inventarisasi = Inventarisasi::findOrFail($id);

        // Path QR PNG
        $qrPath = public_path('qr_codes/' . $inventarisasi->qr_code);

        // Pastikan file PNG ada
        if (file_exists($qrPath)) {
            $qrData = base64_encode(file_get_contents($qrPath));
            $inventarisasi->qr_base64 = 'data:image/png;base64,' . $qrData;
        } else {
            $inventarisasi->qr_base64 = null;
        }

        // Generate PDF
        $pdf = Pdf::loadView('inventarisasi.print', compact('inventarisasi'))
                    ->setPaper('A4', 'portrait');

        return $pdf->download('qr-' . $inventarisasi->kode_barang . '.pdf');
    }

}
