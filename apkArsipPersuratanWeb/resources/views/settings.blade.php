@extends('partials/sidebar')

@section('css')
<style>
    .custom-input {
        width: 100%; /* Make the input element span the full width of its parent */
        background-color: #dedede; /* Set the background color to gray */
        border: none; /* Remove the default input border */
        padding: 10px; /* Add padding to style the input */
        color: black; /* Set text color to contrast with the gray background */
        border-radius: 1vh;
    }
</style>
@endsection

@section('Judul')
<i class="ri-settings-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Settings
@endsection

@section('isi')
<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-award-fill" style="font-size: 20px;"></i>
    Format Kop Surat 
</h4>
<form action="/kop_surat/store" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <label for="kode_surat">Kode Wilayah SMK 1 Cimahi</label>
                <input class="custom-input" type="text" name="kode_surat" id="kode_surat" required="required" value="{{ $kop_surat->kode_surat }}">

                <label for="nama_instansi">Nama Instansi</label>
                <input class="custom-input" type="text" name="nama_instansi" id="nama_instansi" required="required" value="{{ $kop_surat->nama_instansi }}"><br>

                <label for="website_instansi">Website Instansi</label>
                <input class="custom-input" type="text" name="website_instansi" id="website_instansi" required="required" value="{{ $kop_surat->website_instansi }}"><br>

                <label for="kode_pos">Kode Pos</label>
                <input class="custom-input" type="text" name="kode_pos" id="kode_pos" required="required" value="{{ $kop_surat->kode_pos }}"><br>
            </div>
        
            <div class="col-md-6">
                <label for="alamat_instansi">Alamat Instansi</label>
                <input class="custom-input" type="text" name="alamat_instansi" id="alamat_instansi" required="required" value="{{ $kop_surat->alamat_instansi }}"><br>

                <label for="kontak_instansi">Kontak Instansi</label>
                <input class="custom-input" type="text" name="kontak_instansi" id="kontak_instansi" required="required" value="{{ $kop_surat->kontak_instansi }}"><br>

                <label for="email_instansi">Email Instansi</label>
                <input class="custom-input" type="text" name="email_instansi" id="email_instansi" required="required" value="{{ $kop_surat->email_instansi }}"><br>

                <label for="lingkup_wilayah">Lingkup Wilayah</label>
                <input class="custom-input" type="text" name="lingkup_wilayah" id="lingkup_wilayah" required="required" value="{{ $kop_surat->lingkup_wilayah }}"><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <label for="logo_instansi">Photo Instansi</label>
                <input class="custom-input" type="file" name="logo_instansi" id="logo_instansi" accept=".png, .jpeg, .jpg" required="required"><br>
                <label for="logo_instansi">Previous File: {{ $kop_surat->logo_instansi }}</label><br>
            </div>
            <!-- <div class="col-md-4">
                <img class="img-preview img-fluid" alt="Profile" width="100">
            </div> -->
        </div>
    </div>
    <br>
    <input class="btn btn-primary" type="submit" value="Simpan Data">
</form>
</div>
<br><br>

<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-account-circle-line sidebar-menu-item-icon" style="font-size: 20px;"></i>
    Biodata Kepala Sekolah
</h4>
<form action="/kepala_sekolah/store" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <label for="nama_kepala_sekolah">Nama Kepala Sekolah</label>
                <input class="custom-input" type="text" name="nama_kepala_sekolah" id="nama_kepala_sekolah" required="required" value="{{ $kepala_sekolah->nama_kepala_sekolah }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="golongan_kepala_sekolah">Golongan Kepala Sekolah</label>
                <input class="custom-input" type="text" name="golongan_kepala_sekolah" id="golongan_kepala_sekolah" required="required" value="{{ $kepala_sekolah->golongan_kepala_sekolah }}"><br>
            </div>
            <div class="col-md-6">
                <label for="nip_kepala_sekolah">NIP Kepala Sekolah</label>
                <input class="custom-input" type="text" name="nip_kepala_sekolah" id="nip_kepala_sekolah" required="required" value="{{ $kepala_sekolah->nip_kepala_sekolah }}"><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <label for="tanda_tangan">Photo Instansi</label>
                <input class="custom-input" type="file" name="tanda_tangan" id="tanda_tangan" accept=".png, .jpeg, .jpg" required="required"><br>
                <label for="tanda_tangan">Previous File: {{ $kepala_sekolah->tanda_tangan }}</label><br>
            </div>
            <!-- <div class="col-md-4">
                <img class="img-preview img-fluid" alt="Profile" width="100">
            </div> -->
        </div>
    </div>
    <br>
    <input class="btn btn-primary" type="submit" value="Simpan Data">
</form>
</div>
<br><br>

<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-list-settings-line" style="font-size: 20px;"></i>
    Format Kode Surat
</h4>
<table class="table table-bordered table-striped" border="1">
<tr>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">No</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Kode Pos</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Keterangan</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Action</th>
    </tr>

    @foreach($kode_pos as $kp)
    <tr>
        <td>{{ $kp->id_kode_pos }}</td>
        <td>{{ $kp->kode_pos }}</td>
        <td>{{ $kp->keterangan_kode_pos }}</td>
        <td>
            <a href="/setting/kode_pos/edit/{{ $kp->id_surat }}" class="btn col-12 text-center" style="background-color: var(--bs-color2); color: white;">
            <i class="ri-edit-box-line"></i>
            </a><br><br>
            <a href="/setting/kode_pos/hapus/{{ $kp->id_surat }}" class="btn col-12 text-center" style="background-color: var(--bs-color1); color: white;">
                <i class="ri-delete-bin-line"></i>            
            </a><br>
        </td>
    </tr>
    @endforeach
</table>
</div>
<br><br>

@endsection