@extends('partials/sidebar')

<style>
    
</style>

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
    <a href="/surat_dispen" class="col-md-6 text-center">
        <div class="btn format-surat btn-warning col-md-12">Surat Perintah</div>
    </a><br>
    <a href="/surat-dispen" class="col-md-6 text-center">
        <div class="btn format-surat btn-warning col-md-12">Surat Izin</div>
    </a><br>
</div>
<br>
<div class="row">
    <a href="/surat-dispen" class="col-md-6 text-center">
        <div class="btn format-surat btn-warning col-md-12">Surat Pengantar</div>
    </a><br>
    <a href="/surat-dispen" class="col-md-6 text-center">
        <div class="btn format-surat btn-warning col-md-12">Surat Keterangan</div>
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
    <a href="/surat_dispen" class="col-md-6 text-center">
        <div class="btn format-surat btn-warning col-md-12">Surat Dispensasi</div>
    </a><br>
    <a href="/surat-dispen" class="col-md-6 text-center">
        <div class="btn format-surat btn-warning col-md-12">Surat Tugas</div>
    </a><br>
    <a href="/surat_ijin" class="btn btn-primary" target="_blank">CETAK PDF</a>
</div>
</div>
<br><br>
@endsection