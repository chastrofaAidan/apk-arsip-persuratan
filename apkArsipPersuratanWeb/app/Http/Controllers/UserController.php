<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
