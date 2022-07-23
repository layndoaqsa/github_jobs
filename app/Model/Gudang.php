<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $table = 'gudang';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    public function stok_produk(){
        return $this->hasMany('App\Model\StokProdukGudang', 'gudang_id', 'id');
    }
    public function dari_gudang(){
        return $this->hasMany('App\Model\TransferGudang', 'dari_gudang_id', 'id');
    }
    public function ke_gudang(){
        return $this->hasMany('App\Model\TransferGudang', 'ke_gudang_id', 'id');
    }
}
