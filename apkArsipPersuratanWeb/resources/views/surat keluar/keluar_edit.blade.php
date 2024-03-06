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
    Surat keluar - Edit
@endsection

@section('isi')
<div class="px-3 py-2 bg-white rounded shadow">
    <h4 class="fw-bold">
        <i class="ri-mail-send-line sidebar-menu-item-icon" style="font-size: 20px;"></i>
        Pendataan Surat Keluar
    </h4>
    <hr>
@foreach($datakeluar as $k)
<form action="/surat_keluar/update" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <label for="no_keluar">No</label>
                <input class="custom-input" type="text" name="no_keluar" id="no_keluar" required="required" value="{{ $k->no_keluar }}" readonly>

                <label for="tanggal_keluar">Tanggal</label>
                <input class="custom-input" type="date" name="tanggal_keluar" id="tanggal_keluar" required="required" value="{{ $k->tanggal_keluar }}"><br>
            </div>
        
            <div class="col-md-6">
            <label for="kode_keluar">Nomor Surat Keluar</label>
                <input class="custom-input" type="text" name="kode_keluar" id="kode_keluar" required="required" value="{{ $k->kode_keluar }}"><br>

                <label for="ditujukan">Ditujukan Kepada</label>
                <input class="custom-input" type="text" name="ditujukan" id="ditujukan" required="required" value="{{ $k->ditujukan }}"><br>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
            <label for="perihal_keluar">Perihal</label>
                <input class="custom-input" type="text" name="perihal_keluar" id="perihal_keluar" required="required" value="{{ $k->perihal_keluar }}"><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="file">File</label>
                <!-- <i class="ri-inbox-unarchive-line sidebar-menu-item-icon"></i> -->
                <input class="custom-input" type="file" name="file" id="file" accept=".pdf"><br>
                <label for="file">Previous File: {{ $k->surat_keluar }}</label><br>
            </div>
            <div class="col-md-8">
                <label for="keterangan_keluar">Keterangan</label>
                <input class="custom-input" type="text" name="keterangan_keluar" id="keterangan_keluar" value="{{ $k->keterangan_keluar }}"><br>
            </div>
        </div>
    </div>
    <br>
    <input class="btn" style="background-color: var(--bs-color1); color: white;" type="submit" value="Simpan Data">
</form>
@endforeach
</div>
@endsection