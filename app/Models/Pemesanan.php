<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesanan extends Model
{
    use HasFactory;
    protected $table = "pemesanan";
    protected $primaryKey = "id";
    protected $fillable = ['id','tanggal_pemesanan','toko_id','jumlah_barang','total'];

    public function toko(){
        return $this->belongsTo(toko::class);
    }
}
