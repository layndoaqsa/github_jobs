<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    public function transaksi(){
        return $this->hasMany('App\Model\Transaksi', 'customer_id', 'id');
    }
}
