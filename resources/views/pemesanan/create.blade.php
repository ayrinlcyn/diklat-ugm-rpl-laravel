<!-- resources/views/pemesanan/create.blade.php -->

@extends('layout.template')

@section('content')

    <div class="container">
        <h2>Form Pemesanan</h2>
        <form method="POST" action="{{ route('pemesanan.store') }}">
            @csrf
            <div class="form-group">
                <label for="tanggal_pemesanan">Tanggal Transaksi:</label>
                <input type="date" class="form-control" id="tanggal_pemesanan" name="tanggal_pemesanan" required>
            </div>
            <div class="form-group">
                <label for="toko_id">barang:</label>
                <select class="form-control" id="toko_id" name="toko_id" required>
                    @foreach($toko as $toko)
                        <option value="{{ $toko->id }}">{{ $toko->nama_barang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah Pembelian:</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah_barang" required>
            </div>
            <!-- Tambahkan input lain sesuai kebutuhan -->

            <!-- Tampilan Total Harga -->
            <div class="form-group">
                <label for="total">Total Harga:</label>
                <input type="text" class="form-control" id="total" name="total" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        // Ambil harga barang dari toko yang dipilih dan hitung total otomatis
        document.getElementById('toko_id').addEventListener('change', function () {
            var selectedToko = this.options[this.selectedIndex];
            var hargaBarang = selectedToko.getAttribute('data-harga-barang');
            document.getElementById('total').value = calculateTotal(hargaBarang);
        });

        // Fungsi untuk menghitung total
        function calculateTotal(hargaBarang) {
            var jumlah = parseFloat(document.getElementById('jumlah').value);
            return parseFloat(hargaBarang) * jumlah;
        }
    </script>
@endsection
