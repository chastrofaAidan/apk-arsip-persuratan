<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Intervention\Image\Facades\Image;
use App\Models\ArsipModel;
use App\Models\SuratKeluarModel;
use App\Models\KodeSuratModel;
use App\Models\KopSuratModel;
use App\Models\KepalaSekolahModel;
use App\Models\User;

use PDF;
// use Barryvdh\DomPDF\PDF;

class TemplateSuratController extends Controller
{
    public function ijin()
    {
        $kop_surat = KopSuratModel::latest()->first();
        $kepala_sekolah = KepalaSekolahModel::latest()->first();

        // Paths to the image files
        $logoImagePath = public_path('data_file/' . $kop_surat->logo_instansi);
        $tandaTanganPath = public_path('data_file/' . $kepala_sekolah->tanda_tangan);

        $user = Auth::user(); // Get the currently logged-in user
        $kode_surat = KopSuratModel::latest('id_kop_surat')->first();
        $datakodesurat = KodeSuratModel::all();

        

        $lastRecord = SuratKeluarModel::latest('no_keluar')->first();
        $newNoKeluarValue = ($lastRecord) ? $lastRecord->no_keluar + 1 : 1;

        // Check if the image files exist
        if (file_exists($logoImagePath) && file_exists($tandaTanganPath)) {
            // Resize the logo to 100px width
            $logo = Image::make($logoImagePath)->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Convert the resized logo to base64
            $resizedLogo = 'data:image/png;base64,' . base64_encode($logo->stream()->__toString());

            return view('surat keluar/template surat/ijin_template', [
                'image' => $resizedLogo,
                'tanda_tangan' => 'data:image/png;base64,' . base64_encode(file_get_contents($tandaTanganPath)),
                'user' => $user, 'newNoKeluarValue' => $newNoKeluarValue, 
                'kode_surat' => $kode_surat, 
                'datakodesurat' => $datakodesurat,
                'kop_surat' => $kop_surat,
                'kepala_sekolah' => $kepala_sekolah,
            ]);
        } else {
            return "Image file not found.";
        }



        // // Check if the image files exist
        // if (file_exists($logoImagePath) && file_exists($tandaTanganPath)) {
        //     // Resize the logo to 100px width
        //     $logo = Image::make($logoImagePath)->resize(100, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //     });

        //     // Convert the resized logo to base64
        //     $resizedLogo = 'data:image/png;base64,' . base64_encode($logo->stream()->__toString());

        //     // Load the view and set the default font to Arial
        //     $pdf = PDF::loadView('surat-pdf.ijin', [
        //         'image' => $resizedLogo,
        //         'tanda_tangan' => 'data:image/png;base64,' . base64_encode(file_get_contents($tandaTanganPath)),
        //         'kop_surat' => $kop_surat,
        //         'kepala_sekolah' => $kepala_sekolah,
        //         // 'paragraf1' => $paragraf1, // Pass the paragraf values to the view
        //         // 'paragraf2' => $paragraf2,
        //         // 'paragraf3' => $paragraf3,
        //     ])->setOptions([
        //         'defaultFont' => 'Arial',
        //     ]);

        //     $pdf->setPaper('a4', 'portrait');

        //     // Save the PDF to a file or return it as a download
        //     return $pdf->stream('NamaSurat.pdf');
        // } else {
        //     return "Image file not found.";
        // }
    }


