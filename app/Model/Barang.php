<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    public function stokProduk(){
        return $this->hasMany('App\Model\StokProduk', 'barang_id', 'id');
    }
}
