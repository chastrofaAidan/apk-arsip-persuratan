<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\WalasModel;
use Barryvdh\DomPDF\PDF as PDF;

class WalasController extends Controller
{
    public function index()
    {
        // // mengambil data dari table tbl_walas
        // $walas = DB::table('tbl_walas')->get();

        // // mengirim data walas ke view index
        // return view('walas_index',['datawalas' => $walas]);

        $walas = WalasModel::All();
        return view('walas_index', ['datawalas' => $walas]);
    }


    // method untuk menampilkan view form tambah walas
    public function tambah()
    {
        $walas = WalasModel::All();
        // memanggil view tambah
        return view('walas_tambah', ['datawalas' => $walas]);
    }


    // method untuk insert data ke table tbl_walas
    public function store(Request $request)
    {

        $file = $request->file('fotowalas');
        $photo = time() . "_" . $file->getClientOriginalName();
        $tujuanupload = 'data_file';
        $file->move($tujuanupload, $photo);

        // insert data ke table tbl_walas
        DB::table('tbl_walas')->insert([
            'fotowalas' => $photo,
            'namawalas' => $request->namawalas,
            'nip' => $request->nip,
            'kelaswalas' => $request->kelaswalas,
            'mapel' => $request->mapel]
        );

        // alihkan halaman ke halaman walas
        return redirect('/walas/tambah');
    }

    // method untuk edit data walas
    public function edit($idwalas)
    { 
        // mengambil data walas berdasarkan id yang dipilih
        $walas = DB::table('tbl_walas')->where('idwalas',$idwalas)->get(); 
        
        // passing data walas yang didapat ke view edit.blade.php 
        return view('walas_edit',['datawalas' => $walas]);
    }

    // update data walas
    public function update(Request $request)
    {
        // Retrieve the existing record from the database
        $record = DB::table('tbl_walas')->where('idwalas', $request->idwalas)->first();

        // Check if the "fotowalas" input is empty
        if (!$request->hasFile('fotowalas')) {
            // Assign the previous value to the "fotowalas" field
            $fotowalas = $record->fotowalas;
        } else {
            // Handle the case when a new file is uploaded
            $file = $request->file('fotowalas');
            $photo = time() . "_" . $file->getClientOriginalName();
            $tujuanupload = 'data_file';
            $file->move($tujuanupload, $photo);
            $fotowalas = $photo;
        }

        // update data walas
        DB::table('tbl_walas')->where('idwalas',$request->idwalas)->update([

            'fotowalas' => $fotowalas,
            'namawalas' => $request->namawalas,
            'nip' => $request->nip,
            'kelaswalas' => $request->kelaswalas,
            'mapel' => $request->mapel
        ]);

        // alihkan halaman ke halaman walas
        return redirect('/walas/tambah');
    }

    // method untuk hapus data walas
    public function hapus($idwalas)
    {
        // menghapus data walas berdasarkan id yang dipilih
        // DB::table('tbl_walas')->where('idwalas',$idwalas)->delete();
        $walas = WalasModel::find($idwalas);
        $walas->delete();
        
        // alihkan halaman ke halaman walas
        return redirect('/walas/tambah');
    }



    // menampilkan data walas yang sudah dihapus
    public function trash()
    {
        $walas = WalasModel::onlyTrashed()->get();
        return view('walas_trash', ['walas' => $walas]);
    }

    // restore data guru yang dihapus
    public function kembalikan($idwalas)
    {
        $walas = WalasModel::onlyTrashed()->where('idwalas',$idwalas);
        $walas->restore();
        
        return redirect('/walas/trash');
    }

    //restore semua data guru yang sudah dihapus
    public function kembalikan_semua()
    {
        $walas = WalasModel::onlyTrashed();
        $walas->restore();
        
        return redirect('/walas/trash');
    }

    // hapus permanen
    public function hapus_permanen($idwalas)
    {
        // hapus permanen data guru
        $walas = WalasModel::onlyTrashed()->where('idwalas',$idwalas);
        $walas->forceDelete();
        
        return redirect('/walas/trash');
    }

    // hapus permanen semua guru yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data guru yang sudah dihapus
        $walas = WalasModel::onlyTrashed();
        $walas->forceDelete();
        
        return redirect('/walas/trash');
    }

    // public function cetakpdf()
    // {
    //     //mengambil data dari table guru
    //     $dataguru = WalasModel::all();

    //     $pdf = PDF::loadview('v_gurupdf',['guru'=>$dataguru]);
    //     return $pdf->download('laporan-guru-pdf');
    // }
}
