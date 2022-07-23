<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    public function transaksi(){
        return $this->hasMany('App\Model\Transaksi', 'supplier_id', 'id');
    }
}
