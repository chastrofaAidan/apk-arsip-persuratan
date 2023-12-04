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

    .custom-button {
        background-color: #9A4444;
        color: #fff;
        /* Text color */
        padding: 8px 20px;
        /* Adjust padding as needed */
        border-radius: 10px;
        /* Rounded corners */
        border: 2px solid white;
    }
</style>
@endsection

@section('Judul')
<i class="ri-settings-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Settings
@endsection

@section('isi')

@if (Auth::user()->role == 'superadmin')
<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-award-fill" style="font-size: 20px;"></i>
    Format Kop Surat 
</h4>
<br>
@if (isset($kop_surat->updated_at))
    <h6><b>Updated At: {{ $kop_surat->updated_at->timezone('Asia/Jakarta')->format('d F Y') }}</b></h6>
@endif
<form action="/kop_surat/update" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <input class="custom-input" type="hidden" name="id_kop_surat" id="id_kop_surat" required="required" value="{{ $kop_surat->id_kop_surat }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="kode_surat">Kode Wilayah SMK 1 Cimahi</label>
                <input class="custom-input" type="text" name="kode_surat" id="kode_surat" required="required" value="{{ $kop_surat->kode_surat }}">

                <label for="nama_instansi">Nama Instansi</label>
                <input class="custom-input" type="text" name="nama_instansi" id="nama_instansi" required="required" value="{{ $kop_surat->nama_instansi }}"><br>

                <label for="website_instansi">Website Instansi</label>
                <input class="custom-input" type="text" name="website_instansi" id="website_instansi" required="required" value="{{ $kop_surat->website_instansi }}"><br>

                <label for="kode_surat">Kode Pos</label>
                <input class="custom-input" type="text" name="kode_surat" id="kode_surat" required="required" value="{{ $kop_surat->kode_surat }}"><br>
            </div>
        
            <div class="col-md-6">
                <label for="alamat_instansi">Alamat Instansi</label>
                <input class="custom-input" type="text" name="alamat_instansi" id="alamat_instansi" required="required" value="{{ $kop_surat->alamat_instansi }}"><br>

                <label for="kontak_instansi">Kontak Instansi</label>
                <input class="custom-input" type="text" name="kontak_instansi" id="kontak_instansi" required="required" value="{{ $kop_surat->kontak_instansi }}"><br>

                <label for="email_instansi">Email Instansi</label>
                <input class="custom-input" type="text" name="email_instansi" id="email_instansi" required="required" value="{{ $kop_surat->email_instansi }}"><br>

                <label for="lingkup_wilayah">Lingkup Wilayah</label>
                <input class="custom-input" type="text" name="lingkup_wilayah" id="lingkup_wilayah" required="required" value="{{ $kop_surat->lingkup_wilayah }}"><br>
            </div>
        </div>
        <div class="row">
            <div>
                <label for="logo_instansi">Foto Instansi (Ukuran File: 90*105)</label>
            </div>

            <div class="col-md-8" style="position: relative;">
                <input class="custom-input" type="file" name="logo_instansi" id="file" accept=".png, .jpeg, .jpg" onchange="loadFile1(event)">
                <br>
            </div>

            <div class="col-md-4 text-center">
                @if ($kop_surat->logo_instansi)
                    <!-- Tampilkan gambar profil sebelumnya jika ada -->
                    <img id="output1" src="data_file/{{ $kop_surat->logo_instansi }}" class="img-thumbnail"
                        alt="Logo Image" style="width: 200px; height: 200px; object-fit: cover;"
                        crossorigin="anonymous">
                    <label id="previousFileLabel" for="logo_instansi">Previous File: {{ $kop_surat->logo_instansi }}</label>
                @else
                    <!-- Tampilkan gambar default jika tidak ada gambar profil sebelumnya -->
                    <img src="https://picsum.photos/200/" class="img-thumbnail" alt="Logo Image" style="width: 200px; height: 200px; object-fit: cover;" crossorigin="anonymous">
                    <label for="logo_instansi">Previous File: {{ $kop_surat->logo_instansi }}</label><br>
                @endif
            </div>
        </div>
    </div>
    <br>
    <input class="btn btn-primary" type="submit" value="Simpan Data" id="btn-simpan">
    <input class="btn btn-danger" type="button" value="Batal" id="btn-batal" onclick="confirmAndClearForm()">
</form>
</div>
<br><br>

<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-account-circle-line sidebar-menu-item-icon" style="font-size: 20px;"></i>
    Biodata Kepala Sekolah
</h4>
<br>
@if (isset($kepala_sekolah->updated_at))
    <h6><b>Updated At: {{ $kepala_sekolah->updated_at->timezone('Asia/Jakarta')->format('d F Y') }}</b></h6>
