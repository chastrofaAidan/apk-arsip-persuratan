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

.custom-input1 {
    width: 100%; /* Make the input element span the full width of its parent */
    background-color: #dedede; /* Set the background color to gray */
    border: none; /* Remove the default input border */
    padding: 12.5px; /* Add padding to style the input */
    color: black; /* Set text color to contrast with the gray background */
    border-radius: 1vh;
}
</style>
@endsection

@section('Judul')
<i class="ri-inbox-unarchive-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Pengarsipan Surat
@endsection

@section('isi')
<div class="px-3 py-2 bg-white rounded shadow">
@foreach($datamasuk as $m)
<form action="/arsip/store" method="post" enctype="multipart/form-data" style="padding: 20px 0px 20px 0px;">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <label for="kode_surat">Kode Surat</label>
                <input class="custom-input" type="text" name="kode_surat" id="kode_surat" required="required" oninput="markFormIsFilled()" value="{{ $m->kode_masuk }}">
        
                <label for="perusahaan">Perusahaan</label>
                <input class="custom-input" type="text" name="perusahaan" id="perusahaan" required="required" value="{{ $m->pengirim }}"><br>
        
                <label for="tanggal_surat">Tanggal Surat Berlaku</label>
                <input class="custom-input" type="date" name="tanggal_surat" id="tanggal_surat" required="required" value="{{ $m->tanggal_masuk }}"><br>
            </div>
        
            <div class="col-md-6">
                <label for="judul_surat">Judul Surat</label>
                <input class="custom-input" type="text" name="judul_surat" id="judul_surat" required="required" value="{{ $m->pokok_masuk }}"><br>
        
                <label for="jenis_surat">Jenis Surat</label>
                <select class="custom-input form-select" name="jenis_surat" id="jenis_surat" required="required">
                    <option value="" disabled>Pilih Jenis Surat</option>
                    <option value="Surat Masuk" selected>Surat Masuk</option>
                    <option value="Surat Keluar">Surat Keluar</option>
                </select>
                <label for="perihal_surat">Perihal Surat</label>
                <input class="custom-input" type="text" name="perihal_surat" id="perihal_surat" required="required" value="{{ $m->identitas_masuk }}"><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="file">File</label>
                <!-- <i class="ri-inbox-unarchive-line sidebar-menu-item-icon"></i> -->
                <input class="custom-input" type="file" name="file" id="file" required="required" accept=".pdf"><br>
            </div>
            <div class="col-md-8">
                <label for="keterangan">Keterangan</label>
                <input class="custom-input1" type="text" name="keterangan" id="keterangan"size="50" value="{{ $m->keterangan_masuk }}"><br>
            </div>
        </div>
        <br>
        <input class="btn btn-primary" type="submit" value="Simpan Data">
        <input class="btn btn-danger" type="button" value="Batal" id="btn-batal">
    </div>

</form>
@endforeach
</div>

<!-- Pastikan Anda sudah memasukkan Sweet Alert di sini -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    // Variable untuk menandai apakah formulir telah diisi
    var formIsFilled = false;

    // Fungsi untuk menghapus isi formulir
    function clearForm() {
        document.getElementById('kode_surat').value = '';
        document.getElementById('perusahaan').value = '';
        document.getElementById('tanggal_surat').value = '';
        document.getElementById('judul_surat').value = '';
        document.getElementById('jenis_surat').value = '';
        document.getElementById('perihal_surat').value = '';
        document.getElementById('file').value = '';
        document.getElementById('keterangan').value = '';

        // Tandai bahwa formulir kosong
        formIsFilled = false;
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

