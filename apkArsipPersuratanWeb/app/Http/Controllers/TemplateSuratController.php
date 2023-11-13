<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Intervention\Image\Facades\Image;
use App\Models\ArsipModel;
use App\Models\SuratKeluarModel;
use App\Models\KopSuratModel;
use App\Models\KodePosModel;
use App\Models\KepalaSekolahModel;
use App\Models\User;
use PDF;
// use Barryvdh\DomPDF\PDF;

class TemplateSuratController extends Controller 
{
    public function index(){
        $user = Auth::user(); // Get the currently logged-in user
        return view('pembuatan_surat', ['user' => $user]);
    }

    public function ijin(){
        $user = Auth::user(); // Get the currently logged-in user
        $kode_surat = KopSuratModel::latest('id_kop_surat')->first();
    
        $lastRecord = SuratKeluarModel::latest('no_keluar')->first();
        $newNoKeluarValue = ($lastRecord) ? $lastRecord->no_keluar + 1 : 1;
    
        return view('ijin_template', ['user' => $user, 'newNoKeluarValue' => $newNoKeluarValue, 'kode_surat' => $kode_surat]);
    }
    

    public function pengantar(){
        $user = Auth::user(); // Get the currently logged-in user
        return view('pengantar_template', ['user' => $user]);
    }

    public function perintah(){
        $user = Auth::user(); // Get the currently logged-in user
        return view('perintah_template', ['user' => $user]);
    }

    public function pernyataan(){
        $user = Auth::user(); // Get the currently logged-in user
        return view('pernyataan_template', ['user' => $user]);
    }
    
    public function profile(){
        $user = Auth::user(); // Get the currently logged-in user
        return view('profile', ['user' => $user]);
    }

    public function profileUpdate(){
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'profile' => 'required',
        ]);

        $user = Auth::user();

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
        
        DB::table('tbl_walas')->where('idwalas',$request->idwalas)->update([

            'fotowalas' => $fotowalas,
            'namawalas' => $request->namawalas,
            'nip' => $request->nip,
            'kelaswalas' => $request->kelaswalas,
            'mapel' => $request->mapel
        ]);

        return redirect('/');
    }


    public function suratIjin(Request $request)
    {
        // Retrieve the values of paragraf from the request
        $paragraf1 = $request->input('paragraf1');
        $paragraf2 = $request->input('paragraf2');
        $paragraf3 = $request->input('paragraf3');

        $kop_surat = KopSuratModel::latest()->first();
        $kepala_sekolah = KepalaSekolahModel::latest()->first();

        // Paths to the image files
        $logoImagePath = public_path('data_file/' . $kop_surat->logo_instansi);
        $tandaTanganPath = public_path('data_file/' . $kepala_sekolah->tanda_tangan);

        // Check if the image files exist
        if (file_exists($logoImagePath) && file_exists($tandaTanganPath)) {
            // Resize the logo to 100px width
            $logo = Image::make($logoImagePath)->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Convert the resized logo to base64
            $resizedLogo = 'data:image/png;base64,' . base64_encode($logo->stream()->__toString());

            // Load the view and set the default font to Arial
            $pdf = PDF::loadView('surat.ijin', [
                'image' => $resizedLogo,
                'tanda_tangan' => 'data:image/png;base64,' . base64_encode(file_get_contents($tandaTanganPath)),
                'kop_surat' => $kop_surat,
                'kepala_sekolah' => $kepala_sekolah,
                'paragraf1' => $paragraf1, // Pass the paragraf values to the view
                'paragraf2' => $paragraf2,
                'paragraf3' => $paragraf3,
            ])->setOptions([
                'defaultFont' => 'Arial',
            ]);

            $pdf->setPaper('a4', 'portrait');

            // Save the PDF to a file or return it as a download
            return $pdf->stream('NamaSurat.pdf');
        } else {
            return "Image file not found.";
        }
    }



    public function suratPengantar()
    {
        // Use the correct directory separator for your OS
        $path = public_path() . '/data_file/kop_surat.png';
    
        // Check if the image file exists
        if (file_exists($path)) {
            $image = 'data:image/png;base64,' . base64_encode(file_get_contents($path));
    
            $namaFile = 'NamaSurat.pdf';
    
            // Load the view and set the default font to Arial
            $pdf = PDF::loadView('surat.pengantar', ['image' => $image])->setOptions([
                'defaultFont' => 'Arial', // Set the default font to Arial
            ]);
            $pdf->setPaper('a4', 'portrait');
    
            // Save the PDF to a file or return it as a download
            return $pdf->stream($namaFile);
            // return $pdf->download($namaFile);
            // return view('surat.pengantar', ['image' => $image]);
        } else {
            // Handle the case when the image file does not exist
            return "Image file not found.";
        }
    }

    public function suratPerintah()
    {
        // Use the correct directory separator for your OS
        $path = public_path() . '/data_file/kop_surat.png';
    
        // Check if the image file exists
        if (file_exists($path)) {
            $image = 'data:image/png;base64,' . base64_encode(file_get_contents($path));
    
            $namaFile = 'NamaSurat.pdf';
    
            // Load the view and set the default font to Arial
            $pdf = PDF::loadView('surat.perintah', ['image' => $image])->setOptions([
                'defaultFont' => 'Arial', // Set the default font to Arial
            ]);
            $pdf->setPaper('a4', 'portrait');
    
            // Save the PDF to a file or return it as a download
            return $pdf->stream($namaFile);
            // return $pdf->download($namaFile);
            // return view('surat.perintah', ['image' => $image]);
        } else {
            // Handle the case when the image file does not exist
            return "Image file not found.";
        }
    }

    public function suratPernyataan()
    {
        // Use the correct directory separator for your OS
        $path = public_path() . '/data_file/kop_surat.png';
    
        // Check if the image file exists
        if (file_exists($path)) {
            $image = 'data:image/png;base64,' . base64_encode(file_get_contents($path));
    
            $namaFile = 'NamaSurat.pdf';
    
            // Load the view and set the default font to Arial
            $pdf = PDF::loadView('surat.pernyataan', ['image' => $image])->setOptions([
                'defaultFont' => 'Arial', // Set the default font to Arial
            ]);
            $pdf->setPaper('a4', 'portrait');
    
            // Save the PDF to a file or return it as a download
            return $pdf->stream($namaFile);
            // return $pdf->download($namaFile);
            // return view('surat.pernyataan', ['image' => $image]);
        } else {
            // Handle the case when the image file does not exist
            return "Image file not found.";
        }
    }
    
    
    public function settings(){

        $kop_surat = KopSuratModel::latest()->first();
        $kepala_sekolah = KepalaSekolahModel::latest()->first();
        $kode_pos = KodePosModel::all();
        $user = Auth::user(); // Get the currently logged-in user
        return view('settings', ['user' => $user, 'kop_surat' => $kop_surat, 'kepala_sekolah' => $kepala_sekolah, 'kode_pos' => $kode_pos, ]);
    }


    public function kopSuratStore(Request $request)
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
        return redirect('/surat_arsip');
    }
}
// $path = public_path() . 'data_file/kop_surat.png';
// $type = pathinfo($path, PATHINFO_EXTENSION);
// $data = file_get_contents($path);
// $image = 'data:image/' . $type . ';base64' . base64_encode($data);

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