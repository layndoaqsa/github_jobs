<?php

namespace App\Observers;

use App\Model\TransaksiDetail;
use App\Model\StokProdukGudang;

class TransaksiDetailObserver
{
    /**
     * Handle the transaksi detail "created" event.
     *
     * @param  \App\TransaksiDetail  $transaksiDetail
     * @return void
     */
    public function created(TransaksiDetail $transaksiDetail)
    {
        $spg = StokProdukGudang::find($transaksiDetail->stok_produk_gudang_id);
        if ($transaksiDetail->tipe == 'Stok Keluar') {
            $spg->jumlah_stok_sekarang = $spg->jumlah_stok_sekarang - $transaksiDetail->kuantitas;
        } else {
            $spg->jumlah_stok_sekarang = $spg->jumlah_stok_sekarang + $transaksiDetail->kuantitas;
        }
        $spg->save();

        if ($transaksiDetail->transaksi_id) {
            $transaksi = $transaksiDetail->transaksi;
            $transaksi->total_pembayaran_netto  = $transaksi->total_pembayaran_netto + $transaksiDetail->total_netto;
            $transaksi->total_pembayaran        = $transaksi->total_pembayaran + $transaksiDetail->total_netto;
            $transaksi->save();
            
            if ($transaksi->transaksi_pembayaran->count() <= 1) {
                switch ($transaksi->tipe) {
                    case 'TIPE_PEMBAYARAN_KELUAR_01':
                    case 'TIPE_PEMBAYARAN_MASUK_01':
                        $dibayar  = $transaksi->total_pembayaran_netto;
                        break;
                    default:
                        $dibayar  = $transaksi->dibayar;
                        break;
                }
                switch ($transaksi->transaksi_pembayaran->count()) {
                    case '0':
                        if ($dibayar > 0) {
                            $data = new TransaksiPembayaran;
                            $data->transaksi_id         = $transaksi->id;
                            $data->total_pembayaran     = $dibayar;
                            $data->tanggal_pembayaran   = \Carbon\Carbon::createFromDate($transaksi->tanggal_transaksi)->addMinutes(1);
                            $data->created_by           = auth()->user()->id;
                            $data->save();
                        }
                        break;
                    case '1':
                        $data = $transaksi->transaksi_pembayaran[0];
                        if ($dibayar == 0) {
                            $data->delete();
                        } else {
                            $data->total_pembayaran     = $dibayar;
                            $data->tanggal_pembayaran   = \Carbon\Carbon::createFromDate($transaksi->tanggal_transaksi)->addMinutes(1);
                            $data->updated_by           = auth()->user()->id;
                            $data->save();
                        }
                        break;
                    default:
                        dd('Transaksi memiliki lebih dari 1 pembayaran.');
                        break;
                }
            } else {
                $transaksi->dibayar         = $transaksi->dibayar;
                $transaksi->kurang_bayar    = $transaksi->total_pembayaran_netto - $transaksi->dibayar;
                transaksiTipe($transaksi);
            }
        }
    }

    /**
     * Handle the transaksi detail "updated" event.
     *
     * @param  \App\TransaksiDetail  $transaksiDetail
     * @return void
     */
    public function updated(TransaksiDetail $transaksiDetail)
    {
        if($transaksiDetail->isDirty('kuantitas')){
            $spg = StokProdukGudang::find($transaksiDetail->stok_produk_gudang_id);
            if ($transaksiDetail->tipe == 'Stok Keluar') {
                $spg->jumlah_stok_sekarang = $spg->jumlah_stok_sekarang + $transaksiDetail->getOriginal('kuantitas') - $transaksiDetail->kuantitas;
            } else {
                $spg->jumlah_stok_sekarang = $spg->jumlah_stok_sekarang - $transaksiDetail->getOriginal('kuantitas') + $transaksiDetail->kuantitas;
            }
            $spg->save();
        }

        if ($transaksiDetail->transaksi_id) {
            $transaksi = $transaksiDetail->transaksi;
            $transaksi->total_pembayaran_netto  = $transaksi->total_pembayaran_netto - $transaksiDetail->getOriginal('total_netto') + $transaksiDetail->total_netto;
            $transaksi->total_pembayaran        = $transaksi->total_pembayaran - $transaksiDetail->getOriginal('total_netto') + $transaksiDetail->total_netto;
            $transaksi->save();
            if ($transaksi->transaksi_pembayaran->count() <= 1) {
                switch ($transaksi->tipe) {
                    case 'TIPE_PEMBAYARAN_KELUAR_01':
                    case 'TIPE_PEMBAYARAN_MASUK_01':
                        $dibayar  = $transaksi->total_pembayaran_netto;
                        break;
                    default:
                        $dibayar  = $transaksi->dibayar;
                        break;
                }
    
                switch ($transaksi->transaksi_pembayaran->count()) {
                    case '0':
                        if ($dibayar > 0) {
                            $data = new TransaksiPembayaran;
                            $data->transaksi_id         = $transaksi->id;
                            $data->total_pembayaran     = $dibayar;
                            $data->tanggal_pembayaran   = \Carbon\Carbon::createFromDate($transaksi->tanggal_transaksi)->addMinutes(1);
                            $data->created_by           = auth()->user()->id;
                            $data->save();
                        }
                        break;
                    case '1':
                        $data = $transaksi->transaksi_pembayaran[0];
                        if ($dibayar == 0) {
                            $data->delete();
                        } else {
                            $data->total_pembayaran     = $dibayar;
                            $data->tanggal_pembayaran   = \Carbon\Carbon::createFromDate($transaksi->tanggal_transaksi)->addMinutes(1);
                            $data->updated_by           = auth()->user()->id;
                            $data->save();
                        }
                        break;
                    default:
                        dd('Transaksi memiliki lebih dari 1 pembayaran.');
                        break;
                }
            } else {
                $transaksi->dibayar         = $transaksi->dibayar;
                $transaksi->kurang_bayar    = $transaksi->total_pembayaran_netto - $transaksi->dibayar;
                transaksiTipe($transaksi);
            }
        }
    }

