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
<i class="ri-inbox-unarchive-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Pengarsipan Surat
@endsection

@section('isi')
<div class="px-3 py-2 bg-white rounded shadow">
    <h4 class="fw-bold">
        <i class="ri-inbox-unarchive-line sidebar-menu-item-icon" style="font-size: 20px;"></i>
        Pengarsipan Surat
    </h4>
    <hr>
<form action="/arsip/store" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <label for="kode_surat">Kode Surat</label>
                <input class="custom-input" type="text" name="kode_surat" id="kode_surat" required="required">
        
                <label for="perusahaan">Perusahaan</label>
                <input class="custom-input" type="text" name="perusahaan" id="perusahaan" required="required"><br>
        
                <label for="tanggal_surat">Tanggal Surat Berlaku</label>
                <input class="custom-input" type="date" name="tanggal_surat" id="tanggal_surat" required="required"><br>
            </div>
        
            <div class="col-md-6">
                <label for="judul_surat">Judul Surat</label>
                <input class="custom-input" type="text" name="judul_surat" id="judul_surat" required="required"><br>
        
                <label for="jenis_surat">Jenis Surat</label>
                <select class="custom-input" name="jenis_surat" id="jenis_surat" required="required">
                    <option value="" disabled selected>Select Jenis Surat</option>
                    <option value="Surat Masuk">Surat Masuk</option>
                    <option value="Surat Keluar">Surat Keluar</option>
                </select><br>
                <label for="perihal_surat">Perihal Surat</label>
            <input class="custom-input" type="text" name="perihal_surat" id="perihal_surat" required="required"><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="file">File</label>
                <!-- <i class="ri-inbox-unarchive-line sidebar-menu-item-icon"></i> -->
                <input class="custom-input" type="file" name="file" id="file" required="required"><br>
            </div>
            <div class="col-md-8">
                <label for="keterangan">Keterangan</label>
                <input class="custom-input" type="text" name="keterangan" id="keterangan" required="required" size="50"><br>
            </div>
        </div>
    </div>
    <br>
    <input class="btn btn-primary" type="submit" value="Simpan Data">
</form>
</div>
@endsection