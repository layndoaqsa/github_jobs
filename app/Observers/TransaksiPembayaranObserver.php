<?php

namespace App\Observers;

use App\Model\Transaksi;
use App\Model\TransaksiPembayaran;

class TransaksiPembayaranObserver
{
    /**
     * Handle the transaksi pembayaran "created" event.
     *
     * @param  \App\TransaksiPembayaran  $transaksiPembayaran
     * @return void
     */
    public function created(TransaksiPembayaran $transaksiPembayaran)
    {
        $transaksi = Transaksi::find($transaksiPembayaran->transaksi_id);
        $transaksi->dibayar         = $transaksi->dibayar + $transaksiPembayaran->total_pembayaran;
        $transaksi->kurang_bayar    = $transaksi->total_pembayaran_netto - $transaksi->dibayar;
        transaksiTipe($transaksi);
        $transaksi->save();
    }

    /**
     * Handle the transaksi pembayaran "updated" event.
     *
     * @param  \App\TransaksiPembayaran  $transaksiPembayaran
     * @return void
     */
    public function updated(TransaksiPembayaran $transaksiPembayaran)
    {
        $transaksi = Transaksi::find($transaksiPembayaran->transaksi_id);
        $transaksi->dibayar         = $transaksi->dibayar - $transaksiPembayaran->getOriginal('total_pembayaran') + $transaksiPembayaran->total_pembayaran;
        $transaksi->kurang_bayar    = $transaksi->total_pembayaran_netto - $transaksi->dibayar;
        transaksiTipe($transaksi);
        $transaksi->save();
    }

    /**
     * Handle the transaksi pembayaran "deleted" event.
     *
     * @param  \App\TransaksiPembayaran  $transaksiPembayaran
     * @return void
     */
    public function deleted(TransaksiPembayaran $transaksiPembayaran)
    {
        $transaksi = Transaksi::find($transaksiPembayaran->transaksi_id);
        $transaksi->dibayar         = $transaksi->dibayar - $transaksiPembayaran->total_pembayaran;
        $transaksi->kurang_bayar    = $transaksi->total_pembayaran_netto - $transaksi->dibayar;
        transaksiTipe($transaksi);
        $transaksi->save();
    }

    /**
     * Handle the transaksi pembayaran "restored" event.
     *
     * @param  \App\TransaksiPembayaran  $transaksiPembayaran
     * @return void
     */
    public function restored(TransaksiPembayaran $transaksiPembayaran)
    {
        //
    }

    /**
     * Handle the transaksi pembayaran "force deleted" event.
     *
     * @param  \App\TransaksiPembayaran  $transaksiPembayaran
     * @return void
     */
    public function forceDeleted(TransaksiPembayaran $transaksiPembayaran)
    {
        //
    }
}
