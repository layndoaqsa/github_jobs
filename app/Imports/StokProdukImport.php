<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
use App\Model\StokProduk;
use App\Model\Barang;
use App\Model\Merek;
use App\Model\Kategori;
use App\Model\Gudang;
use Carbon\Carbon;
use Validator;

class StokProdukImport implements ToCollection 
{
    /**
    * @param Collection $collection
    */
    
    public function collection(Collection $collection)
    {
        try {
            DB::beginTransaction();
            if (empty($collection['1'])) {
                throw new \Exception('No data to import in sheet work task');
            }
            foreach ($collection as $key => $row) {
                if ($key == 0){
                    continue;
                } else if ($key > 0) {
                    $q = $key+1;

                    // JENIS
                    if (empty($row[0])) {
                        throw new \Exception('Kolom '.($collection[0][0]).' baris ' . ($q) .' tidak boleh kosong.');
                    }
                    $barang = Barang::find($row[0]);
                    if (empty($barang)) {
                        throw new \Exception(($collection[0][0]).' '.$row[0].' pada baris '. $q .' tidak terdaftar dalam database.');
                    }

                    // MEREK
                    if (empty($row[1])) {
                        throw new \Exception('Kolom '.($collection[0][1]).' baris ' . ($q) .' tidak boleh kosong.');
                    }
                    $merek     = Merek::find($row[1]);
                    if (empty($merek)) {
                        throw new \Exception(($collection[0][1]).' '.$row[1].' pada baris '. $q .' tidak terdaftar dalam database.');
                    }

                    // KATEGORI
                    if ($row[2]) {
                        $kategori =explode(',', $row[2]);
                        foreach ($kategori as $key2 => $value) {
                            $find = Kategori::find($value);
                            if (empty($find)) {
                                throw new \Exception('Kolom '.($collection[0][2]).' baris ' . ($q) .',  '.$value.' tidak terdaftar pada database.');
                            }
                        }
                    } else {
                        $kategori = null;
                    }

                    // NAMA

                    // KODE
                    foreach ($collection as $key2 => $value2) {
                        $number = $value2['4'];
                        if ($number == $row[4] && $key2 != $key) {
                            $p = $key2+1;
                            throw new \Exception('Duplikasi kode stok produk pada baris '. $q . ' dan ' . $p .'.');
                        }
                    }
                    if (StokProduk::where('kode',$row[4])->first()) {
                        throw new \Exception('Kode '.$row[4].' pada baris '.$q .' sudah terdaftar.');
                    }

                    $data = [
                        'barang_id' => $row[0],
                        'merek_id'  => $row[1],
                        'nama'      => trim($row[3]),
                        'kode'      => trim($row[4]),
                        'deskripsi' => trim($row[5]),
                        'harga_jual'=> trim($row[6]),
                        'harga_beli'=> trim($row[8]),
                        'created_by'=> auth()->user()->id
                    ];
                    StokProduk::create($data);

                    foreach ($kategori as $key => $value) {
                        $kategori = new StokProdukKategori;
                        $kategori->stok_produk_id   = $data->id;
                        $kategori->kategori_id      = $value;
                        $kategori->created_by       = auth()->user()->id;
                        $kategori->save();
                    }

                    foreach (Gudang::all() as $key => $value) {
                        if (!empty($value)) {
                            $gudang = new StokProdukGudang;
                            $gudang->stok_produk_id         = $data->id;
                            $gudang->gudang_id              = $value;
                            $gudang->jumlah_stok_sekarang   = 0;
                            $gudang->jumlah_stok_awal       = 0;
                            $gudang->created_by             = auth()->user()->id;
                            $gudang->save();
                        }
                    }
                }
            }
            DB::commit();
        } catch (\ErrorException $err) {
            dd($err->getMessage());
        }
    }
}