    public function pengantar()
    {
        $kop_surat = KopSuratModel::latest()->first();
        $kepala_sekolah = KepalaSekolahModel::latest()->first();

        // Paths to the image files
        $logoImagePath = public_path('data_file/' . $kop_surat->logo_instansi);
        $tandaTanganPath = public_path('data_file/' . $kepala_sekolah->tanda_tangan);

        $user = Auth::user(); // Get the currently logged-in user
        $kode_surat = KopSuratModel::latest('id_kop_surat')->first();
        $datakodesurat = KodeSuratModel::all();

        

        $lastRecord = SuratKeluarModel::latest('no_keluar')->first();
        $newNoKeluarValue = ($lastRecord) ? $lastRecord->no_keluar + 1 : 1;

        // Check if the image files exist
        if (file_exists($logoImagePath) && file_exists($tandaTanganPath)) {
            // Resize the logo to 100px width
            $logo = Image::make($logoImagePath)->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Convert the resized logo to base64
            $resizedLogo = 'data:image/png;base64,' . base64_encode($logo->stream()->__toString());

            return view('surat keluar/template surat/pengantar_template', [
                'image' => $resizedLogo,
                'tanda_tangan' => 'data:image/png;base64,' . base64_encode(file_get_contents($tandaTanganPath)),
                'user' => $user, 'newNoKeluarValue' => $newNoKeluarValue, 
                'kode_surat' => $kode_surat, 
                'datakodesurat' => $datakodesurat,
                'kop_surat' => $kop_surat,
                'kepala_sekolah' => $kepala_sekolah,
            ]);
        } else {
            return "Image file not found.";
        }
    }

    public function perintah()
    {
        $kop_surat = KopSuratModel::latest()->first();
        $kepala_sekolah = KepalaSekolahModel::latest()->first();

        // Paths to the image files
        $logoImagePath = public_path('data_file/' . $kop_surat->logo_instansi);
        $tandaTanganPath = public_path('data_file/' . $kepala_sekolah->tanda_tangan);

        $user = Auth::user(); // Get the currently logged-in user
        $kode_surat = KopSuratModel::latest('id_kop_surat')->first();
        $datakodesurat = KodeSuratModel::all();

        

        $lastRecord = SuratKeluarModel::latest('no_keluar')->first();
        $newNoKeluarValue = ($lastRecord) ? $lastRecord->no_keluar + 1 : 1;

        // Check if the image files exist
        if (file_exists($logoImagePath) && file_exists($tandaTanganPath)) {
            // Resize the logo to 100px width
            $logo = Image::make($logoImagePath)->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Convert the resized logo to base64
            $resizedLogo = 'data:image/png;base64,' . base64_encode($logo->stream()->__toString());

            return view('surat keluar/template surat/perintah_template', [
                'image' => $resizedLogo,
                'tanda_tangan' => 'data:image/png;base64,' . base64_encode(file_get_contents($tandaTanganPath)),
                'user' => $user, 'newNoKeluarValue' => $newNoKeluarValue, 
                'kode_surat' => $kode_surat, 
                'datakodesurat' => $datakodesurat,
                'kop_surat' => $kop_surat,
                'kepala_sekolah' => $kepala_sekolah,
            ]);
        } else {
            return "Image file not found.";
        }
    }

    public function pernyataan()
    {
        $kop_surat = KopSuratModel::latest()->first();
        $kepala_sekolah = KepalaSekolahModel::latest()->first();

        // Paths to the image files
        $logoImagePath = public_path('data_file/' . $kop_surat->logo_instansi);
        $tandaTanganPath = public_path('data_file/' . $kepala_sekolah->tanda_tangan);

        $user = Auth::user(); // Get the currently logged-in user
        $kode_surat = KopSuratModel::latest('id_kop_surat')->first();
        $datakodesurat = KodeSuratModel::all();

        

        $lastRecord = SuratKeluarModel::latest('no_keluar')->first();
        $newNoKeluarValue = ($lastRecord) ? $lastRecord->no_keluar + 1 : 1;

        // Check if the image files exist
        if (file_exists($logoImagePath) && file_exists($tandaTanganPath)) {
            // Resize the logo to 100px width
            $logo = Image::make($logoImagePath)->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Convert the resized logo to base64
            $resizedLogo = 'data:image/png;base64,' . base64_encode($logo->stream()->__toString());

            return view('surat keluar/template surat/pernyataan_template', [
                'image' => $resizedLogo,
                'tanda_tangan' => 'data:image/png;base64,' . base64_encode(file_get_contents($tandaTanganPath)),
                'user' => $user, 'newNoKeluarValue' => $newNoKeluarValue, 
                'kode_surat' => $kode_surat, 
                'datakodesurat' => $datakodesurat,
                'kop_surat' => $kop_surat,
                'kepala_sekolah' => $kepala_sekolah,
            ]);
        } else {
            return "Image file not found.";
        }
    }


