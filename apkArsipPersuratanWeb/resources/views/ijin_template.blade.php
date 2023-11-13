@extends('pembuatan_surat')

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

@section('template')

<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-mail-add-line sidebar-menu-item-icon"  style="font-size: 20px;"></i>
    Pembuatan Surat - Izin
</h4>


<form action="/surat_keluar/store" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="container">
        <br>
        <h5 class="fw-bold">Data Surat Ijin</h5>
        <div class="row">
            <div class="col-md-6">
                <label for="no_keluar">No</label>
                <input class="custom-input" type="text" name="no_keluar" id="no_keluar" value="{{ $newNoKeluarValue }}" readonly>

                <label for="tanggal_surat">Tanggal</label>
                <input class="custom-input" type="date" name="tanggal_surat" id="tanggal_surat" required="required" value="{{ now()->toDateString() }}"><br>

                <label for="perihal_keluar">Perihal</label>
                <input class="custom-input" type="text" name="perihal_keluar" id="perihal_keluar" required="required" value="Surat Ijin"><br>      
            </div>
        
            <div class="col-md-6">
                <label for="kode_keluar">Nomor Surat Keluar</label>
                <input class="custom-input" type="text" name="kode_keluar" id="kode_keluar" required="required" value="Keperluan-Surat/{{ $newNoKeluarValue }}/{{ $kode_surat->kode_surat }}">

                <label for="ditujukan">Ditujukan Kepada</label>
                <input class="custom-input" type="text" name="ditujukan" id="ditujukan" required="required"><br>

                <label for="keterangan_keluar">Keterangan</label>
                <input class="custom-input" type="text" name="keterangan_keluar" id="keterangan_keluar" required="required"><br>
            </div>
        </div>

        <br><br><br>
        <h5 class="fw-bold">Konten Surat Ijin</h5>
        <div class="row">
        <div class="col-md-12">
            <label for="paragraf-1">Paragraf 1</label>
            <input class="custom-input" type="text" name="paragraf-1" id="paragraf-1" required="required"><br>
        </div>
        </div>

        <div class="row">
        <div class="col-md-12">
            <label for="paragraf-2">Paragraf 2</label>
            <input class="custom-input" type="text" name="paragraf-2" id="paragraf-2" required="required"><br>
        </div>
        </div>

        <div class="row">
        <div class="col-md-12">
            <label for="paragraf-3">Paragraf 3</label>
            <input class="custom-input" type="text" name="paragraf-3" id="paragraf-3" required="required"><br>
        </div>
        </div>
    </div>
    
</div>

<br><br>

<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-mail-send-line sidebar-menu-item-icon" style="font-size: 20px;"></i>
    Surat Keluar
</h4>

<div class="row">
    <input class="btn format-surat col-md-6" type="submit" value="Catat Surat Keluar & Unduh Sebagai PDF" style="background-color: var(--bs-color1); color: white;">
    <!-- <a href="/surat_ijin" class="btn col-md-6 text-center" target="_blank">
        <div class="btn format-surat col-md-12" style="background-color: var(--bs-color1); color: white;"> Catat Surat Keluar & Unduh Sebagai PDF</div>
    </a><br> -->
    <a href="/surat_ijin" class="btn col-md-6 text-center" id="preview-link" target="_blank">
    <div class="btn format-surat col-md-12" style="background-color: var(--bs-color1); color: white;">Preview Surat</div>
    </a><br>
</div>
</form>
@endsection

@section('js')
<script>
    // Get a reference to the anchor element
    var previewLink = document.getElementById("preview-link");

    // Add a click event listener to the link
    previewLink.addEventListener("click", function (e) {
        // Prevent the default action of the link
        e.preventDefault();

        // Access the values of the input fields
        var paragraf1Value = document.getElementById("paragraf-1").value;
        var paragraf2Value = document.getElementById("paragraf-2").value;
        var paragraf3Value = document.getElementById("paragraf-3").value;

        // Construct the URL with query parameters
        var url = "/surat_ijin?paragraf1=" + paragraf1Value + "&paragraf2=" + paragraf2Value + "&paragraf3=" + paragraf3Value;

        // Set the href of the link to the constructed URL
        previewLink.href = url;
    });
</script>
@endsection