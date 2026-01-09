<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KartuRuang;

class KartuRuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kartu_ruang = KartuRuang::orderBy('id', 'desc')->paginate(10)->onEachSide(1);
        return view('kir.index', [
            'pageTitle' => 'Ruangan',
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => route('home')],
                ['label' => 'Ruangan'],
            ],
        ], compact('kartu_ruang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kir.create', [
            'pageTitle' => 'Ruangan',
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => route('home')],
                ['label' => 'Ruangan', 'url' => route('kir.index')],
                ['label' => 'Tambah Ruangan'],
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_ruangan' => 'required',
            'nama_ruangan' => 'required',
        ]);

        KartuRuang::create($validated);
        return redirect()->route('kir.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ruangan = KartuRuang::find($id);
        return view('kir.edit', [
            'pageTitle' => 'Ruangan',
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => route('home')],
                ['label' => 'Ruangan', 'url' => route('kir.index')],
                ['label' => 'Edit Ruangan'],
            ],
        ], compact('ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode_ruangan' => 'required',
            'nama_ruangan' => 'required',
        ]);

        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update($validated);
        return redirect()->route('kir.index')->with('success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();
        return redirect()->route('kir.index')->with('success', 'Data berhasil dihapus');
    }
}
