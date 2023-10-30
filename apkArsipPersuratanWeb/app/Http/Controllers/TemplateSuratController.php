<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class TemplateSuratController extends Controller
{
    public function index(){
        return view('pembuatan_surat');
    }

    public function suratDispen(){
        $pdf = PDF::loadview('surat.dispen');
        return $pdf->download('Nama Surat');
    }
}
