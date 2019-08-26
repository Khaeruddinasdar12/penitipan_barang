<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class User extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function tableuser()
    {
        $data = \App\User::get();

        return Datatables::of($data)
        ->addColumn('action', function ($data) {
            $role = \Auth::user()->role;
            $edit_cek  = 'cek_edit("'.$role.'")';
            $hapus_cek = 'hapus_cek("'.$role.'")';
        return "<button data-toggle='modal' data-target='#edit-data' class='btn btn-success btn-xs'
                        title='Edit Data' id='edit-item' data-id='".$data->id."' onclick='".$edit_cek."'>
                        <i class='fa fa-pencil'></i>
                </button>

                <button class='btn btn-danger btn-xs' title='Hapus Data' id='del_user' 
                        href='user/".$data->id."' onclick='".$hapus_cek."'>
                        <i class='fa fa-trash'></i>
                </button>";
        })
        ->editColumn('created_at', function ($data){
            return date("m-d-Y", strtotime($data->created_at));
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => 'required|min:11|max:14',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        // \App\User::create([
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'phone' => $request['phone'],
        //     'role' => $request['role'],
        //     'password' => Hash::make($request['password']),
        // ]);

        $data = new \App\User;
        $data->name     = $request->name;
        $data->email    = $request->email;
        $data->phone    = $request->phone;
        $data->password = Hash::make($request['password']);
        $data->role     = $request->role;
        $data->save();

        return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Menambah Data' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = \App\User::findOrfail($id);
        return response()->json(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = \App\User::findOrfail($id);
        $data->role = $request->roles;
        $data->save();
        return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Mengubah Data' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $data = \App\User::findOrfail($id);
        $data->delete();
        return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Menghapus Data' );
    }
}
