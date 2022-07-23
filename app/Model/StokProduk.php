<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StokProduk extends Model
{
    protected $table = 'stok_produk';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    public function merek(){
        return $this->belongsTo('App\Model\Merek', 'merek_id', 'id');
    }
    public function barang(){
        return $this->belongsTo('App\Model\Barang', 'barang_id', 'id');
    }
    public function kategori(){
        return $this->hasMany('App\Model\StokProdukKategori', 'stok_produk_id', 'id');
    }
    public function gudang(){
        return $this->hasMany('App\Model\StokProdukGudang', 'stok_produk_id', 'id');
    }
    public function transfer_gudang(){
        return $this->hasMany('App\Model\TransferGudang', 'stok_produk_id', 'id');
    }
}