@endif
<form action="/kepala_sekolah/update" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <input class="custom-input" type="hidden" name="id_kepala_sekolah" id="id_kepala_sekolah" required="required" value="{{ $kepala_sekolah->id_kepala_sekolah }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="nama_kepala_sekolah">Nama Kepala Sekolah</label>
                <input class="custom-input" type="text" name="nama_kepala_sekolah" id="nama_kepala_sekolah" required="required" value="{{ $kepala_sekolah->nama_kepala_sekolah }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="golongan_kepala_sekolah">Golongan Kepala Sekolah</label>
                <input class="custom-input" type="text" name="golongan_kepala_sekolah" id="golongan_kepala_sekolah" required="required" value="{{ $kepala_sekolah->golongan_kepala_sekolah }}"><br>
            </div>
            <div class="col-md-6">
                <label for="nip_kepala_sekolah">NIP Kepala Sekolah</label>
                <input class="custom-input" type="text" name="nip_kepala_sekolah" id="nip_kepala_sekolah" required="required" value="{{ $kepala_sekolah->nip_kepala_sekolah }}"><br>
            </div>
        </div>
        <div class="row">
            <div>
                <label for="tanda_tangan">Tanda Tangan Kepala Sekolah (Ukuran File: 150*115)</label>
            </div>

            <div class="col-md-8" style="position: relative;">
                <input class="custom-input" type="file" name="tanda_tangan" id="file" accept=".png, .jpeg, .jpg"
                    onchange="loadFile2(event)">
                <br>
            </div>

            <div class="col-md-4 text-center">
                @if ($kepala_sekolah->tanda_tangan)
                    <!-- Tampilkan gambar profil sebelumnya jika ada -->
                    <img id="output2" src="data_file/{{ $kepala_sekolah->tanda_tangan }}" class="img-thumbnail"
                        alt="Signature Image" style="width: 200px; height: 200px; object-fit: cover;"
                        crossorigin="anonymous">
                    <label id="previousFileLabel" for="tanda_tangan">Previous File: {{ $kepala_sekolah->tanda_tangan }}</label>
                @else
                    <!-- Tampilkan gambar default jika tidak ada gambar profil sebelumnya -->
                    <img src="https://picsum.photos/200/" class="img-thumbnail" alt="Signature Image"
                        style="width: 200px; height: 200px; object-fit: cover;" crossorigin="anonymous">
                    <label for="tanda_tangan">Previous File: {{ $kepala_sekolah->tanda_tangan }}</label><br>
                @endif
            </div>
        </div>
    </div>
    <br>
    <input class="btn btn-primary" type="submit" value="Simpan Data" id="btn-simpan">
    <input class="btn btn-danger" type="button" value="Batal" id="btn-batal" onclick="confirmAndClearForm()">
</form>
</div>
<br><br>





@elseif (Auth::user()->role == 'admin')
<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-award-fill" style="font-size: 20px;"></i>
    Format Kop Surat 
</h4>
<br>
@if (isset($kop_surat->updated_at))
    <h6><b>Updated At: {{ $kop_surat->updated_at->timezone('Asia/Jakarta')->format('d F Y') }}</b></h6>
