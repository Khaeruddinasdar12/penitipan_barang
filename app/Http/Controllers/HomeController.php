<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use Carbon\Carbon;
// use Helper;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $all    =  DB::table('barangs')->count();
        $riwayat = \App\Barang::whereNotNull('tanggal_kembali')->count();
        $penitipan = \App\Barang::whereNull('tanggal_kembali')->count();
        return view('dashboard1', ['riwayat' => $riwayat, 'penitipan' => $penitipan, 'all' => $all]);
    }

    public function histories()
    {
        return view('histories');
    }

    public function show_edit_items($id)
    {
        $data = \App\Barang::findOrfail($id);
        return response()->json(['data' => $data]);
    }

    public function add_items(Request $request)
    {
        $validasi = $this->validate($request, [
            'phone' => 'required',
            'jumlah_barang' => 'required|numeric|min:1',
            'nama_peminjam' => 'required'
        ]);
        $harga          = $request->jumlah_barang * 45000 * $request->lama;
        $ppn            = $harga * 10 / 100;
        $total_bayar    = $harga + $ppn;

        DB::statement("ALTER TABLE barangs AUTO_INCREMENT = 1;"); 

        $data = new \App\Barang;
        $data->nama_peminjam = $request->nama_peminjam;
        $data->jumlah_barang = $request->jumlah_barang;
        $data->lama_pinjam   = $request->lama;
        $data->harga         = $harga;
        $data->ppn           = $ppn;
        $data->phone         = $request->phone;
        $data->total_bayar   = $total_bayar;
        $data->created_by    = \Auth::user()->id;
        $data->save();

        $total = format_uang($data->total_bayar);
        return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Menambah Data', 'nama' => $data->nama_peminjam, 'total' => $total);
    }

    public function delete_items($id) 
    {
        $data = \App\Barang::findOrfail($id);
        $data->delete();
        return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Menghapus Data' );

    }

    public function delete_riwayat($id) 
    {
        $data = \App\Barang::findOrfail($id);
        $data->delete();
        return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Menghapus Data' );

    }

    public function edit_items(Request $request,$id)
    {
        $validasi = $this->validate($request, [
            'phone' => 'required',
            'jumlah_barang' => 'required|numeric|min:1',
            'nama_peminjam' => 'required'
        ]);
        $harga          = $request->jumlah_barang * 45000 * $request->lama;
        $ppn            = $harga * 10 / 100;
        $total_bayar    = $harga + $ppn; 

        $data = \App\Barang::findOrfail($id);
        $data->nama_peminjam = $request->nama_peminjam;
        $data->jumlah_barang = $request->jumlah_barang;
        $data->harga         = $harga;
        $data->lama_pinjam   = $request->lama;
        $data->phone         = $request->phone;
        $data->ppn           = $ppn;
        $data->total_bayar   = $total_bayar;
        $data->created_by    = \Auth::user()->id;
        $data->save();

        return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Mengubah Data' );
    }

    public function items_back($id)
    {
        $data = \App\Barang::findOrfail($id);
        
        // $formatted_dt1=Carbon::now();
        // $formatted_dt2=Carbon::parse($data->created_at);
        // // return $data-;
        // $lama_titip = $formatted_dt1->diffInDays($formatted_dt2);
        $data->tanggal_kembali = Carbon::now();
        // $data->lama_pinjam     = $lama_titip;
        $data->updated_by      = \Auth::user()->name;
        $data->save();

        return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Mengembalikan Barang' );
    }

    public function format_uang($angka){ 
        $hasil =  number_format($angka,0, ',' , '.'); 
        return $hasil; 
    }

    public function items()
    {
        return view('tablebarang');
    }

    public function table_barang()
    {
        // $data = \App\Barang::get();
        $data = DB::table('barangs')
                ->join('users', 'users.id', '=', 'barangs.created_by')
                ->select('users.name as namaadmin', 'barangs.*')
                ->whereNull('tanggal_kembali')
                ->get();

        return Datatables::of($data)
        ->addColumn('action', function ($data) {
            $role = \Auth::user()->role;
            $edit_cek   = 'cek_edit("'.$role.'")';
            $hapus_cek  = 'hapus_cek("'.$role.'")';
            $back    = 'kembalikan("'.$role.'")';
            $total = format_uang($data->total_bayar);
        return "<button class='btn btn-success btn-xs'
                        title='Kembalikan Barang' data-id='".$data->id."' 
                        href='items-back/".$data->id."' onclick='".$back."'
                        id='balik-item' 
                        total='$total' nama='$data->nama_peminjam'>
                        <i class='fa fa-mail-reply'></i>
                </button>

                <button class='btn btn-success btn-xs'
                        title='Edit Data' id='edit-item' data-id='".$data->id."' onclick='".$edit_cek."'>
                        <i class='fa fa-pencil'></i>
                </button>

                <button class='btn btn-danger btn-xs' title='Hapus Data' id='del_id' 
                        href='items/".$data->id."' onclick='".$hapus_cek."'>
                        <i class='fa fa-trash'></i>
                </button>";
        })
        ->editColumn('harga', function ($data) {
          return 'Rp. '.format_uang($data->harga) ;
        })
        ->editColumn('ppn', function ($data) {
          return 'Rp. '.format_uang($data->ppn) ;
        })
        ->editColumn('total_bayar', function ($data) {
          return 'Rp. '.format_uang($data->total_bayar) ;
        })
        ->editColumn('created_at', function ($data){
            return date("m-d-Y", strtotime($data->created_at));
        })
        ->rawColumns(['harga','action'])
        // ->orderColumn('id', '-desc')
        ->make(true);
        // return view('barang');
    }

    public function tablehistories()
    {
        // $data = \App\Barang::get();
        $data = DB::table('barangs')
                ->join('users', 'users.id', '=', 'barangs.created_by')
                ->select('users.name as namaadmin', 'barangs.*')
                ->whereNotNull('tanggal_kembali')
                ->get();
                // return $data;
        return Datatables::of($data)
        ->addColumn('action', function ($data) {
            $role = \Auth::user()->role;
            $hapus   = 'hapus_cek("'.$role.'")';
        return "
                <button class='btn btn-danger btn-xs' title='Hapus Data' id='del_id' 
                    href='riwayat/".$data->id."' onclick=".$hapus.">
                    <i class='fa fa-trash'></i>
                </button>";
        })
        ->editColumn('harga', function ($data) {
          return 'Rp. '.format_uang($data->harga) ;
        })
        ->editColumn('ppn', function ($data) {
          return 'Rp. '.format_uang($data->ppn) ;
        })
        ->editColumn('total_bayar', function ($data) {
          return 'Rp. '.format_uang($data->total_bayar) ;
        })
        ->editColumn('created_at', function ($data){
            return date("m-d-Y", strtotime($data->created_at));
        })
        ->editColumn('tanggal_kembali', function ($data){
            return date("m-d-Y", strtotime($data->tanggal_kembali));
        })
        ->rawColumns(['harga','action'])
        // ->orderColumn('id', '-desc')
        ->make(true);
        // return view('barang');
    }
}
