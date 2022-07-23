<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StokProdukKategori extends Model
{
    protected $table = 'stok_produk_kategori';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];
    
    public function stok_produk(){
        return $this->belongsTo('App\Model\StokProduk', 'stok_produk_id', 'id');
    }
    
    public function kategori(){
        return $this->belongsTo('App\Model\Kategori', 'kategori_id', 'id');
    }
}
