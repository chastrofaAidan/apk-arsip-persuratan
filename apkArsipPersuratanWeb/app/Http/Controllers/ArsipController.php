<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\ArsipModel;
use App\Models\SuratMasukModel;
use App\Models\SuratKeluarModel;
use App\Models\User;
use App\Models\KodeSuratModel;
use App\Models\KopSuratModel;
use Barryvdh\DomPDF\PDF as PDF;

class ArsipController extends Controller
{
    function index()
    {
        $user = Auth::user(); // Get the currently logged-in user

        $surat_arsip = ArsipModel::all();
        $arsip = $surat_arsip->count();

        $surat_masuk = SuratMasukModel::all();
        $masuk = $surat_masuk->count();

        $surat_keluar = SuratKeluarModel::all();
        $keluar = $surat_keluar->count();

        return view('dashboard', ['user' => $user, 'arsip' => $arsip, 'masuk' => $masuk, 'keluar' => $keluar]);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Cari Arsip
    public function arsip(Request $request)
    {
        $user = Auth::user();
        $perusahaanList = ArsipModel::pluck('perusahaan', 'perusahaan')->unique();

        $admins = User::where('role', 'admin')->get();

        $perPage = $request->input('per_page', 10);

        $arsip = ArsipModel::orderBy('id_surat', 'desc')->paginate($perPage);

        return view('surat arsip/arsip_index', [
            'user' => $user,
            'admins' => $admins,
            'dataarsip' => $arsip,
            'perPage' => $perPage,
            'perusahaanList' => $perusahaanList,
        ]);
    }

    public function keluar(Request $request)
    {
        $user = Auth::user(); // Get the currently logged-in user
        $tujuanList = SuratKeluarModel::pluck('ditujukan', 'ditujukan')->unique();
        $perihalList = SuratKeluarModel::pluck('perihal_keluar', 'perihal_keluar')->unique();
        $admins = User::where('role', 'admin')->get();

        $perPage = $request->input('per_page', 10); // Default to 10 records per page

        // Use the query builder to paginate the results
        $surat_keluar = SuratKeluarModel::orderBy('no_keluar', 'desc')->paginate($perPage);

        return view('surat keluar/surat_keluar', ['user' => $user, 'datakeluar' => $surat_keluar, 'perPage' => $perPage, 'tujuanList' => $tujuanList, 'admins' => $admins, 'perihalList' => $perihalList,]);
    }

    public function masuk(Request $request)
    {
        $user = Auth::user();
        $pengirimList = SuratMasukModel::pluck('pengirim', 'pengirim')->unique();
        $admins = User::where('role', 'admin')->get();

        $perPage = $request->input('per_page', 10);

        $surat_masuk = SuratMasukModel::with('user')->orderBy('no_masuk', 'desc')->paginate($perPage);

        return view('surat masuk/surat_masuk', [
            'user' => $user,
            'datamasuk' => $surat_masuk,
            'admins' => $admins,
            'perPage' => $perPage,
            'pengirimList' => $pengirimList,
        ]);
    }


    public function cariArsip(Request $request)
    {
        $searchTerm = $request->input('search');
        $searchPerusahaan = $request->input('perusahaan');
        $searchPengarsip = $request->input('pengarsip');

        $query = ArsipModel::query();

        if ($searchTerm && $searchTerm !== 'all') {
            $query->where(function ($subquery) use ($searchTerm) {
                $subquery->where('judul_surat', 'like', "%{$searchTerm}%")
                    ->orWhere('jenis_surat', 'like', "%{$searchTerm}%")
                    ->orWhere('kode_surat', 'like', "%{$searchTerm}%")
                    ->orWhere('perihal_surat', 'like', "%{$searchTerm}%");
            });
        }

        if ($searchPerusahaan && $searchPerusahaan !== 'all') {
            $query->where('perusahaan', $searchPerusahaan);
        }

        if ($searchPengarsip && $searchPengarsip !== 'all') {
            // Menggunakan relasi 'user' untuk mencari berdasarkan nama pengguna
            $query->whereHas('user', function ($subquery) use ($searchPengarsip) {
                $subquery->where('id', $searchPengarsip);
            });
        }

        $dataarsip = $query->paginate(10);

        return view('surat arsip/cari_arsip', ['dataarsip' => $dataarsip]);
    }

    public function cariSuratKeluar(Request $request)
    {
        $searchTerm = $request->input('search');
        $searchDitujukan = $request->input('ditujukan');
        $searchPendata = $request->input('pendata');
        $searchPerihal = $request->input('perihal'); // tambahkan perihal

        $query = SuratKeluarModel::query();

        if ($searchTerm && $searchTerm !== 'all') {
            $query->where(function ($subquery) use ($searchTerm) {
                $subquery->where('perihal_keluar', 'like', "%{$searchTerm}%")
                    ->orWhere('ditujukan', 'like', "%{$searchTerm}%")
                    ->orWhere('kode_keluar', 'like', "%{$searchTerm}%")
                    ->orWhere('tanggal_keluar', 'like', "%{$searchTerm}%");
            });
        }

        if ($searchDitujukan && $searchDitujukan !== 'all') {
            $query->where('ditujukan', $searchDitujukan);
        }

        if ($searchPerihal && $searchPerihal !== 'all') {
            $query->where('perihal_keluar', $searchPerihal); // tambahkan filter untuk perihal
        }

        if ($searchPendata && $searchPendata !== 'all') {
            $query->whereHas('user', function ($subquery) use ($searchPendata) {
                $subquery->where('id', $searchPendata);
            });
        }

        $datakeluar = $query->paginate(10);

        return view('surat keluar/cari_surat_keluar', ['datakeluar' => $datakeluar]);
    }

    public function cariSuratMasuk(Request $request)
    {
        $searchTerm = $request->input('search');
        $searchPengirim = $request->input('pengirim');
        $searchPendata = $request->input('pendata');
        $searchTanggal = $request->input('tgl');
        $searchNomorSurat = $request->input('nomor_surat');
        $searchPokokIsi = $request->input('pokok_isi');

        $query = SuratMasukModel::query();

        if ($searchTerm && $searchTerm !== 'all') {
            $query->where(function ($subquery) use ($searchTerm) {
                $subquery->where('pokok_masuk', 'like', "%{$searchTerm}%")
                    ->orWhere('pengirim', 'like', "%{$searchTerm}%")
                    ->orWhere('kode_masuk', 'like', "%{$searchTerm}%")
                    ->orWhere('tanggal_masuk', 'like', "%{$searchTerm}%");
            });
        }

        if ($searchPengirim && $searchPengirim !== 'all') {
            $query->where('pengirim', $searchPengirim);
        }

        if ($searchPendata && $searchPendata !== 'all') {
            $query->whereHas('user', function ($subquery) use ($searchPendata) {
                $subquery->where('id', $searchPendata);
            });
        }

        if ($searchTanggal) {
            $query->where('tanggal_masuk', $searchTanggal);
        }

        if ($searchNomorSurat) {
            $query->where('kode_masuk', $searchNomorSurat);
        }

        if ($searchPokokIsi) {
            $query->where('pokok_masuk', 'like', "%{$searchPokokIsi}%");
        }

        $datamasuk = $query->paginate(10);

        return view('surat masuk/cari_surat_masuk', ['datamasuk' => $datamasuk]);
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
        $user = Auth::user(); // Get the currently logged-in user

        return view('surat arsip/arsip_tambah', ['user' => $user]);
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
            'keterangan' => 'nullable', // Allow the 'keterangan' field to be nullable
        ]);

