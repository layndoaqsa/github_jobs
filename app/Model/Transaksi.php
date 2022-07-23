<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    public function supplier(){
        return $this->belongsTo('App\Model\Supplier', 'supplier_id', 'id');
    }
    public function customer(){
        return $this->belongsTo('App\Model\Customer', 'customer_id', 'id');
    }
    public function transaksi_detail(){
        return $this->hasMany('App\Model\TransaksiDetail', 'transaksi_id', 'id');
    }
    public function transaksi_pembayaran(){
        return $this->hasMany('App\Model\TransaksiPembayaran', 'transaksi_id', 'id');
    }
}
