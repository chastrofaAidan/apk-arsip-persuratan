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
    Format Kode Surat - Tambah
@endsection

@section('isi')
<div class="px-3 py-2 bg-white rounded shadow">

<form action="/kode_pos/store" method="post" enctype="multipart/form-data" style="padding: 20px 0px 20px 0px;">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <label for="id_kode_pos">ID Kode Pos</label>
                <input class="custom-input" type="text" name="id_kode_pos" id="id_kode_pos" required="required" value="{{ $newNoMasukValue }}" readonly><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="kode_pos">Nomor Kode Pos</label>
                <input class="custom-input" type="text" name="kode_pos" id="kode_pos" required="required"><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="keterangan_kode_pos">Keterangan Kode Pos</label>
                <input class="custom-input" type="text" name="keterangan_kode_pos" id="keterangan_kode_pos" required="required"><br>
            </div>
        </div>
        <br>
        <input class="btn btn-primary" type="submit" value="Simpan Data">
        <input class="btn btn-danger" type="button" value="Batal" id="btn-batal">
    </div>
</form>
</div>
@endsection