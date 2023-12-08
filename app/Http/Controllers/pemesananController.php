<?php

namespace App\Http\Controllers;
use App\Models\pemesanan;
use App\Models\toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemesanan = pemesanan::all();
        return view('pemesanan.index', ['pemesanan' => $pemesanan]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $toko = toko::all();
        return view('pemesanan.create', compact('toko'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pemesanan' => 'required|date',
            'toko_id' => 'required|exists:toko,id',
            'jumlah_barang' => 'required|numeric',
            
        ]);

        // Ambil data toko berdasarkan toko_id
        $toko = toko::find($request->toko_id);

        // Hitung total berdasarkan harga barang toko dan jumlah pesanan
        $total = $toko->harga_barang * $request->jumlah_barang;

        // Simpan data pemesanan ke dalam database
        $pemesanan = new Pemesanan();
        $pemesanan->tanggal_pemesanan = $request->tanggal_pemesanan;
        $pemesanan->toko_id = $request->toko_id;
        $pemesanan->jumlah_barang = $request->jumlah_barang;
        $pemesanan->total = $total;
        $pemesanan->save();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil');
    }

    /**
     * Display the specified resource.
     */
    // Pada metode show di PemesananController
    public function show(string $id)
    {
        // $pemesanan = pemesanan::find($id);
        // return view('pemesanan.show', compact('pemesanan'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data toko berdasarkan id
        $pemesanan = pemesanan::find($id);

        // Tampilkan form edit dengan data pemesanan
        return view('pemesanan.edit', compact('pemesanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Proses update jika diperlukan
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Proses penghapusan jika diperlukan
    }
}
