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
<i class="ri-git-repository-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Pendataan Surat Masuk
@endsection

@section('isi')
<div class="px-3 py-2 bg-white rounded shadow">

<form action="/surat_masuk/store" method="post" enctype="multipart/form-data" style="padding: 20px 0px 20px 0px;">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <input class="custom-input" type="hidden" name="no_masuk" id="no_masuk" required="required" value="{{ $newNoMasukValue }}" readonly>

                <label for="tanggal_masuk">Tanggal</label>
                <input class="custom-input" type="date" name="tanggal_masuk" id="tanggal_masuk" required="required"  value="{{ now()->toDateString() }}"><br>

                <label for="identitas_masuk">Nomor dan Tanggal Surat Masuk</label>
                <input class="custom-input" type="text" name="identitas_masuk" id="identitas_masuk" required="required"  placeholder=" Nomor Surat - {{ \Carbon\Carbon::now()->format('j F Y') }}"><br>

                <label for="pokok_masuk">Pokok Isi Surat Masuk</label>
                <input class="custom-input" type="text" name="pokok_masuk" id="pokok_masuk"><br>
            </div>
        
            <div class="col-md-6">
            <label for="kode_masuk">Nomor Surat Masuk</label>
                <input class="custom-input" type="text" name="kode_masuk" id="kode_masuk" required="required"><br>

                <label for="pengirim">Pengirim</label>
                <input class="custom-input" type="text" name="pengirim" id="pengirim" required="required"><br>
                
                <label for="keterangan_masuk">Keterangan</label>
                <input class="custom-input" type="text" name="keterangan_masuk" id="keterangan_masuk"><br>
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



