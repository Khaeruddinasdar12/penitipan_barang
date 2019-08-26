<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ApiDataBarang extends Controller
{
    public function data_penitipan() 
    {
    	$data = DB::table('barangs')
                ->join('users', 'users.id', '=', 'barangs.created_by')
                ->select('users.name as namaadmin', 'barangs.*')
                ->whereNull('tanggal_kembali')
                ->get();

 		return $data;
    }

    public function riwayat_penitipan() 
    {
    	$data = DB::table('barangs')
                ->join('users', 'users.id', '=', 'barangs.created_by')
                ->select('users.name as namaadmin', 'barangs.*')
                ->whereNotNull('tanggal_kembali')
                ->get();
		return $data;
    }

    public function riwayat_penitipan_hari(Request $request) 
    {
        if ($request->get('hari') == null) {
            $data = DB::table('barangs')
                ->join('users', 'users.id', '=', 'barangs.created_by')
                ->select('users.name as namaadmin', 'barangs.*')
                ->whereMonth('barangs.created_at', '=', $request->get('bulan'))
                ->whereNotNull('tanggal_kembali')
                ->get();
            return $data;
        } else {
            $data = DB::table('barangs')
                ->join('users', 'users.id', '=', 'barangs.created_by')
                ->select('users.name as namaadmin', 'barangs.*')
                ->whereMonth('barangs.created_at', '=', $request->get('bulan'))
                ->whereDay('barangs.created_at', '=', $request->get('hari'))
                ->whereNotNull('tanggal_kembali')
                ->get();
            return $data;
        }
        
    }
    
}
