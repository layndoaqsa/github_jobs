<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StokProdukGudang extends Model
{
    protected $table = 'stok_produk_gudang';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];
    
    public function stok_produk(){
        return $this->belongsTo('App\Model\StokProduk', 'stok_produk_id', 'id');
    }
    
    public function gudang(){
        return $this->belongsTo('App\Model\Gudang', 'gudang_id', 'id');
    }

    public function transaksi_detail(){
        return $this->hasMany('App\Model\TransaksiDetail', 'stok_produk_gudang_id', 'id');
    }
}
