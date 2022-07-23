<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TransaksiPembayaran extends Model
{
    protected $table = 'transaksi_pembayaran';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    public function transaksi(){
        return $this->belongsTo('App\Model\Transaksi', 'transaksi_id', 'id');
    }
}
