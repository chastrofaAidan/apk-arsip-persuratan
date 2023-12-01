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
<i class="ri-quill-pen-line" style="font-size: 40px;"></i>
    Pendataan Surat Keluar
@endsection

@section('isi')
<div class="px-3 py-2 bg-white rounded shadow">

<form action="/surat_keluar/store" method="post" enctype="multipart/form-data" style="padding: 20px 0px 20px 0px">
    {{ csrf_field() }}
    <div class="container">
    <div class="row">
            <div class="col-md-6">
                <label for="no_keluar">No</label>
                <input class="custom-input" type="text" name="no_keluar" id="no_keluar" value="{{ $newNoKeluarValue }}" readonly>

                <label for="tanggal_keluar">Tanggal</label>
                <input class="custom-input" type="date" name="tanggal_keluar" id="tanggal_keluar" required="required" value="{{ now()->toDateString() }}"><br>

                <label for="perihal_keluar">Perihal</label>
                <input class="custom-input" type="text" name="perihal_keluar" id="perihal_keluar" required="required"><br>      
            </div>
        
            <div class="col-md-6">
                <label for="kode_keluar1">Nomor Surat Keluar</label>
                <div class="row">
                    <div class="col-md-4">
                        <select class="custom-input form-select" name="kode_keluar1" id="kode_keluar1" required="required">
                            <option value="" disabled selected>Pilih Kode Surat</option>
                            @foreach($datakodesurat as $ks)
                            <option value="{{ $ks->kode_surat }}">{{ $ks->kode_surat }} / {{ $ks->keterangan_kode_surat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <b>/</b>
                    </div>
                    <div class="col-md-7">
                        <input class="custom-input" type="text" name="kode_keluar2" id="kode_keluar2" required="required" value="{{ $newNoKeluarValue }}/{{ $kode_surat->kode_surat }}">
                    </div>
                </div>

                <label for="ditujukan">Ditujukan Kepada</label>
                <input class="custom-input" type="text" name="ditujukan" id="ditujukan" required="required"><br>

                <label for="keterangan_keluar">Keterangan</label>
                <input class="custom-input" type="text" name="keterangan_keluar" id="keterangan_keluar"><br>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="surat_keluar">File</label>
                    <input class="custom-input" type="file" name="surat_keluar" id="surat_keluar" accept=".pdf" required="required"><br>
                </div>
            </div>
            <div class="col-md-6">
                    <input type="hidden" name="pembuatan_surat" id="pembuatan_surat">
                </div>
        </div>
        <br>
        <input class="btn btn-primary" type="submit" value="Simpan Data">
        <input class="btn btn-danger" type="button" value="Batal" id="btn-batal">
    </div>
</form>
</div>

<!-- Pastikan Anda sudah memasukkan Sweet Alert di sini -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    // Variable untuk menandai apakah formulir telah diisi
    var formIsFilled = false;

    // Fungsi untuk menghapus isi formulir
    function clearForm() {
        document.getElementById('tanggal_masuk').value = '';
        document.getElementById('kode_masuk').value = '';
        document.getElementById('pengirim').value = '';
        document.getElementById('identitas_masuk').value = '';
        document.getElementById('pokok_masuk').value = '';
        document.getElementById('keterangan_masuk').value = '';

        // Tandai bahwa formulir kosong
        formIsFilled = false;
    }

    // Fungsi untuk menandai bahwa formulir telah diisi
    function markFormIsFilled() {
        formIsFilled = true;
    }
    
    // Tambahkan event listener untuk tombol "Batal"
    document.getElementById('btn-batal').addEventListener('click', function () {
        // Tampilkan konfirmasi sebelum menghapus formulir
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Anda yakin ingin menghapus seluruh isian formulir?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus isian',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna memilih Ya, hapus isian formulir
                clearForm();
            }
        });
    });
</script>

@endsection



