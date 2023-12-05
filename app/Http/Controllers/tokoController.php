<?php

namespace App\Http\Controllers;

use App\Models\toko;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class tokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;

        if(strlen($katakunci)){
            $data = toko::where('kode_barang','like',"%$katakunci%")
            ->orwhere('nama_barang','like',"%$katakunci%")
            ->paginate($jumlahbaris);
        }else{
            $data = toko::orderBy('kode_barang','desc')->paginate($jumlahbaris);
        }
        
        return view('toko.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('toko.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|numeric|unique:toko,kode_barang',
            'nama_barang' => 'required',
            'gambar_barang' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga_barang' => 'required',
            'stok_barang' => 'required',
        ], [
            'kode_barang.required' => 'KODE BARANG WAJIB DI ISI',
            'kode_barang.numeric' => 'KODE BARANG WAJIB DI ISI ANGKA',
            'kode_barang.unique' => 'KODE BARANG SUDAH TERDAFTAR',
            'nama_barang.required' => 'NAMA BARANG WAJIB DI ISI',
            'harga_barang.required' => 'HARGA BARANG WAJIB DI ISI',
            'stok_barang.required' => 'STOK BARANG WAJIB DI ISI',
            'gambar_barang.required' => 'GAMBAR BARANG WAJIB DI ISI',
            'gambar_barang.image' => 'GAMBAR HARUS BERUPA FILE GAMBAR',
            'gambar_barang.mimes' => 'FORMAT GAMBAR HARUS JPEG, PNG, JPG, ATAU GIF',
            'gambar_barang.max' => 'UKURAN GAMBAR TIDAK BOLEH MELEBIHI 2 MB',
        ]);

        $imageName = time() . '.' . $request->gambar_barang->extension();
        $request->gambar_barang->move(public_path('gambarbarang'), $imageName);
        $imagePath = 'gambarbarang/' . $imageName;

        $data = [
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'gambar_barang' => $imagePath,
            'harga_barang' => $request->harga_barang,
            'stok_barang' => $request->stok_barang,
        ];

        toko::create($data);

        return redirect()->route('toko.index')->with('success', 'Berhasil menambahkan data');
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
    public function edit(string $id)
    {
        $data = toko::where('kode_barang', $id)->first();
        return view('toko.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'gambar_barang' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga_barang' => 'required',
            'stok_barang' => 'required',
        ], [
            'nama_barang.required' => 'NAMA BARANG WAJIB DI ISI',
            'gambar_barang.image' => 'GAMBAR HARUS BERUPA FILE GAMBAR',
            'gambar_barang.mimes' => 'FORMAT GAMBAR HARUS JPEG, PNG, JPG, ATAU GIF',
            'gambar_barang.max' => 'UKURAN GAMBAR TIDAK BOLEH MELEBIHI 2 MB',
            'harga_barang.required' => 'HARGA BARANG WAJIB DI ISI',
            'stok_barang.required' => 'STOK BARANG WAJIB DI ISI',
        ]);
        
        

        $imageName = time() . '.' . $request->gambar_barang->extension();
        $request->gambar_barang->move(public_path('gambarbarang'), $imageName);
        $imagePath = 'gambarbarang/' . $imageName;

        $data = [
            'nama_barang' => $request->nama_barang,
            'gambar_barang' => $imagePath,
            'harga_barang' => $request->harga_barang,
            'stok_barang' => $request->stok_barang,
        ];

        toko::where('kode_barang', $id)->update($data);
        return redirect()->to('toko')->with('success', 'Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        toko::where('kode_barang',$id)->delete();
        return redirect()->to('toko')->with('success','Berhasil melakukan delete data');
    }
}   
