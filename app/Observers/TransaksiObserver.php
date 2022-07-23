<?php

namespace App\Observers;

use App\Model\Transaksi;
use App\Model\TransaksiPembayaran;

class TransaksiObserver
{
        /**
     * Handle the transaksi detail "created" event.
     *
     * @param  \App\Transaksi  $transaksi
     * @return void
     */
    public function created(Transaksi $transaksi)
    {
        // if ($transaksi->dibayar > 0) {
        //     $data = new TransaksiPembayaran;
        //     $data->transaksi_id         = $transaksi->id;
        //     $data->total_pembayaran     = $transaksi->dibayar;
        //     $data->tanggal_pembayaran   = \Carbon\Carbon::createFromDate($transaksi->tanggal_transaksi)->addMinutes(1);
        //     $transaksi->created_by      = auth()->user()->id;
        //     $data->save();
        // }
    }

    /**
     * Handle the transaksi detail "updated" event.
     *
     * @param  \App\Transaksi  $transaksi
     * @return void
     */
    public function updated(Transaksi $transaksi)
    {
        // if($transaksi->isDirty('dibayar')){
        //     $data = TransaksiPembayaran::where('transaksi_id',$transaksi->id)->first();
        //     if (empty($data)) {
        //         if ($transaksi->dibayar > 0) {
        //             $data = new TransaksiPembayaran;
        //             $data->transaksi_id         = $transaksi->id;
        //             $data->total_pembayaran     = $transaksi->dibayar;
        //             $data->tanggal_pembayaran   = \Carbon\Carbon::createFromDate($transaksi->tanggal_transaksi)->addSeconds(5);
        //             $data->created_by           = auth()->user()->id;
        //             $data->save();
        //         }
        //     } else {
        //         if (TransaksiPembayaran::where('transaksi_id',$transaksi->id)->count() <= 1) {
        //             if ($transaksi->dibayar == 0) {
        //                 $data->delete();
        //             } else {
        //                 $data->total_pembayaran     = $transaksi->dibayar;
        //                 $data->tanggal_pembayaran   = \Carbon\Carbon::createFromDate($transaksi->tanggal_transaksi)->addSeconds(5);
        //                 $data->updated_by           = auth()->user()->id;
        //                 $data->save();
        //             }
        //         }
        //     }
        // }
    }

    /**
     * Handle the transaksi detail "deleted" event.
     *
     * @param  \App\Transaksi  $transaksi
     * @return void
     */
    public function deleted(Transaksi $transaksi)
    {
    }

    /**
     * Handle the transaksi detail "restored" event.
     *
     * @param  \App\Transaksi  $transaksi
     * @return void
     */
    public function restored(Transaksi $transaksi)
    {
        //
    }

    /**
     * Handle the transaksi detail "force deleted" event.
     *
     * @param  \App\Transaksi  $transaksi
     * @return void
     */
    public function forceDeleted(Transaksi $transaksi)
    {
        //
    }
}
