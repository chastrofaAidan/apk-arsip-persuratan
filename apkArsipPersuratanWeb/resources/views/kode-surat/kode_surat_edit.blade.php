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
<i class="ri-list-settings-line" style="font-size: 40px;"></i>
    Format Kode Surat - Edit
@endsection

@section('isi')
<div class="px-3 py-2 bg-white rounded shadow">

@foreach($datakodesurat as $kp)
<form action="/kode_surat/update" method="post" enctype="multipart/form-data" style="padding: 20px 0px 20px 0px;">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <label for="id_kode_surat">ID Kode Surat</label>
                <input class="custom-input" type="text" name="id_kode_surat" id="id_kode_surat" required="required" value="{{ $kp->id_kode_surat }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="kode_surat">Nomor Kode Surat</label>
                <input class="custom-input" type="text" name="kode_surat" id="kode_surat" required="required" value="{{ $kp->kode_surat }}"><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="keterangan_kode_surat">Keterangan Kode Surat</label>
                <input class="custom-input" type="text" name="keterangan_kode_surat" id="keterangan_kode_surat" required="required" value="{{ $kp->keterangan_kode_surat }}"><br>
            </div>
        </div>
        <br>
        <input class="btn" style="background-color: var(--bs-color1); color: white;" type="submit" value="Simpan Data">
        <a href="/settings">
            <input class="btn" style="background-color: var(--bs-color2); color: white;" type="button" value="Batal" id="btn-batal">
        </a>
    </div>
</form>
@endforeach
</div>
@endsection