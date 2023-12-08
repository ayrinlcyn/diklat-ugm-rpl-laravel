<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class toko extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $fillable =['id','kode_barang', 'nama_barang', 'kategori_id', 'gambar_barang', 'harga_barang', 'stok_barang'];
    protected $table = 'toko';
    public $timestamps = false;

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function pemesaanan(){
        return $this->hasMany(pemesanan::class);
    }
    
}
