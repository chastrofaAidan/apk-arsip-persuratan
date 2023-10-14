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
        $path = public_path('data_file/' . $filename); // Specify the path to the "data_file" folder

        if (file_exists($path)) {
            $headers = ['Content-Type: application/pdf'];
            return response()->file($path, $headers);
        } else {
            return 'File not found.';
        }
    }


    public function tambah()
    {
        return view('arsip_tambah');
    }


    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'kode_surat' => 'required',
            'judul_surat' => 'required',
            'perusahaan' => 'required',
            'jenis_surat' => 'required|in:Surat Masuk,Surat Keluar',
            'tanggal_surat' => 'required|date',
            'perihal_surat' => 'required',
            'file' => 'required|file', // Ensure the "file" field is a file
            'keterangan' => 'required',
        ]);

        // Get the uploaded file
        $file = $request->file('file');
        $pdf = time() . "_" . $file->getClientOriginalName();
        $tujuanupload = 'data_file';
        $file->move($tujuanupload, $pdf);

        // Create a new ArsipModel instance and populate it with the validated data
        $arsip = new ArsipModel();
        $arsip->kode_surat = $validatedData['kode_surat'];
        $arsip->judul_surat = $validatedData['judul_surat'];
        $arsip->perusahaan = $validatedData['perusahaan'];
        $arsip->jenis_surat = $validatedData['jenis_surat'];
        $arsip->tanggal_surat = $validatedData['tanggal_surat'];
        $arsip->perihal_surat = $validatedData['perihal_surat'];
        $arsip->file_surat = $pdf; // Store only the file name
        $arsip->keterangan = $validatedData['keterangan'];

        // Save the new record to the database
        $arsip->save();

        // Redirect to a success page or another appropriate action
        return redirect('/arsip');
    }


    public function edit($id_surat)
    { 
        $arsip = DB::table('arsip')->where('id_surat',$id_surat)->get(); 
        
        
        return view('arsip_edit',['dataarsip' => $arsip]);
    }


    public function update(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'kode_surat' => 'required',
            'judul_surat' => 'required',
            'perusahaan' => 'required',
            'jenis_surat' => 'required|in:Surat Masuk,Surat Keluar',
            'tanggal_surat' => 'required|date',
            'perihal_surat' => 'required',
            'file' => 'file', // You can add file validation rules here if needed
            'keterangan' => 'required',
        ]);

        // Find the Arsip record by its ID
        $arsip = ArsipModel::find($request->input('id_surat'));

        // Retrieve the existing record from the database
        $record = DB::table('arsip')->where('id_surat', $request->id_surat)->first();
        $pdf;
        // Check if the "file" input is empty
        if (!$request->hasFile('file')) {
            // Assign the previous value to the "file" field
            $file = $record->file;
        } else {
            // Handle the case when a new file is uploaded
            $file = $request->file('file');
            $pdf = time() . "_" . $file->getClientOriginalName();
            $tujuanupload = 'data_file';
            $file->move($tujuanupload, $pdf);
        }

        // Update the record with the validated data
        $arsip->kode_surat = $validatedData['kode_surat'];
        $arsip->judul_surat = $validatedData['judul_surat'];
        $arsip->perusahaan = $validatedData['perusahaan'];
        $arsip->jenis_surat = $validatedData['jenis_surat'];
        $arsip->tanggal_surat = $validatedData['tanggal_surat'];
        $arsip->perihal_surat = $validatedData['perihal_surat'];
        $arsip->file_surat = $pdf;
        $arsip->keterangan = $validatedData['keterangan'];


        // Save the updated record to the database
        $arsip->save();

        // Redirect to a success page or another appropriate action
        return redirect('/arsip')->with('success', 'Arsip updated successfully.');
    }



    public function hapus($id_surat)
    {
        DB::table('arsip')->where('id_surat',$id_surat)->delete();
        
        // alihkan halaman ke halaman arsip
        return redirect('/arsip');
    }

}
