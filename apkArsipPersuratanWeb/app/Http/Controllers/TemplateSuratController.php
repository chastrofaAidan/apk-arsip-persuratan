<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ArsipModel;
use App\Models\User;
use PDF;
// use Barryvdh\DomPDF\PDF;

class TemplateSuratController extends Controller 
{
    public function index(){
        $user = Auth::user(); // Get the currently logged-in user
        return view('pembuatan_surat', ['user' => $user]);
    }
    
    public function profile(){
        $user = Auth::user(); // Get the currently logged-in user
        return view('profile', ['user' => $user]);
    }
    
    public function settings(){
        $user = Auth::user(); // Get the currently logged-in user
        return view('settings', ['user' => $user]);
    }

    public function suratDispen()
    {
        $pdf = PDF::loadView('surat/dispen')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('NamaFile.pdf');
    }

}

// public function cetakpdf()
// {
//     //mengambil data dari table guru
//     $dataguru = GuruModel::all();

//     $pdf = PDF::loadview('v_gurupdf',['guru'=>$dataguru]);
//     return $pdf->download('laporan-guru.pdf');
// }


// public function previewpdf()
// {
//     //mengambil data dari table guru
//     $dataguru = GuruModel::all();

//     $pdf = PDF::loadview('v_gurupdf',['guru'=>$dataguru]);
//     return $pdf->stream();
// }