@endif
<form action="/kop_surat/update" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <input class="custom-input" type="hidden" name="id_kop_surat" id="id_kop_surat" required="required" value="{{ $kop_surat->id_kop_surat }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="kode_surat">Kode Wilayah SMK 1 Cimahi</label>
                <input class="custom-input" type="text" name="kode_surat" id="kode_surat" required="required" value="{{ $kop_surat->kode_surat }}" readonly>

                <label for="nama_instansi">Nama Instansi</label>
                <input class="custom-input" type="text" name="nama_instansi" id="nama_instansi" required="required" value="{{ $kop_surat->nama_instansi }}" readonly><br>

                <label for="website_instansi">Website Instansi</label>
                <input class="custom-input" type="text" name="website_instansi" id="website_instansi" required="required" value="{{ $kop_surat->website_instansi }}" readonly><br>

                <label for="kode_surat">Kode Pos</label>
                <input class="custom-input" type="text" name="kode_surat" id="kode_surat" required="required" value="{{ $kop_surat->kode_surat }}" readonly><br>
            </div>
        
            <div class="col-md-6">
                <label for="alamat_instansi">Alamat Instansi</label>
                <input class="custom-input" type="text" name="alamat_instansi" id="alamat_instansi" required="required" value="{{ $kop_surat->alamat_instansi }}" readonly><br>

                <label for="kontak_instansi">Kontak Instansi</label>
                <input class="custom-input" type="text" name="kontak_instansi" id="kontak_instansi" required="required" value="{{ $kop_surat->kontak_instansi }}" readonly><br>

                <label for="email_instansi">Email Instansi</label>
                <input class="custom-input" type="text" name="email_instansi" id="email_instansi" required="required" value="{{ $kop_surat->email_instansi }}" readonly><br>

                <label for="lingkup_wilayah">Lingkup Wilayah</label>
                <input class="custom-input" type="text" name="lingkup_wilayah" id="lingkup_wilayah" required="required" value="{{ $kop_surat->lingkup_wilayah }}" readonly><br>
            </div>
        </div>
        <div class="row">
            <div>
                <label for="logo_instansi">Foto Instansi (Ukuran File: 90*105)</label>
            </div>

            <div class="col-md-8" style="position: relative;">
                <input class="custom-input" type="file" name="logo_instansi" id="file" accept=".png, .jpeg, .jpg" onchange="loadFile1(event)" readonly>
                <br>
            </div>

            <div class="col-md-4 text-center">
                @if ($kop_surat->logo_instansi)
                    <!-- Tampilkan gambar profil sebelumnya jika ada -->
                    <img id="output1" src="data_file/{{ $kop_surat->logo_instansi }}" class="img-thumbnail"
                        alt="Logo Image" style="width: 200px; height: 200px; object-fit: cover;"
                        crossorigin="anonymous">
                    <label id="previousFileLabel" for="logo_instansi">Previous File: {{ $kop_surat->logo_instansi }}</label>
                @else
                    <!-- Tampilkan gambar default jika tidak ada gambar profil sebelumnya -->
                    <img src="https://picsum.photos/200/" class="img-thumbnail" alt="Logo Image" style="width: 200px; height: 200px; object-fit: cover;" crossorigin="anonymous">
                    <label for="logo_instansi">Previous File: {{ $kop_surat->logo_instansi }}</label><br>
                @endif
            </div>
        </div>
    </div>
</form>
</div>
<br><br>

<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-account-circle-line sidebar-menu-item-icon" style="font-size: 20px;"></i>
    Biodata Kepala Sekolah
</h4>
<br>
@if (isset($kepala_sekolah->updated_at))
    <h6><b>Updated At: {{ $kepala_sekolah->updated_at->timezone('Asia/Jakarta')->format('d F Y') }}</b></h6>
@endif
<form action="/kepala_sekolah/update" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <input class="custom-input" type="hidden" name="id_kepala_sekolah" id="id_kepala_sekolah" required="required" value="{{ $kepala_sekolah->id_kepala_sekolah }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="nama_kepala_sekolah">Nama Kepala Sekolah</label>
                <input class="custom-input" type="text" name="nama_kepala_sekolah" id="nama_kepala_sekolah" required="required" value="{{ $kepala_sekolah->nama_kepala_sekolah }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="golongan_kepala_sekolah">Golongan Kepala Sekolah</label>
                <input class="custom-input" type="text" name="golongan_kepala_sekolah" id="golongan_kepala_sekolah" required="required" value="{{ $kepala_sekolah->golongan_kepala_sekolah }}" readonly><br>
            </div>
            <div class="col-md-6">
                <label for="nip_kepala_sekolah">NIP Kepala Sekolah</label>
                <input class="custom-input" type="text" name="nip_kepala_sekolah" id="nip_kepala_sekolah" required="required" value="{{ $kepala_sekolah->nip_kepala_sekolah }}" readonly><br>
            </div>
        </div>
        <div class="row">
            <div>
                <label for="tanda_tangan">Tanda Tangan Kepala Sekolah (Ukuran File: 150*115)</label>
            </div>

            <div class="col-md-8" style="position: relative;">
                <input class="custom-input" type="file" name="tanda_tangan" id="file" accept=".png, .jpeg, .jpg"
                    onchange="loadFile2(event)">
                <br>
            </div>

            <div class="col-md-4 text-center">
                @if ($kepala_sekolah->tanda_tangan)
                    <!-- Tampilkan gambar profil sebelumnya jika ada -->
                    <img id="output2" src="data_file/{{ $kepala_sekolah->tanda_tangan }}" class="img-thumbnail"
                        alt="Signature Image" style="width: 200px; height: 200px; object-fit: cover;"
                        crossorigin="anonymous">
                    <label id="previousFileLabel" for="tanda_tangan">Previous File: {{ $kepala_sekolah->tanda_tangan }}</label>
                @else
                    <!-- Tampilkan gambar default jika tidak ada gambar profil sebelumnya -->
                    <img src="https://picsum.photos/200/" class="img-thumbnail" alt="Signature Image"
                        style="width: 200px; height: 200px; object-fit: cover;" crossorigin="anonymous">
                    <label for="tanda_tangan">Previous File: {{ $kepala_sekolah->tanda_tangan }}</label><br>
                @endif
            </div>
        </div>
    </div>
</form>
</div>
<br><br>
@endif




<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-list-settings-line" style="font-size: 20px;"></i>
    Format Kode Surat
