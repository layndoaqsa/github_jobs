<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Merek extends Model
{
    protected $table = 'merek';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    public function stokProduk(){
        return $this->hasMany('App\Model\StokProduk', 'merek_id', 'id');
    }
}
