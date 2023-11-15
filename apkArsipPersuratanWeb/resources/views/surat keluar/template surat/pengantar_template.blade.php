@extends('partials/pembuatan_surat')

@section('template')

<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-mail-add-line sidebar-menu-item-icon"  style="font-size: 20px;"></i>
    Pembuatan Surat - Pengantar
</h4>
</div>

<br><br>
<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-mail-send-line sidebar-menu-item-icon" style="font-size: 20px;"></i>
    Surat Keluar
</h4>

<div class="row">
    <a href="/surat_pengantar" class="btn col-md-6 text-center" target="_blank">
        <div class="btn format-surat col-md-12" style="background-color: var(--bs-color1); color: white;"> Catat Surat Keluar & Unduh Sebagai PDF</div>
    </a><br>
    <a href="/surat_pengantar" class="btn col-md-6 text-center" target="_blank">
        <div class="btn format-surat col-md-12" style="background-color: var(--bs-color1); color: white;">Preview Surat</div>
    </a><br>
    <!-- <a href="/surat_pengantar" class="btn btn-primary" >Unduh Sebagai PDF</a> -->
</div>
@endsection