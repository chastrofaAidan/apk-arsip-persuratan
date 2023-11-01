<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ArsipModel;
use App\Models\User;
use Barryvdh\DomPDF\PDF as PDF;

class ArsipController extends Controller
{
    function index()
    {
        $user = Auth::user(); // Get the currently logged-in user

        $surat_arsip = ArsipModel::all();
        $arsip = $surat_arsip->count();
        
        $surat_masuk = ArsipModel::where('jenis_surat', 'Surat Masuk');
        $masuk = $surat_masuk->count();
        
        $surat_keluar = ArsipModel::where('jenis_surat', 'Surat Keluar');
        $keluar = $surat_keluar->count();

        return view('dashboard', ['user' => $user, 'arsip' => $arsip, 'masuk' => $masuk, 'keluar' => $keluar]);
    }
    // public function superadmin()
    // {
    //     // Return view or perform actions for superadmin
    //     return view('superadmin_dashboard');
    // }

    // public function admin()
    // {
    //     // Return view or perform actions for admin
    //     return view('admin_dashboard');
    // }

    
    public function arsip(Request $request)
    {
        $user = Auth::user(); // Get the currently logged-in user

        $perPage = $request->input('per_page', 10); // Default to 10 records per page

        // Use paginate() to paginate the results based on the selected number of records per page
        $arsip = ArsipModel::paginate($perPage);

        return view('arsip_index', ['user' => $user, 'dataarsip' => $arsip, 'perPage' => $perPage]);
    }


    public function searchArsip(Request $request)
    {

        $user = Auth::user(); // Get the currently logged-in user

        if ($request->has('search')) {
            $search = $request->input('search'); // Get the search input from the request

            $arsip = ArsipModel::where(function ($query) use ($search) {
                $query->where('kode_surat', 'LIKE', '%' . $search . '%')
                    ->orWhere('judul_surat', 'LIKE', '%' . $search . '%')
                    ->orWhere('perusahaan', 'LIKE', '%' . $search . '%')
                    ->orWhere('tanggal_surat', '=', $search)
                    ->orWhere('perihal_surat', 'LIKE', '%' . $search . '%')
                    ->orWhere('keterangan', 'LIKE', '%' . $search . '%');
            })
                ->get();
        } else {
            $arsip = ArsipModel::all();
        }
        return view('arsip_index', ['user' => $user, 'dataarsip' => $arsip]);
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

        return view('arsip_tambah', ['user' => $user]);
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
        $user = Auth::user(); // Get the currently logged-in user

        $arsip = DB::table('arsip')->where('id_surat', $id_surat)->get();


        return view('arsip_edit', ['user' => $user, 'dataarsip' => $arsip]);
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
            $pdf = $record->file_surat;
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
        DB::table('arsip')->where('id_surat', $id_surat)->delete();

        // alihkan halaman ke halaman arsip
        return redirect('/arsip');
    }
  

    public function masuk(Request $request)
    {
        $user = Auth::user(); // Get the currently logged-in user

        $perPage = $request->input('per_page', 10); // Default to 10 records per page

        // Use paginate() to paginate the results based on the selected number of records per page
        $surat_masuk = ArsipModel::where('jenis_surat', 'Surat Masuk')
            ->paginate($perPage);

        return view('surat_masuk', ['user' => $user, 'dataarsip' => $surat_masuk, 'perPage' => $perPage]);
    }

    
    public function searchSuratMasuk(Request $request)
    {
        $user = Auth::user(); // Get the currently logged-in user

        if ($request->has('search')) {
            $search = $request->input('search'); // Get the search input from the request

            $surat_masuk = ArsipModel::where(function ($query) use ($search) {
                $query->where('kode_surat', 'LIKE', '%' . $search . '%')
                    ->orWhere('id_surat', 'LIKE', '%' . $search . '%')
                    ->orWhere('judul_surat', 'LIKE', '%' . $search . '%')
                    ->orWhere('perusahaan', 'LIKE', '%' . $search . '%')
                    ->orWhere('tanggal_surat', '=', $search)
                    ->orWhere('perihal_surat', 'LIKE', '%' . $search . '%')
                    ->orWhere('keterangan', 'LIKE', '%' . $search . '%');
            })
                ->where('jenis_surat', 'Surat Masuk')
                ->get();
        } else {
            $surat_masuk = ArsipModel::all();
        }
        return view('surat_masuk', ['user' => $user, 'dataarsip' => $surat_masuk]);
    }


    
    public function keluar(Request $request){
        $user = Auth::user(); // Get the currently logged-in user

        $perPage = $request->input('per_page', 10); // Default to 10 records per page

        // Use paginate() to paginate the results based on the selected number of records per page
        $surat_keluar = ArsipModel::where('jenis_surat', 'Surat Keluar')
            ->paginate($perPage);

        return view('surat_keluar', ['user' => $user, 'dataarsip' => $surat_keluar, 'perPage' => $perPage]);
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
        return view('surat_keluar', ['user' => $user, 'dataarsip' => $surat_keluar]);
    }

}
