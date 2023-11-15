


@extends('partials/sidebar')
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
@section('Judul')
<i class="ri-mail-send-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Surat Masuk - Edit
@endsection

@section('isi')
<div class="px-3 py-2 bg-white rounded shadow">
    <h4 class="fw-bold">
        <i class="ri-mail-send-line sidebar-menu-item-icon" style="font-size: 20px;"></i>
        Pendataan Surat Keluar
    </h4>
    <hr>
@foreach($datamasuk as $m)
<form action="/surat_masuk/update" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <label for="no_masuk">No</label>
                <input class="custom-input" type="text" name="no_masuk" id="no_masuk" required="required" value="{{ $m->no_masuk }}">

                <label for="tanggal_masuk">Tanggal</label>
                <input class="custom-input" type="date" name="tanggal_masuk" id="tanggal_masuk" required="required" value="{{ $m->tanggal_masuk }}"><br>
            </div>
        
            <div class="col-md-6">
            <label for="kode_masuk">Nomor Surat Keluar</label>
                <input class="custom-input" type="text" name="kode_masuk" id="kode_masuk" required="required" value="{{ $m->kode_masuk }}"><br>

                <label for="pengirim">Pengirim</label>
                <input class="custom-input" type="text" name="pengirim" id="pengirim" required="required" value="{{ $m->pengirim }}"><br>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="identitas_masuk">Nomor dan Tanggal Surat Masuk</label>
                <input class="custom-input" type="text" name="identitas_masuk" id="identitas_masuk" required="required" value="{{ $m->identitas_masuk }}"><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="pokok_masuk">Pokok Isi Surat Masuk</label>
                <input class="custom-input" type="text" name="pokok_masuk" id="pokok_masuk" required="required" value="{{ $m->pokok_masuk }}"><br>
            </div>
            <div class="col-md-6">
                <label for="keterangan_masuk">Keterangan</label>
                <input class="custom-input" type="text" name="keterangan_masuk" id="keterangan_masuk" value="{{ $m->keterangan_masuk }}"><br>
            </div>
        </div>
    </div>
    <br>
    <input class="btn btn-primary" type="submit" value="Simpan Data">
</form>
@endforeach
</div>
@endsection