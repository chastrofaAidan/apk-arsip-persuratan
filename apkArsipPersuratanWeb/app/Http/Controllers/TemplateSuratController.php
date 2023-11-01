<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ArsipModel;
use App\Models\User;
use Barryvdh\DomPDF\PDF as PDF;
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
        $pdf = app('dompdf.wrapper')->loadView('surat.dispen');
        return $pdf->download('NamaSurat.pdf');
    }

}