</h4>
<a href="/kode_surat/tambah">
    <button class="custom-button" style="margin-right: 5px;">
        <i class="ri-list-settings-line"></i>
        <span>Tambah Kode Surat</span>
    </button>
</a>
<table class="table table-bordered table-striped" border="1">
<tr>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">No</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Kode Surat</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Keterangan</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Tanggal Diperbaharui</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Action</th>
    </tr>

    @foreach($kode_surat as $kp)
    <tr>
        <td>{{ $kp->id_kode_surat }}</td>
        <td>{{ $kp->kode_surat }}</td>
        <td>{{ $kp->keterangan_kode_surat }}</td>
        <td>
            @if ($kp->updated_at)
                {{ $kp->updated_at->timezone('Asia/Jakarta')->format('d F Y') }}
            @else
                N/A
            @endif
        </td>



        <td>
            <a href="/kode_surat/edit/{{ $kp->id_kode_surat }}" class="btn col-12 text-center" style="background-color: var(--bs-color2); color: white;">
            <i class="ri-edit-box-line"></i>
            </a><br><br>
            <a href="/kode_surat/hapus/{{ $kp->id_kode_surat }}" class="btn col-12 text-center" style="background-color: var(--bs-color1); color: white;">
                <i class="ri-delete-bin-line"></i>            
            </a><br>
        </td>
    </tr>
    @endforeach
</table>
</div>
<br><br>

@endsection

@section('js')
<script>
function restorePreviousFile() {
    var output = document.getElementById('output');
    var previousFileLabel = document.getElementById('previousFileLabel');

    // Periksa apakah ada file sebelumnya
    @if ($user->profile)
        // Tampilkan gambar profil sebelumnya
        output.src = "data_file/{!! $user->profile !!}";
        previousFileLabel.innerText = 'Previous File: {!! $user->profile !!}';
    @else
        // Tampilkan gambar default jika tidak ada file sebelumnya
        output.src = "https://picsum.photos/200/";
        previousFileLabel.innerText = 'Previous File: {!! $user->profile !!}';
    @endif
}

var previousFile; // Variabel untuk menyimpan nama file sebelumnya

var loadFile1 = function(event) {
    var output = document.getElementById('output1');
    output.src = URL.createObjectURL(event.target.files[0]);

    // Update teks label "Previous File" sesuai dengan nama file yang baru dipilih
    var fileName = event.target.files[0].name;
    var previousFileLabel = document.getElementById('previousFileLabel');

    // Ganti label menjadi "File"
    previousFileLabel.innerText = 'File: ' + fileName;

    // Simpan nama file sebelumnya
    previousFile = fileName;
};

var loadFile2 = function(event) {
    var output = document.getElementById('output2');
    output.src = URL.createObjectURL(event.target.files[0]);

    // Update teks label "Previous File" sesuai dengan nama file yang baru dipilih
    var fileName = event.target.files[0].name;
    var previousFileLabel = document.getElementById('previousFileLabel');

    // Ganti label menjadi "File"
    previousFileLabel.innerText = 'File: ' + fileName;

    // Simpan nama file sebelumnya
    previousFile = fileName;
};

function togglePasswordVisibility() {
    var passwordInput = document.getElementById('password');
    var verifyPasswordInput = document.getElementById('verify_password');

    // Periksa apakah checkbox dicentang
    var showPasswordCheckbox = document.getElementById('showPassword');
    var showPassword = showPasswordCheckbox.checked;

    // Set tipe input berdasarkan checkbox
    passwordInput.type = showPassword ? 'text' : 'password';
    verifyPasswordInput.type = showPassword ? 'text' : 'password';
}

// Variable untuk menandai apakah formulir telah diisi
var formIsFilled = false;

// Fungsi untuk menghapus isi formulir
function clearForm() {
    document.getElementById('file').value = '';
    document.getElementById('password').value = '';

    // Tandai bahwa formulir kosong
    formIsFilled = false;

    // Ambil gambar sebelumnya dari database
    restorePreviousFile();

    // Isi kembali formulir dengan data dari database
    document.getElementById('name').value = "{{ $user->name }}";
    document.getElementById('email').value = "{{ $user->email }}";
    // Jika perlu, Anda bisa menambahkan logika lainnya untuk mengisi formulir sesuai kebutuhan

    // Kembalikan gambar ke gambar sebelumnya dari database
    var output = document.getElementById('output');
    output.src = "data_file/{!! $user->profile !!}";
}

// Fungsi untuk menandai bahwa formulir telah diisi
function markFormIsFilled() {
    formIsFilled = true;
}

// Tambahkan event listener untuk tombol "Batal"
document.getElementById('btn-batal').addEventListener('click', function() {
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
            restorePreviousFile();
        }
    });
});
</script>
@endsection