    /**
     * Handle the transaksi detail "deleted" event.
     *
     * @param  \App\TransaksiDetail  $transaksiDetail
     * @return void
     */
    public function deleted(TransaksiDetail $transaksiDetail)
    {
        $spg = StokProdukGudang::find($transaksiDetail->stok_produk_gudang_id);
        if ($transaksiDetail->tipe == 'Stok Keluar') {
            $spg->jumlah_stok_sekarang = $spg->jumlah_stok_sekarang + $transaksiDetail->kuantitas;
        } else {
            $spg->jumlah_stok_sekarang = $spg->jumlah_stok_sekarang - $transaksiDetail->kuantitas;
        }
        $spg->save(); 
        
        if ($transaksiDetail->transaksi_id) {
            $transaksi = $transaksiDetail->transaksi;
            $transaksi->total_pembayaran_netto  = $transaksi->total_pembayaran_netto - $transaksiDetail->getOriginal('total_netto');
            $transaksi->total_pembayaran        = $transaksi->total_pembayaran - $transaksiDetail->getOriginal('total_netto');
            $transaksi->save();
            
            if ($transaksi->transaksi_pembayaran->count() <= 1) {
                switch ($transaksi->tipe) {
                    case 'TIPE_PEMBAYARAN_KELUAR_01':
                    case 'TIPE_PEMBAYARAN_MASUK_01':
                        $dibayar  = $transaksi->total_pembayaran_netto;
                        break;
                    default:
                        $dibayar  = $transaksi->dibayar;
                        break;
                }
                switch ($transaksi->transaksi_pembayaran->count()) {
                    case '0':
                        if ($dibayar > 0) {
                            $data = new TransaksiPembayaran;
                            $data->transaksi_id         = $transaksi->id;
                            $data->total_pembayaran     = $dibayar;
                            $data->tanggal_pembayaran   = \Carbon\Carbon::createFromDate($transaksi->tanggal_transaksi)->addMinutes(1);
                            $data->created_by           = auth()->user()->id;
                            $data->save();
                        }
                        break;
                    case '1':
                        $data = $transaksi->transaksi_pembayaran[0];
                        if ($dibayar == 0) {
                            $data->delete();
                        } else {
                            $data->total_pembayaran     = $dibayar;
                            $data->tanggal_pembayaran   = \Carbon\Carbon::createFromDate($transaksi->tanggal_transaksi)->addMinutes(1);
                            $data->updated_by           = auth()->user()->id;
                            $data->save();
                        }
                        break;
                    default:
                        dd('Transaksi memiliki lebih dari 1 pembayaran.');
                        break;
                }
            } else {
                $transaksi->dibayar         = $transaksi->dibayar;
                $transaksi->kurang_bayar    = $transaksi->total_pembayaran_netto - $transaksi->dibayar;
                transaksiTipe($transaksi);
            }
        }
    }

    /**
     * Handle the transaksi detail "restored" event.
     *
     * @param  \App\TransaksiDetail  $transaksiDetail
     * @return void
     */
    public function restored(TransaksiDetail $transaksiDetail)
    {
        //
    }

    /**
     * Handle the transaksi detail "force deleted" event.
     *
     * @param  \App\TransaksiDetail  $transaksiDetail
     * @return void
     */
    public function forceDeleted(TransaksiDetail $transaksiDetail)
    {
        //
    }
}