        // Get the uploaded file
        $file = $request->file('file');
        $pdf = time() . "_" . $file->getClientOriginalName();
        $tujuanupload = 'data_file';
        $file->move($tujuanupload, $pdf);

        // Get the authenticated user's ID
        $userId = Auth::id();

        // Create a new ArsipModel instance and populate it with the validated data
        $arsip = new ArsipModel();
        $arsip->kode_surat = $validatedData['kode_surat'];
        $arsip->id = $userId; // Set the user ID
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


    public function edit($id_surat)
    {
        $user = Auth::user(); // Get the currently logged-in user

        $arsip = DB::table('arsip')->where('id_surat', $id_surat)->get();


        return view('surat arsip/arsip_edit', ['user' => $user, 'dataarsip' => $arsip]);
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
            'keterangan' => '',
        ]);

        // Find the ArsipModel instance by its ID or create a new one
        $arsip = ArsipModel::find($request->input('id_surat'));

        // Get the authenticated user's ID
        $userId = Auth::id();

        // Update the properties of the $kop_surat object
        $arsip->kode_surat = $request->input('kode_surat');
        $arsip->id = $userId; // Set the user ID
        $arsip->judul_surat = $request->input('judul_surat');
        $arsip->perusahaan = $request->input('perusahaan');
        $arsip->jenis_surat = $request->input('jenis_surat');
        $arsip->tanggal_surat = $request->input('tanggal_surat');
        $arsip->perihal_surat = $request->input('perihal_surat');
        $arsip->keterangan = $request->input('keterangan');

        $pdf;
        // Proses dan simpan File PDF jika ada
        if ($request->hasFile('file_surat')) {
            // Tambahkan logika penyimpanan gambar sesuai kebutuhan
            $pdf = $request->file('file_surat');
            $pdfName = time() . '.' . $pdf->getClientOriginalExtension();
            $pdf->move(public_path('data_file'), $pdfName);

            // Simpan nama gambar ke dalam kolom file_surat
            $arsip->file_surat = $pdfName;
        }

        // Simpan perubahan
        $arsip->save();

        // Redirect to a success page or another appropriate action
        return redirect('/surat_arsip')->with('success', 'Surat Arsip updated successfully.');
    }





    public function hapus($id_surat)
    {
        DB::table('arsip')->where('id_surat', $id_surat)->delete();

        // alihkan halaman ke halaman arsip
        return redirect('/surat_arsip');
    }


    public function masukTambah()
    {
        $user = Auth::user(); // Get the currently logged-in user
        $lastRecord = SuratMasukModel::latest('no_masuk')->first();
        $newNoMasukValue = ($lastRecord) ? $lastRecord->no_masuk + 1 : 1;

        return view('surat masuk/masuk_tambah', ['user' => $user, 'newNoMasukValue' => $newNoMasukValue]);
    }


    public function masukStore(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'no_masuk' => 'required',
            'tanggal_masuk' => 'required|date',
            'kode_masuk' => 'required',
            'pengirim' => 'required',
            'identitas_masuk' => 'required',
            'pokok_masuk' => 'required',
            'keterangan_masuk' => 'required',
        ]);

        // Get the authenticated user's ID
        $userId = Auth::id();

        // Create a new ArsipModel instance and populate it with the validated data and user ID
        $masuk = new SuratMasukModel();
        $masuk->no_masuk = $validatedData['no_masuk'];
        $masuk->id = $userId; // Set the user ID
        $masuk->tanggal_masuk = $validatedData['tanggal_masuk'];
        $masuk->kode_masuk = $validatedData['kode_masuk'];
        $masuk->pengirim = $validatedData['pengirim'];
        $masuk->identitas_masuk = $validatedData['identitas_masuk'];
        $masuk->pokok_masuk = $validatedData['pokok_masuk'];
        $masuk->keterangan_masuk = $validatedData['keterangan_masuk'];

        // Save the new record to the database
        $masuk->save();

        // Redirect to a success page or another appropriate action
        return redirect('/surat_masuk');
    }



    public function masukEdit($no_masuk)
    {
        $user = Auth::user(); // Get the currently logged-in user

        $masuk = DB::table('surat_masuk')->where('no_masuk', $no_masuk)->get();


        return view('surat masuk/masuk_edit', ['user' => $user, 'datamasuk' => $masuk]);
    }


    public function masukUpdate(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'no_masuk' => 'required',
            'tanggal_masuk' => 'required|date',
            'kode_masuk' => 'required',
            'pengirim' => 'required',
            'identitas_masuk' => 'required',
            'pokok_masuk' => 'required',
            'keterangan_masuk' => '',
        ]);

        // Find the Arsip record by its ID
        $masuk = SuratMasukModel::find($request->input('no_masuk'));

        // Get the authenticated user's ID
        $userId = Auth::id();

        // Update the record with the validated data
        $masuk->no_masuk = $validatedData['no_masuk'];
        $masuk->id = $userId; // Set the user ID
        $masuk->tanggal_masuk = $validatedData['tanggal_masuk'];
        $masuk->kode_masuk = $validatedData['kode_masuk'];
        $masuk->pengirim = $validatedData['pengirim'];
        $masuk->identitas_masuk = $validatedData['identitas_masuk'];
        $masuk->pokok_masuk = $validatedData['pokok_masuk'];
        $masuk->keterangan_masuk = $validatedData['keterangan_masuk'];


        // Save the updated record to the database
        $masuk->save();

        // Redirect to a success page or another appropriate action
        return redirect('/surat_masuk')->with('success', 'Surat Masuk updated successfully.');
    }

    public function masukArsip($no_masuk)
    {
        $user = Auth::user(); // Get the currently logged-in user

        $masuk = DB::table('surat_masuk')->where('no_masuk', $no_masuk)->get();

        return view('surat arsip/arsip_tambah_masuk', ['user' => $user, 'datamasuk' => $masuk]);
    }

    public function masukHapus($no_masuk)
    {
        DB::table('surat_masuk')->where('no_masuk', $no_masuk)->delete();

        // alihkan halaman ke halaman arsip
        return redirect('/surat_masuk');
    }



    public function searchSuratKeluar(Request $request)
    {
        $user = Auth::user(); // Get the currently logged-in user

        if ($request->has('search')) {
            $search = $request->input('search'); // Get the search input from the request

            $surat_keluar = ArsipModel::where(function ($query) use ($search) {
                $query->where('kode_surat', 'LIKE', '%' . $search . '%')
                    ->orWhere('judul_surat', 'LIKE', '%' . $search . '%')
                    ->orWhere('perusahaan', 'LIKE', '%' . $search . '%')
                    ->orWhere('tanggal_surat', '=', $search)
                    ->orWhere('perihal_surat', 'LIKE', '%' . $search . '%')
                    ->orWhere('keterangan', 'LIKE', '%' . $search . '%');
            })
                ->where('jenis_surat', 'Surat Keluar')
                ->get();
        } else {
            $surat_keluar = ArsipModel::all();
        }
        return view('surat keluar/surat_keluar', ['user' => $user, 'dataarsip' => $surat_keluar]);
    }



    public function keluarTambah()
    {
        $user = Auth::user(); // Get the currently logged-in user
        $lastRecord = SuratKeluarModel::latest('no_keluar')->first();
        $newNoKeluarValue = ($lastRecord) ? $lastRecord->no_keluar + 1 : 1;

        $datakodesurat = KodeSuratModel::all();
        $kode_surat = KopSuratModel::latest('id_kop_surat')->first();

        return view('surat keluar/keluar_tambah', [
            'user' => $user,
            'kode_surat' => $kode_surat, 
            'datakodesurat' => $datakodesurat,
            'newNoKeluarValue' => $newNoKeluarValue
        ]);
    }


    public function keluarTambahPembuatan($fileName)
    {
        $user = Auth::user(); // Get the currently logged-in user
        $lastRecord = SuratKeluarModel::latest('no_keluar')->first();
        $newNoKeluarValue = ($lastRecord) ? $lastRecord->no_keluar + 1 : 1;

        $datakodesurat = KodeSuratModel::all();
        $kode_surat = KopSuratModel::latest('id_kop_surat')->first();

        return view('surat keluar/keluar_tambah_pembuatan', [
            'user' => $user,
            'kode_surat' => $kode_surat, 
            'datakodesurat' => $datakodesurat,
            'newNoKeluarValue' => $newNoKeluarValue,
            'fileName' => $fileName,
        ]);
    }


    public function keluarStore(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'no_keluar' => 'required',
            'tanggal_keluar' => 'required',
            'kode_keluar1' => 'required',
            'kode_keluar2' => 'required',
            'ditujukan' => 'required',
            'perihal_keluar' => 'required',
            'keterangan_keluar' => 'required',
            'surat_keluar' => '',
            'pembuatan_surat' => '',
        ]);


        if (!$request->hasFile('surat_keluar')) {
            // Assign the previous value to the "file" field
            $pdf = $request->input('pembuatan_surat');
        } else {
            // Handle the case when a new surat_keluar is uploaded
            $surat_keluar = $request->file('surat_keluar');
            $pdf = time() . "_" . $surat_keluar->getClientOriginalName();
            $tujuanupload = 'data_file';
            $surat_keluar->move($tujuanupload, $pdf);
        }

        // Combine Kode Keluar Inputs
        $kode_keluar1 = $request->input('kode_keluar1');
        $kode_keluar2 = $request->input('kode_keluar2');
        $kode_keluar = $kode_keluar1 . '/' . $kode_keluar2;

        // Get the authenticated user's ID
        $userId = Auth::id();


        $keluar = new SuratKeluarModel();
        $keluar->no_keluar = $validatedData['no_keluar'];
        $keluar->id = $userId; // Set the user ID
        $keluar->tanggal_keluar = $validatedData['tanggal_keluar'];
        $keluar->kode_keluar = $kode_keluar;
        $keluar->ditujukan = $validatedData['ditujukan'];
        $keluar->perihal_keluar = $validatedData['perihal_keluar'];
        $keluar->surat_keluar = $pdf;
        $keluar->keterangan_keluar = $validatedData['keterangan_keluar'];
        // Save the new record to the database
        $keluar->save();
        
        // Redirect to a success page or another appropriate action
        return redirect('/surat_keluar');
    }


    public function pembuatanSurat(Request $request)
    {
        // Validate the form data
        $request->validate([
            'konten' => 'required|string',
            'surat_keluar' => 'required|string',
        ]);

        // Get the content and create a PDF
        $content = $request->input('konten');
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($content);

        // Set the file name
        $fileName = $request->input('surat_keluar') . '_' . now()->format('YmdHis') . '.pdf';

        
        
        if ($request->has('pendataan')) {
            
            // Save the PDF file to the server
            $pdf->save(public_path('data_file/' . $fileName));

            return redirect('/surat_keluar/tambah/' . $fileName);

        } 
        elseif ($request->has('unduh')) {

            $pdf->save(public_path('data_file/' . $fileName));

            // Download the file
            $downloadPath = public_path('data_file/' . $fileName);
            return response()->download($downloadPath, $fileName)->deleteFileAfterSend(true);

        }
    }


    public function ijinStore(Request $request)
    {
        // Validate the form data
        $request->validate([
            'konten' => 'required|string',
            'surat_keluar' => 'required|string',
        ]);

        // Get the content and create a PDF
        $content = $request->input('konten');
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($content);

        // Set the file name
        $fileName = $request->input('surat_keluar') . '.pdf';

        // Save the PDF file to the server
        $pdf->save(public_path('data_file/' . $fileName));

        return redirect('/surat_keluar');
    }

    public function pengantarStore(Request $request)
    {
        // Validate the form data
        $request->validate([
            'konten' => 'required|string',
            'surat_keluar' => 'required|string',
        ]);

        // Get the content and create a PDF
        $content = $request->input('konten');
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($content);

        // Set the file name
        $fileName = $request->input('surat_keluar') . '.pdf';

        // Save the PDF file to the server
        $pdf->save(public_path('data_file/' . $fileName));

        return redirect('/surat_keluar');
    }

    public function perintahStore(Request $request)
    {
        // Validate the form data
        $request->validate([
            'konten' => 'required|string',
            'surat_keluar' => 'required|string',
        ]);

        // Get the content and create a PDF
        $content = $request->input('konten');
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($content);

        // Set the file name
        $fileName = $request->input('surat_keluar') . '.pdf';

        // Save the PDF file to the server
        $pdf->save(public_path('data_file/' . $fileName));

        return redirect('/surat_keluar');
    }

    public function pernyataanStore(Request $request)
    {
        // Validate the form data
        $request->validate([
            'konten' => 'required|string',
            'surat_keluar' => 'required|string',
        ]);

        // Get the content and create a PDF
        $content = $request->input('konten');
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($content);

        // Set the file name
        $fileName = $request->input('surat_keluar') . '.pdf';

        // Save the PDF file to the server
        $pdf->save(public_path('data_file/' . $fileName));

        return redirect('/surat_keluar');
    }

    

    public function keluarEdit($no_keluar)
    {
        $user = Auth::user(); // Get the currently logged-in user

        $keluar = DB::table('surat_keluar')->where('no_keluar', $no_keluar)->get();

        return view('surat keluar/keluar_edit', ['user' => $user, 'datakeluar' => $keluar]);
    }


    public function keluarUpdate(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'no_keluar' => 'required',
            'tanggal_keluar' => 'required|date',
            'kode_keluar' => 'required',
            'ditujukan' => 'required',
            'perihal_keluar' => 'required',
            'surat_keluar' => 'file',
            'keterangan_keluar' => '',
        ]);

        // Find the Arsip record by its ID
        $keluar = SuratKeluarModel::find($request->input('no_keluar'));

        // Retrieve the existing record from the database
        $record = DB::table('surat_keluar')->where('no_keluar', $request->no_keluar)->first();
        $pdf;
        // Check if the "file" input is empty
        if (!$request->hasFile('file')) {
            // Assign the previous value to the "file" field
            $pdf = $record->surat_keluar;
        } else {
            // Handle the case when a new file is uploaded
            $file = $request->file('file');
            $pdf = time() . "_" . $file->getClientOriginalName();
            $tujuanupload = 'data_file';
            $file->move($tujuanupload, $pdf);
        }

        // Get the authenticated user's ID
        $userId = Auth::id();

        // Update the record with the validated data
        $keluar->no_keluar = $validatedData['no_keluar'];
        $keluar->id = $userId; // Set the user ID
        $keluar->tanggal_keluar = $validatedData['tanggal_keluar'];
        $keluar->kode_keluar = $validatedData['kode_keluar'];
        $keluar->ditujukan = $validatedData['ditujukan'];
        $keluar->perihal_keluar = $validatedData['perihal_keluar'];
        $keluar->surat_keluar = $pdf;
        $keluar->keterangan_keluar = $validatedData['keterangan_keluar'];


        // Save the updated record to the database
        $keluar->save();

        // Redirect to a success page or another appropriate action
        return redirect('/surat_keluar')->with('success', 'Surat Keluar updated successfully.');
    }

    public function keluarArsip($no_keluar)
    {
        $user = Auth::user(); // Get the currently logged-in user

        $keluar = DB::table('surat_keluar')->where('no_keluar', $no_keluar)->get();

        return view('surat arsip/arsip_tambah_keluar', ['user' => $user, 'datakeluar' => $keluar]);
    }

    public function keluarHapus($no_keluar)
    {
        DB::table('surat_keluar')->where('no_keluar', $no_keluar)->delete();

        // alihkan halaman ke halaman arsip
        return redirect('/surat_keluar');
    }
}
