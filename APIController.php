<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inventarisasi;
use App\Models\KartuRuang;
use App\Models\GambarInv;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use App\Services\ImageService;
use Illuminate\Validation\Rule;

class APIController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);
        // Tambahkan role default
        $user->assignRole('admin');
        return response()->json([
            'status' => true,
            'message' => 'Register berhasil',
            'data' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('username', $request->username)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }
        // Generate token
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'status' => true,
            'message' => 'Login berhasil',
            'token'  => $token,
            'user'   => $user
        ]);
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return response()->json([
            'status' => true,
            'message' => 'Jika email terdaftar, link reset akan dikirim.',
        ]);
    }

    public function logout(Request $request)
    {
        // Hapus token yang sedang dipakai
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout berhasil'
        ]);
    }

    public function get_inventarisasi() {
        $data = Inventarisasi::with('kartu_ruang')->latest()->get();
        return response()->json(
            $data->map(function ($item) {
                return [
                    'id' => $item->id,
                    'jenis_barang' => $item->jenis_barang,
                    'keadaan' => $item->keadaan,
                    'ruangan' => $item->kartu_ruang->nama_ruangan,
                ];
            })
        );
    }

    public function search(Request $request) {
        $keyword = $request->keyword;

        $query = DB::table('inventarisasi')
            ->join('kartu_ruang', 'inventarisasi.kartu_ruang_id', '=', 'kartu_ruang.id')
            ->select(
                'inventarisasi.id',
                'inventarisasi.jenis_barang',
                'inventarisasi.gambar',
                'inventarisasi.keadaan',
                'inventarisasi.kartu_ruang_id',
                'kartu_ruang.nama_ruangan as ruangan'
            );

        // 🔹 HANYA tambahkan filter jika keyword ADA
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('inventarisasi.jenis_barang', 'like', "%{$keyword}%")
                ->orWhere('kartu_ruang.nama_ruangan', 'like', "%{$keyword}%");
            });
        }

        $results = $query
            ->orderBy('inventarisasi.id', 'asc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'keyword' => $keyword,
            'data' => $results->items(),
            'pagination' => [
                'current_page' => $results->currentPage(),
                'last_page' => $results->lastPage(),
                'total' => $results->total(),
            ]
        ]);
    }

    public function get_total() {
        $totalBarang = Inventarisasi::count();
        $barangBaik = Inventarisasi::where('keadaan', 'Baik')->count();
        $rusakRingan = Inventarisasi::where('keadaan', 'Kurang Baik')->count();
        $rusakBerat = Inventarisasi::where('keadaan', 'Rusak Berat')->count();
        return response()->json([
            'status' => true,
            'message' => 'Data jumlah barang',
            'data' => [
                'total' => $totalBarang,
                'baik' => $barangBaik,
                'kurang_baik' => $rusakRingan,
                'rusak_berat' => $rusakBerat,
            ]
        ], 200);
    }

    public function get_kartu_ruang() {
        $kartu_ruang = KartuRuang::all();

        return response()->json([
            'status' => true,
            'data' => $kartu_ruang
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kartu_ruang_id' => 'required|exists:kartu_ruang,id',
            'kode_barang'    => 'required|unique:inventarisasi,kode_barang',
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
            'gambar' => 'required|array|min:1|max:4',
            'gambar.*' => 'image|mimes:jpg,jpeg,png',
        ]);

        // Simpan data utama (tanpa gambar)
        $inventarisasi = Inventarisasi::create(
            collect($validated)->except('gambar')->toArray()
        );

        // Upload & kompres gambar
        $files = $request->file('gambar');

        $folderPath = public_path('gambar_barang/'.$inventarisasi->id);
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        foreach ($files as $file) {
            $namaFile = ImageService::compressImage($file, $folderPath);

            GambarInv::create([
                'inv_id' => $inventarisasi->id,
                'gambar' => $namaFile,
            ]);
        }

        // Generate QR
        $qrPath = public_path('qr_codes');
        if (!file_exists($qrPath)) {
            mkdir($qrPath, 0777, true);
        }

        $qrFile = 'qr-'.$inventarisasi->id.'.png';
        $qrUrl  = route('inventarisasi.pdf', $inventarisasi->id);

        QrCode::format('png')->size(300)->generate($qrUrl, $qrPath.'/'.$qrFile);

        $inventarisasi->update(['qr_code' => $qrFile]);

        return response()->json([
            'status'  => true,
            'message' => 'Inventarisasi berhasil disimpan',
            'data'    => $inventarisasi->load('gambar_inv'),
        ], 201);
    }

    public function show($id)
    {
        $item = Inventarisasi::join('kartu_ruang', 'inventarisasi.kartu_ruang_id', '=', 'kartu_ruang.id')
        ->select(
            'inventarisasi.*',
            'kartu_ruang.nama_ruangan as ruangan'
        )
        ->where('inventarisasi.id', $id)
        ->first();

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // 🔹 ambil gambar berdasarkan inventarisasi_id
        $gambar = GambarInv::where('inv_id', $id)->get();

        // 🔹 tempelkan ke object item
        $item->gambar = $gambar;

        return response()->json([
            'success' => true,
            'data' => $item
        ]);

    }

    public function update(Request $request, $id)
    {
        $inventarisasi = Inventarisasi::findOrFail($id);

        $validated = $request->validate([
            'kartu_ruang_id' => 'sometimes|exists:kartu_ruang,id',
            'nama_pemegang' => 'sometimes',

            // gambar baru
            'gambar' => 'sometimes|array|max:4',
            'gambar.*' => 'image|mimes:jpg,jpeg,png|max:2048',

            // gambar lama yang dihapus
            'deleted_images' => 'sometimes|array',
            'deleted_images.*' => 'exists:gambar_inv,id',
        ]);

        // =============================
        // UPDATE DATA NON-GAMBAR
        // =============================
        $inventarisasi->update(
            collect($validated)->except(['gambar', 'deleted_images'])->toArray()
        );

        // =============================
        // HAPUS GAMBAR LAMA
        // =============================
        if ($request->filled('deleted_images')) {
            foreach ($request->deleted_images as $imgId) {
                $img = GambarInv::where('inv_id', $inventarisasi->id)
                    ->where('id', $imgId)
                    ->first();

                if ($img) {
                    $path = public_path("gambar_barang/{$img->inv_id}/{$img->gambar}");
                    if (file_exists($path)) {
                        unlink($path);
                    }
                    $img->delete();
                }
            }
        }

        // =============================
        // TAMBAH GAMBAR BARU
        // =============================
        if ($request->hasFile('gambar')) {

            $existingCount = $inventarisasi->gambar_inv()->count();
            $newFiles = $request->file('gambar');

            if (($existingCount + count($newFiles)) > 4) {
                return response()->json([
                    'status' => false,
                    'message' => 'Total gambar maksimal 4 per inventarisasi',
                ], 422);
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

        // =============================
        // QR CODE (JIKA BELUM ADA)
        // =============================
        if (!$inventarisasi->qr_code) {
            $qrPath = public_path('qr_codes');
            if (!file_exists($qrPath)) {
                mkdir($qrPath, 0777, true);
            }

            $qrFile = 'qr-'.$inventarisasi->id.'.png';
            $qrUrl  = route('inventarisasi.pdf', $inventarisasi->id);

            QrCode::format('png')->size(300)->generate($qrUrl, $qrPath.'/'.$qrFile);
            $inventarisasi->update(['qr_code' => $qrFile]);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Inventarisasi berhasil diperbarui',
            'data'    => $inventarisasi->load('gambar_inv'),
        ], 200);
    }
}