    // public function suratIjin(Request $request)
    // {
    //     $kop_surat = KopSuratModel::latest()->first();
    //     $kepala_sekolah = KepalaSekolahModel::latest()->first();

    //     // Paths to the image files
    //     $logoImagePath = public_path('data_file/' . $kop_surat->logo_instansi);
    //     $tandaTanganPath = public_path('data_file/' . $kepala_sekolah->tanda_tangan);

    //     // Check if the image files exist
    //     if (file_exists($logoImagePath) && file_exists($tandaTanganPath)) {
    //         // Resize the logo to 100px width
    //         $logo = Image::make($logoImagePath)->resize(100, null, function ($constraint) {
    //             $constraint->aspectRatio();
    //         });

    //         // Convert the resized logo to base64
    //         $resizedLogo = 'data:image/png;base64,' . base64_encode($logo->stream()->__toString());

    //         // Load the view and set the default font to Arial
    //         $pdf = PDF::loadView('surat-pdf.ijin', [
    //             'image' => $resizedLogo,
    //             'tanda_tangan' => 'data:image/png;base64,' . base64_encode(file_get_contents($tandaTanganPath)),
    //             'kop_surat' => $kop_surat,
    //             'kepala_sekolah' => $kepala_sekolah,
    //             // 'paragraf1' => $paragraf1, // Pass the paragraf values to the view
    //             // 'paragraf2' => $paragraf2,
    //             // 'paragraf3' => $paragraf3,
    //         ])->setOptions([
    //             'defaultFont' => 'Arial',
    //         ]);

    //         $pdf->setPaper('a4', 'portrait');

    //         // Save the PDF to a file or return it as a download
    //         return $pdf->stream('NamaSurat.pdf');
    //     } else {
    //         return "Image file not found.";
    //     }
    // }



    // public function suratPengantar()
    // {
    //     // Use the correct directory separator for your OS
    //     $path = public_path() . '/data_file/kop_surat.png';

    //     // Check if the image file exists
    //     if (file_exists($path)) {
    //         $image = 'data:image/png;base64,' . base64_encode(file_get_contents($path));

    //         $namaFile = 'NamaSurat.pdf';

    //         // Load the view and set the default font to Arial
    //         $pdf = PDF::loadView('surat-pdf.pengantar', ['image' => $image])->setOptions([
    //             'defaultFont' => 'Arial', // Set the default font to Arial
    //         ]);
    //         $pdf->setPaper('a4', 'portrait');

    //         // Save the PDF to a file or return it as a download
    //         return $pdf->stream($namaFile);
    //         // return $pdf->download($namaFile);
    //         // return view('surat.pengantar', ['image' => $image]);
    //     } else {
    //         // Handle the case when the image file does not exist
    //         return "Image file not found.";
    //     }
    // }

    // public function suratPerintah()
    // {
    //     // Use the correct directory separator for your OS
    //     $path = public_path() . '/data_file/kop_surat.png';

    //     // Check if the image file exists
    //     if (file_exists($path)) {
    //         $image = 'data:image/png;base64,' . base64_encode(file_get_contents($path));

    //         $namaFile = 'NamaSurat.pdf';

    //         // Load the view and set the default font to Arial
    //         $pdf = PDF::loadView('surat-pdf.perintah', ['image' => $image])->setOptions([
    //             'defaultFont' => 'Arial', // Set the default font to Arial
    //         ]);
    //         $pdf->setPaper('a4', 'portrait');

    //         // Save the PDF to a file or return it as a download
    //         return $pdf->stream($namaFile);
    //         // return $pdf->download($namaFile);
    //         // return view('surat.perintah', ['image' => $image]);
    //     } else {
    //         // Handle the case when the image file does not exist
    //         return "Image file not found.";
    //     }
    // }

