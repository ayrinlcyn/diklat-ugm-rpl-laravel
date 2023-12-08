@extends('layout/template')

@section('content')
    <div class="container">
        <div class="pb-3">

            <a href='{{url('pemesanan/create')}}' class="btn btn-primary">+ Tambah Data</a>
          </div>
        <h2>Detail Pemesanan</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-2">NAMA BARANG</th>
                    <th class="col-md-2">JUMLAH BARANG</th>
                    <th class="col-md-2">TOTAL</th>
                </tr>
            </thead>

            <tbody>
                @foreach($pemesanan as $pesan)
                <tr>
                    <td class="py-5">{{ $pesan->tanggal_pemesanan}}</td>
                </tr>
                <tr>
                    <td class="py-5">{{ $pesan->toko->nama_barang }}</td>
                </tr>
                <tr>
                    <td class="py-5">{{ $pesan->jumlah_barang }}</td>
                </tr>
                <tr>
                    <td class="py-5">{{ $pesan->total }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('pemesanan.index') }}" class="btn btn-primary">Kembali</a>
        @endforeach
    </div>
    {{-- {{dd($pemesanan)}} --}}
@endsection
