<?php

namespace App\Observers;

use App\Model\TransferGudang;
use App\Model\StokProdukGudang;

class TransferGudangObserver
{
    /**
     * Handle the transfer gudang "created" event.
     *
     * @param  \App\Model\TransferGudang  $transferGudang
     * @return void
     */
    public function created(TransferGudang $transferGudang)
    {
        $asal = StokProdukGudang::where([
            ['stok_produk_id',$transferGudang->stok_produk_id],
            ['gudang_id',$transferGudang->dari_gudang_id]
        ])->first();
        $asal->jumlah_stok_sekarang = $asal->jumlah_stok_sekarang - $transferGudang->kuantitas;
        $asal->save();

        $tujuan = StokProdukGudang::where([
            ['stok_produk_id',$transferGudang->stok_produk_id],
            ['gudang_id',$transferGudang->ke_gudang_id]
        ])->first();
        $tujuan->jumlah_stok_sekarang = $tujuan->jumlah_stok_sekarang + $transferGudang->kuantitas;
        $tujuan->save();
    }

    /**
     * Handle the transfer gudang "updated" event.
     *
     * @param  \App\Model\TransferGudang  $transferGudang
     * @return void
     */
    public function updated(TransferGudang $transferGudang)
    {
        // START kembalikan ke sebelumnya
        $asalOriginal = StokProdukGudang::where([
            ['stok_produk_id',$transferGudang->getOriginal('stok_produk_id')],
            ['gudang_id',$transferGudang->getOriginal('dari_gudang_id')]
        ])->first();
        $asalOriginal->jumlah_stok_sekarang = $asalOriginal->jumlah_stok_sekarang + $transferGudang->getOriginal('kuantitas');
        $asalOriginal->save();

        $tujuanOriginal = StokProdukGudang::where([
            ['stok_produk_id',$transferGudang->getOriginal('stok_produk_id')],
            ['gudang_id',$transferGudang->getOriginal('ke_gudang_id')]
        ])->first();
        $tujuanOriginal->jumlah_stok_sekarang = $tujuanOriginal->jumlah_stok_sekarang - $transferGudang->getOriginal('kuantitas');
        $tujuanOriginal->save();
        // END kembalikan ke sebelumnya

        // START masukkan ke yang berubah
        $asal = StokProdukGudang::where([
            ['stok_produk_id',$transferGudang->stok_produk_id],
            ['gudang_id',$transferGudang->dari_gudang_id]
        ])->first();
        $asal->jumlah_stok_sekarang = $asal->jumlah_stok_sekarang - $transferGudang->kuantitas;
        $asal->save();

        $tujuan = StokProdukGudang::where([
            ['stok_produk_id',$transferGudang->stok_produk_id],
            ['gudang_id',$transferGudang->ke_gudang_id]
        ])->first();
        $tujuan->jumlah_stok_sekarang = $tujuan->jumlah_stok_sekarang + $transferGudang->kuantitas;
        $tujuan->save();
        // END masukkan ke yang berubah
    }

    /**
     * Handle the transfer gudang "deleted" event.
     *
     * @param  \App\Model\TransferGudang  $transferGudang
     * @return void
     */
    public function deleted(TransferGudang $transferGudang)
    {
        $asal = StokProdukGudang::where([
            ['stok_produk_id',$transferGudang->stok_produk_id],
            ['gudang_id',$transferGudang->dari_gudang_id]
        ])->first();
        $asal->jumlah_stok_sekarang = $asal->jumlah_stok_sekarang + $transferGudang->kuantitas;
        $asal->save();

        $tujuan = StokProdukGudang::where([
            ['stok_produk_id',$transferGudang->stok_produk_id],
            ['gudang_id',$transferGudang->ke_gudang_id]
        ])->first();
        $tujuan->jumlah_stok_sekarang = $tujuan->jumlah_stok_sekarang - $transferGudang->kuantitas;
        $tujuan->save();
    }

    /**
     * Handle the transfer gudang "restored" event.
     *
     * @param  \App\Model\TransferGudang  $transferGudang
     * @return void
     */
    public function restored(TransferGudang $transferGudang)
    {
        //
    }

    /**
     * Handle the transfer gudang "force deleted" event.
     *
     * @param  \App\Model\TransferGudang  $transferGudang
     * @return void
     */
    public function forceDeleted(TransferGudang $transferGudang)
    {
        //
    }
}
