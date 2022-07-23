<?php

function coreResponse($message, $data = null, $statusCode, $isSuccess = true)
{
    if(!$message) return response()->json(['message' => 'Message is required'], 500);

    if($isSuccess) {
        return response()->json([
            'message' => $message,
            'status' => 'success',
            'error' => false,
            'code' => $statusCode,
            'results' => $data
        ], $statusCode);
    } else {
        return response()->json([
            'message' => $message,
            'status' => 'failed',
            'error' => true,
            'code' => $statusCode,
        ], $statusCode);
    }
}

if (! function_exists('successResponse')) {
    function successResponse($message, $data = null, $statusCode = 200) {
        return coreResponse($message, $data, $statusCode);
    }
}

if (! function_exists('rupiah')) {
    function rupiah($rupiah) {
        return 'Rp '.number_format($rupiah ,0,".",".").',-';
    }
}


if (! function_exists('errorResponse')) {
    function errorResponse($message, $statusCode = 500) {
        return coreResponse($message, null, $statusCode, false);
    }
}

if (! function_exists('userRole')) {
    function userRole($role_id){
        $data = App\User::whereHas("roles", function($q) use ($role_id) {
            $q->where("id", $role_id);
        })->get();
        return $data;
    }
}

if (! function_exists('userName')) {
    function userName($id){
        $user = App\User::find($id);
        if ($user) {
            return $user->name;
        }
        return null;
    }
}
if (! function_exists('comName')) {
    function comName($id){
        $comCodeName = App\Model\Component::where('com_cd', $id)->first();
        if ($comCodeName) {
            return $comCodeName->code_nm;
        } else {
            return null;
        }
    }
}

if (! function_exists('comNote2')) {
    function comNote2($id){
        $comCodeName = App\Model\Component::where('com_cd', $id)->first();
        if ($comCodeName) {
            return $comCodeName->note_2;
        } else {
            return null;
        }
    }
}


if (! function_exists('comCode')) {
    function comCode($name){
        $comCodeName = App\Model\Component::where('code_nm', $name)->first();
        if ($comCodeName) {
            return $comCodeName->com_cd;
        } else {
            return null;
        }
    }
}

if (! function_exists('transaksiTipe')) {
    function transaksiTipe($transaksi){
        if ($transaksi->supplier_id) {
            switch ($transaksi) {
                case $transaksi->dibayar == $transaksi->total_pembayaran_netto:
                    $transaksi->tipe = 'TIPE_PEMBAYARAN_KELUAR_01';
                    break;
                case $transaksi->dibayar == 0:
                    $transaksi->tipe = 'TIPE_PEMBAYARAN_KELUAR_02';
                    break;
                case $transaksi->dibayar < $transaksi->total_pembayaran_netto:
                    $transaksi->tipe = 'TIPE_PEMBAYARAN_KELUAR_03';
                    break;
                default:
                    $transaksi->tipe = null;
                    break;
            }
        } else {
            switch ($transaksi) {
                case $transaksi->dibayar == $transaksi->total_pembayaran_netto:
                    $transaksi->tipe = 'TIPE_PEMBAYARAN_MASUK_01';
                    break;
                case $transaksi->dibayar == 0:
                    $transaksi->tipe = 'TIPE_PEMBAYARAN_MASUK_02';
                    break;
                case $transaksi->dibayar < $transaksi->total_pembayaran_netto:
                    $transaksi->tipe = 'TIPE_PEMBAYARAN_MASUK_03';
                    break;
                default:
                    $transaksi->tipe = null;
                    break;
            }
        }
        $transaksi->save();
        return $transaksi;
    }
}
