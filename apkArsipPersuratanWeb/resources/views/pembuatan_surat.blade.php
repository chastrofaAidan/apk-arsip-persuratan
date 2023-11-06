@extends('partials/sidebar')

@section('css')
<style>
    /* .custom-color{
        background-color: var(--bs-color1);
    } */
</style>
@endsection

@section('Judul')
<i class="ri-mail-add-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Pembuatan Surat
@endsection

@section('isi')
<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-award-fill" style="font-size: 20px;"></i>
    Template Surat
</h4>
<br>
<div class="row">
    <a href="/surat_perintah" class="btn col-md-6 text-center" target="_blank">
        <div class="btn format-surat col-md-12" style="background-color: var(--bs-color1); color: white;">Surat Perintah</div>
    </a><br>
    <a href="/surat_ijin" class="btn col-md-6 text-center" target="_blank">
        <div class="btn format-surat col-md-12" style="background-color: var(--bs-color1); color: white;">Surat Izin</div>
    </a><br>
</div>
<br>
<div class="row">
    <a href="/surat_pengantar" class="btn col-md-6 text-center" target="_blank">
        <div class="btn format-surat col-md-12" style="background-color: var(--bs-color1); color: white;">Surat Pengantar</div>
    </a><br>
    <a href="/surat_pernyataan" class="btn col-md-6 text-center" target="_blank">
        <div class="btn format-surat col-md-12" style="background-color: var(--bs-color1); color: white;">Surat Pernyataan</div>
    </a><br>
</div>
</div>
<br><br>


<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-mail-add-line sidebar-menu-item-icon"  style="font-size: 20px;"></i>
    Pembuatan Surat - Ewow
</h4>
</div>
<br><br>


<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-mail-send-line sidebar-menu-item-icon" style="font-size: 20px;"></i>
    Surat Keluar
</h4>
<div class="row">
    <a href="/surat_ijin" class="btn col-md-6 text-center" target="_blank">
        <div class="btn format-surat col-md-12" style="background-color: var(--bs-color1); color: white;"> Catat Surat Keluar & Unduh Sebagai PDF</div>
    </a><br>
    <a href="/surat_ijin" class="btn col-md-6 text-center" target="_blank">
        <div class="btn format-surat col-md-12" style="background-color: var(--bs-color1); color: white;">Preview Surat</div>
    </a><br>
    <!-- <a href="/surat_ijin" class="btn btn-primary" >Unduh Sebagai PDF</a> -->
</div>
</div>
<br><br>
@endsection