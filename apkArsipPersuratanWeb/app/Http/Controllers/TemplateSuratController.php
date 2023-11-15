<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Intervention\Image\Facades\Image;
use App\Models\ArsipModel;
use App\Models\SuratKeluarModel;
use App\Models\KodePosModel;
use App\Models\KopSuratModel;
use App\Models\KepalaSekolahModel;
use App\Models\User;
use PDF;
// use Barryvdh\DomPDF\PDF;

class TemplateSuratController extends Controller
{
    public function ijin()
    {
        $user = Auth::user(); // Get the currently logged-in user
        $kode_surat = KopSuratModel::latest('id_kop_surat')->first();

        $lastRecord = SuratKeluarModel::latest('no_keluar')->first();
        $newNoKeluarValue = ($lastRecord) ? $lastRecord->no_keluar + 1 : 1;

        return view('surat keluar/template surat/ijin_template', ['user' => $user, 'newNoKeluarValue' => $newNoKeluarValue, 'kode_surat' => $kode_surat]);
    }


    public function pengantar()
    {
        $user = Auth::user(); // Get the currently logged-in user
        return view('surat keluar/template surat/pengantar_template', ['user' => $user]);
    }

    public function perintah()
    {
        $user = Auth::user(); // Get the currently logged-in user
        return view('surat keluar/template surat/perintah_template', ['user' => $user]);
    }

    public function pernyataan()
    {
        $user = Auth::user(); // Get the currently logged-in user
        return view('surat keluar/template surat/pernyataan_template', ['user' => $user]);
    }

    public function profile()
    {
        $user = Auth::user(); // Get the currently logged-in user
        return view('profile', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        // Validasi data jika diperlukan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required',
        ]);

        // Perbarui data user berdasarkan ID atau data yang unik lainnya
        $user = User::find($request->input('user_id'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Perbarui password jika diisi
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // Proses dan simpan gambar profil jika ada
        if ($request->hasFile('profile')) {
            // Tambahkan logika penyimpanan gambar sesuai kebutuhan
            $image = $request->file('profile');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('data_file'), $imageName);

            // Simpan nama gambar ke dalam kolom profile
            $user->profile = $imageName;
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


    public function kopSuratUpdate(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'kode_surat' => 'required',
            'nama_instansi' => 'required',
            'logo_instansi' => 'file',  // Assuming logo_instansi is expected to be a file
            'kontak_instansi' => 'required',
            'website_instansi' => 'required',
            'email_instansi' => 'required|email',
            'kode_pos' => 'required',
            'lingkup_wilayah' => 'required',
        ]);

        // Find the Arsip record by its ID
        $kop_surat = KopSuratModel::find($request->input('id_kop_surat'));

        if (!$kop_surat) {
            // Handle the case where the record with the given ID is not found
            return redirect('/settings')->with('error', 'Kop Surat not found.');
        }

        // Check if the "file" input is empty
        if (!$request->hasFile('logo_instansi')) {
            // Assign the previous value to the "logo_instansi" field
            $photo = $kop_surat->logo_instansi;
        } else {
            // Handle the case when a new file is uploaded
            $file = $request->file('logo_instansi');
            $photo = time() . "_" . $file->getClientOriginalName();
            $tujuanupload = 'data_file';
            $file->move($tujuanupload, $photo);
        }

        // Update the record with the validated data
        $kop_surat->kode_surat = $validatedData['kode_surat'];
        $kop_surat->nama_instansi = $validatedData['nama_instansi'];
        $kop_surat->logo_instansi = $photo;
        $kop_surat->kontak_instansi = $validatedData['kontak_instansi'];
        $kop_surat->website_instansi = $validatedData['website_instansi'];
        $kop_surat->email_instansi = $validatedData['email_instansi'];
        $kop_surat->kode_pos = $validatedData['kode_pos'];
        $kop_surat->lingkup_wilayah = $validatedData['lingkup_wilayah'];

        // Save the updated record to the database
        $kop_surat->save();

        // Redirect to a success page or another appropriate action
        return redirect('/settings')->with('success', 'Kop Surat updated successfully.');
    }

    public function kepalaSekolahUpdate(Request $request)
    {
        // Retrieve the existing record from the database
        $record = DB::table('kepala_sekolah')->where('id_kepala_sekolah', $request->id_kepala_sekolah)->first();

        // Check if the record exists
        if ($record) {
            // Delete the existing record
            DB::table('kepala_sekolah')->where('id_kepala_sekolah', $request->id_kepala_sekolah)->delete();
            
            // Handle file deletion (optional)
            $this->deleteFile($record->tanda_tangan);

            // Handle the case when a new file is uploaded
            $file = $request->file('tanda_tangan');
            $photo = time() . "_" . $file->getClientOriginalName();
            $tujuanupload = 'data_file';
            $file->move($tujuanupload, $photo);
            $tanda_tangan = $photo;

            // Create a new record
            DB::table('kepala_sekolah')->insert([
                'id_kepala_sekolah' => $request->id_kepala_sekolah,
                'nama_kepala_sekolah' => $request->nama_kepala_sekolah,
                'golongan_kepala_sekolah' => $request->golongan_kepala_sekolah,
                'nip_kepala_sekolah' => $request->nip_kepala_sekolah,
                'tanda_tangan' => $tanda_tangan,
            ]);

            // Redirect to the settings page
            return redirect('/settings');
        } else {
            // Handle the case when no record is found
            return abort(404);
        }
    }

    // Optional: Method to delete a file
    private function deleteFile($filename)
    {
        $filePath = public_path('data_file/' . $filename);

        // Check if the file exists before attempting to delete it
        if (file_exists($filePath)) {
            unlink($filePath);
        }
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