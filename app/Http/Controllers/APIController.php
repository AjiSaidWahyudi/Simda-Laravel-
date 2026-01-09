<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inventarisasi;
use App\Models\KartuRuang;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

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
                    'harga' => $item->harga,
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
            'kode_barang' => 'required',
            'kode_register' => 'required',
            'jenis_barang' => 'required',
            'merek_tipe' => 'required',
            'no_seri' => 'required',
            'bahan' => 'required',
            'cara_perolehan' => 'required',
            'tahun_beli' => 'required',
            'ukuran' => 'required',
            'satuan' => 'required',
            'keadaan' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Upload foto barang
        $fotoName = null;

        if ($request->hasFile('gambar')) {
            $fotoName = time() . '-' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('gambar_barang'), $fotoName);
        }

        $validated['gambar'] = $fotoName;

        // Create initial data
        $inventarisasi = Inventarisasi::create($validated);

        // Create QR folder
        $qrPath = public_path('qr_codes');
        if (!file_exists($qrPath)) {
            mkdir($qrPath, 0777, true);
        }

        // Generate QR
        $qrFile = 'qr-' . $inventarisasi->id . '.png';
        $qrUrl = route('inventarisasi.pdf', $inventarisasi->id);

        QrCode::format('png')
            ->size(300)
            ->generate($qrUrl, $qrPath . '/' . $qrFile);

        $inventarisasi->update([
            'qr_code' => $qrFile,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Inventarisasi berhasil disimpan',
            'data' => $inventarisasi
        ], 201);
    }

    public function show($id)
    {
        $item = DB::table('inventarisasi')
        ->join('kartu_ruang', 'inventarisasi.kartu_ruang_id', '=', 'kartu_ruang.id')
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

    return response()->json([
        'success' => true,
        'data' => $item
    ]);
    }

    public function update(Request $request, $id)
    {
        $inventarisasi = Inventarisasi::findOrFail($id);

        // Validasi fleksibel: hanya field yang dikirim yang divalidasi
        $validated = $request->validate([
            'kartu_ruang_id' => 'sometimes|exists:kartu_ruang,id',
            'gambar' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // =============================
        // 1. Update gambar jika ada
        // =============================
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama jika ada
            if ($inventarisasi->gambar && file_exists(public_path('gambar_barang/' . $inventarisasi->gambar))) {
                unlink(public_path('gambar_barang/' . $inventarisasi->gambar));
            }

            $fotoName = time() . '-' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('gambar_barang'), $fotoName);

            $validated['gambar'] = $fotoName;
        }

        // Update field yang dikirim
        $inventarisasi->update($validated);


        // =============================
        // 2. Generate QR jika belum ada
        // =============================

        if (!$inventarisasi->qr_code) {

            $qrPath = public_path('qr_codes');
            if (!file_exists($qrPath)) {
                mkdir($qrPath, 0777, true);
            }

            $qrFile = 'qr-' . $inventarisasi->id . '.png';
            $qrUrl = route('inventarisasi.pdf', $inventarisasi->id);

            QrCode::format('png')
                ->size(300)
                ->generate($qrUrl, $qrPath . '/' . $qrFile);

            $inventarisasi->update([
                'qr_code' => $qrFile
            ]);
        }



        // =============================
        // 3. Response
        // =============================
        return response()->json([
            'status' => true,
            'message' => 'Inventarisasi berhasil diperbarui',
            'data' => $inventarisasi
        ], 200);
    }
}
