<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $table = 'transaksi_detail';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    public function transaksi(){
        return $this->belongsTo('App\Model\Transaksi', 'transaksi_id', 'id');
    }
    public function stok_produk_gudang(){
        return $this->belongsTo('App\Model\StokProdukGudang', 'stok_produk_gudang_id', 'id');
    }
}
