<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class UserController extends Controller
{

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

        // Simpan perubahan
        $user->save();

        // Redirect atau kirim respons sesuai kebutuhan
        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }

    public function pegawai()
    {
        $Role = ['admin', 'user'];

        $totalPegawai = User::whereIn('role', $Role)->count(); // Menghitung total pegawai dengan peran admin atau user
        $user = User::whereIn('role', $Role)->get(); // Dapatkan data user dengan peran admin atau user

        return view('pegawai.pegawai', [
            'user' => $user,
            'totalPegawai' => $totalPegawai,
        ]);
    }

    public function checkDuplicateEmail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        return response()->json(['exists' => $user !== null]);
    }

    public function pegawaiTambah()
    {
        $user = Auth::user(); // Get the currently logged-in user

        return view('pegawai.pegawai_tambah', ['user' => $user]);
    }

    public function pegawaiStore(Request $request)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:admin,user',
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Simpan data ke database
        $pegawai = new User();
        $pegawai->name = $request->name;
        $pegawai->email = $request->email;
        $pegawai->Password = bcrypt($request->password);

        // Pastikan role yang diberikan hanya admin atau user
        $validRoles = ['admin', 'user'];
        $pegawai->role = in_array($request->role, $validRoles) ? $request->role : 'user';

        // Proses dan simpan gambar profil jika ada
        if ($request->hasFile('profile')) {
            // Tambahkan logika penyimpanan gambar sesuai kebutuhan
            $image = $request->file('profile');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('data_file'), $imageName);

            // Simpan nama gambar ke dalam kolom profile
            $pegawai->profile = $imageName;
        }

        $pegawai->save();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect('/pegawai')->with('success', 'Data berhasil ditambahkan!');
    }


    public function pegawaiHapus($id)
    {
        DB::table('users')->where('id', $id)->delete();

        // alihkan halaman ke halaman arsip
        return redirect('/pegawai');
    }

    public function pegawaiUpdate(Request $request, $id)
    {
        // Validasi data jika diperlukan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required',
            'role' => 'required|in:admin,user', // Pastikan role hanya admin atau user
            'profile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file gambar
        ]);

        // Perbarui data user berdasarkan ID atau data yang unik lainnya
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Pegawai tidak ditemukan');
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');

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

        // Simpan perubahan
        $user->save();

        // Redirect atau kirim respons sesuai kebutuhan
        return redirect('/pegawai');
    }

    public function pegawaiViewUpdate($id)
    {
        $user = User::find($id); // Ambil data pegawai berdasarkan ID

        return view('pegawai.pegawai_edit', ['user' => $user]);
    }
}
