<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ArsipModel;
use Barryvdh\DomPDF\PDF as PDF;

class ArsipController extends Controller
{
    public function index()
    {
        $arsip = ArsipModel::All();
        return view('arsip_index', ['dataarsip' => $arsip]);
    }

    public function preview($filename)
    { 
        $path = public_path($filename);

        if (file_exists($path)) {
            $headers = ['Content-Type: application/pdf'];
            return response()->file($path, $headers);
        } else {
            return 'File not found.';
        }
    }

}