    // public function suratPernyataan()
    // {
    //     // Use the correct directory separator for your OS
    //     $path = public_path() . '/data_file/kop_surat.png';

    //     // Check if the image file exists
    //     if (file_exists($path)) {
    //         $image = 'data:image/png;base64,' . base64_encode(file_get_contents($path));

    //         $namaFile = 'NamaSurat.pdf';

    //         // Load the view and set the default font to Arial
    //         $pdf = PDF::loadView('surat-pdf.pernyataan', ['image' => $image])->setOptions([
    //             'defaultFont' => 'Arial', // Set the default font to Arial
    //         ]);
    //         $pdf->setPaper('a4', 'portrait');

    //         // Save the PDF to a file or return it as a download
    //         return $pdf->stream($namaFile);
    //         // return $pdf->download($namaFile);
    //         // return view('surat.pernyataan', ['image' => $image]);
    //     } else {
    //         // Handle the case when the image file does not exist
    //         return "Image file not found.";
    //     }
    // }


    public function settings()
    {
        $kop_surat = KopSuratModel::latest()->first();
        $kepala_sekolah = KepalaSekolahModel::latest()->first();
        $kode_surat = KodeSuratModel::all();
        $user = Auth::user(); // Get the currently logged-in user
        return view('settings', ['user' => $user, 'kop_surat' => $kop_surat, 'kepala_sekolah' => $kepala_sekolah, 'kode_surat' => $kode_surat,]);
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
            'kode_surat' => 'required',
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
        $kop_surat->kode_surat = $request->input('kode_surat');
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

    public function kodeSuratTambah(){
        $user = Auth::user(); // Get the currently logged-in user
        $lastRecord = kodeSuratModel::latest('id_kode_surat')->first();
        $newNoMasukValue = ($lastRecord) ? $lastRecord->id_kode_surat + 1 : 1;

        return view('kode-surat.kode_surat_tambah', ['user' => $user, 'newNoMasukValue' => $newNoMasukValue]);
    }

    public function kodeSuratStore(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'id_kode_surat' => 'required',
            'kode_surat' => 'required',
            'keterangan_kode_surat' => 'required',
        ]);

        // Create a new ArsipModel instance and populate it with the validated data
        $kodeSurat = new kodeSuratModel();
        $kodeSurat->id_kode_surat = $validatedData['id_kode_surat'];
        $kodeSurat->kode_surat = $validatedData['kode_surat'];
        $kodeSurat->keterangan_kode_surat = $validatedData['keterangan_kode_surat'];

        // Save the new record to the database
        $kodeSurat->save();

        // Redirect to a success page or another appropriate action
        return redirect('/settings');   
    }

    public function kodeSuratEdit($id_kode_surat)
    {
        $user = Auth::user(); // Get the currently logged-in user
        $kode_surat = DB::table('kode_surat')->where('id_kode_surat', $id_kode_surat)->get();

        return view('kode-surat.kode_surat_edit', ['user' => $user, 'datakodesurat' => $kode_surat]);
    }

    public function kodeSuratUpdate(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'id_kode_surat' => 'required',
            'kode_surat' => 'required',
            'keterangan_kode_surat' => 'required',
        ]);

        // Find the Arsip record by its ID
        $kodeSurat = kodeSuratModel::find($request->input('id_kode_surat'));

        // Update the record with the validated data
        $kodeSurat->id_kode_surat = $validatedData['id_kode_surat'];
        $kodeSurat->kode_surat = $validatedData['kode_surat'];
        $kodeSurat->keterangan_kode_surat = $validatedData['keterangan_kode_surat'];


        // Save the updated record to the database
        $kodeSurat->save();

        // Redirect to a success page or another appropriate action
        return redirect('/settings')->with('success', 'Surat Masuk updated successfully.');
    }

    public function kodeSuratHapus($id_kode_surat)
    {
        DB::table('kode_surat')->where('id_kode_surat', $id_kode_surat)->delete();

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Kode Surat deleted successfully');
    }
}