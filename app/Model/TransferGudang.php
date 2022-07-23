<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TransferGudang extends Model
{
    protected $table = 'transfer_gudang';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    public function dari_gudang(){
        return $this->belongsTo('App\Model\Gudang', 'dari_gudang_id', 'id');
    }
    public function ke_gudang(){
        return $this->belongsTo('App\Model\Gudang', 'ke_gudang_id', 'id');
    }
    public function stok_produk(){
        return $this->belongsTo('App\Model\StokProduk', 'stok_produk_id', 'id');
    }
}
