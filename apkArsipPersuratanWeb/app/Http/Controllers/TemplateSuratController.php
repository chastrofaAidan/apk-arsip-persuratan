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
            $pdf = PDF::loadView('surat-pdf.ijin', [
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
            $pdf = PDF::loadView('surat-pdf.pengantar', ['image' => $image])->setOptions([
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
            $pdf = PDF::loadView('surat-pdf.perintah', ['image' => $image])->setOptions([
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
            $pdf = PDF::loadView('surat-pdf.pernyataan', ['image' => $image])->setOptions([
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


    public function settings()
    {
        $kop_surat = KopSuratModel::latest()->first();
        $kepala_sekolah = KepalaSekolahModel::latest()->first();
        $kode_pos = KodePosModel::all();
        $user = Auth::user(); // Get the currently logged-in user
        return view('settings', ['user' => $user, 'kop_surat' => $kop_surat, 'kepala_sekolah' => $kepala_sekolah, 'kode_pos' => $kode_pos,]);
    }



    
    public function kopSuratUpdate(Request $request)
    {
        // Validasi data jika diperlukan
        $request->validate([
            'kode_surat' => 'required',
            'nama_instansi' => 'required',
            'kontak_instansi' => 'required',
            'website_instansi' => 'required',
            'email_instansi' => 'required|email',
            'kode_pos' => 'required',
            'lingkup_wilayah' => 'required',
        ]);

        // Find the KopSuratModel instance by its ID or create a new one
        $kop_surat = KopSuratModel::find($request->input('id_kop_surat'));

        // Update the properties of the $kop_surat object
        $kop_surat->kode_surat = $request->input('kode_surat');
        $kop_surat->nama_instansi = $request->input('nama_instansi');
        $kop_surat->kontak_instansi = $request->input('kontak_instansi');
        $kop_surat->website_instansi = $request->input('website_instansi');
        $kop_surat->email_instansi = $request->input('email_instansi');
        $kop_surat->kode_pos = $request->input('kode_pos');
        $kop_surat->lingkup_wilayah = $request->input('lingkup_wilayah');

        // Proses dan simpan gambar profil jika ada
        if ($request->hasFile('logo_instansi')) {
            // Tambahkan logika penyimpanan gambar sesuai kebutuhan
            $image = $request->file('logo_instansi');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('data_file'), $imageName);

            // Simpan nama gambar ke dalam kolom logo_instansi
            $kop_surat->logo_instansi = $imageName;
        } else {
            // Read the latest record from the database
            $record = DB::table('kop_surat')
                ->where('id_kop_surat', $request->id_kop_surat)
                ->latest() // Assuming you want the latest record based on some criteria
                ->first();

                // Access the property only if $record is not null
                $image = $record->logo_instansi;
                $kop_surat->logo_instansi = $image;
        }
        // Simpan perubahan
        $kop_surat->save();

        // Redirect to a success page or another appropriate action
        return redirect('/settings')->with('success', 'Kop Surat updated successfully.');
    }




    public function kepalaSekolahUpdate(Request $request)
    {
        // Validate the form data
        $request->validate([
            'nama_kepala_sekolah' => 'required|string',
            'golongan_kepala_sekolah' => 'required|string',
            'nip_kepala_sekolah' => 'required|string',
            'tanda_tangan' => 'image|mimes:jpeg,png,jpg|max:2048', // Adjust the validation rules for the image upload
        ]);

        // Find the existing kepala_sekolah record
        $kepala_sekolah = kepalaSekolahModel::find($request->id_kepala_sekolah);

        // Update the kepala_sekolah attributes with the form data
        $kepala_sekolah->nama_kepala_sekolah = $request->nama_kepala_sekolah;
        $kepala_sekolah->golongan_kepala_sekolah = $request->golongan_kepala_sekolah;
        $kepala_sekolah->nip_kepala_sekolah = $request->nip_kepala_sekolah;

        // Check if a new file is uploaded
        if ($request->hasFile('tanda_tangan')) {
            $file = $request->file('tanda_tangan');
            $photo = time() . "_" . $file->getClientOriginalName();
            $tujuanupload = 'data_file';
            $file->move($tujuanupload, $photo);

            // Delete the old file if it exists
            if ($kepala_sekolah->tanda_tangan) {
                $oldFilePath = public_path('data_file/' . $kepala_sekolah->tanda_tangan);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Update the kepala_sekolah with the new file name
            $kepala_sekolah->tanda_tangan = $photo;
        }

        // Save the updated kepala_sekolah
        $kepala_sekolah->save();

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Kepala Sekolah updated successfully');
    }

    public function kodePosTambah(){
        $user = Auth::user(); // Get the currently logged-in user
        $lastRecord = kodePosModel::latest('id_kode_pos')->first();
        $newNoMasukValue = ($lastRecord) ? $lastRecord->id_kode_pos + 1 : 1;

        return view('kode-pos.kode_pos_tambah', ['user' => $user, 'newNoMasukValue' => $newNoMasukValue]);
    }

    public function kodePosStore(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'id_kode_pos' => 'required',
            'kode_pos' => 'required',
            'keterangan_kode_pos' => 'required',
        ]);

        // Create a new ArsipModel instance and populate it with the validated data
        $kodePos = new kodePosModel();
        $kodePos->id_kode_pos = $validatedData['id_kode_pos'];
        $kodePos->kode_pos = $validatedData['kode_pos'];
        $kodePos->keterangan_kode_pos = $validatedData['keterangan_kode_pos'];

        // Save the new record to the database
        $kodePos->save();

        // Redirect to a success page or another appropriate action
        return redirect('/settings');   
    }

    public function kodePosEdit($id_kode_pos)
    {
        $user = Auth::user(); // Get the currently logged-in user
        $kode_pos = DB::table('kode_pos')->where('id_kode_pos', $id_kode_pos)->get();

        return view('kode-pos.kode_pos_edit', ['user' => $user, 'datakodepos' => $kode_pos]);
    }

    public function kodePosUpdate(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'id_kode_pos' => 'required',
            'kode_pos' => 'required',
            'keterangan_kode_pos' => 'required',
        ]);

        // Find the Arsip record by its ID
        $kodePos = kodePosModel::find($request->input('id_kode_pos'));

        // Update the record with the validated data
        $kodePos->id_kode_pos = $validatedData['id_kode_pos'];
        $kodePos->kode_pos = $validatedData['kode_pos'];
        $kodePos->keterangan_kode_pos = $validatedData['keterangan_kode_pos'];


        // Save the updated record to the database
        $kodePos->save();

        // Redirect to a success page or another appropriate action
        return redirect('/settings')->with('success', 'Surat Masuk updated successfully.');
    }

    public function kodePosHapus($id_kode_pos)
    {
        DB::table('kode_pos')->where('id_kode_pos', $id_kode_pos)->delete();

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Kode Surat deleted successfully');
    }
}