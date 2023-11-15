@extends('partials/sidebar')

@section('css')
<style>
    .custom-input {
        width: 100%;
        /* Make the input element span the full width of its parent */
        background-color: #dedede;
        /* Set the background color to gray */
        border: none;
        /* Remove the default input border */
        padding: 10px;
        /* Add padding to style the input */
        color: black;
        /* Set text color to contrast with the gray background */
        border-radius: 1vh;
    }

    .custom-input2 {
        width: 100%;
        /* Make the input element span the full width of its parent */
        background-color: #dedede;
        /* Set the background color to gray */
        border: none;
        /* Remove the default input border */
        padding: 10px;
        /* Add padding to style the input */
        color: black;
        /* Set text color to contrast with the gray background */
        border-radius: 1vh;
    }
</style>
@endsection

@section('Judul')
    <i class="ri-account-circle-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Profile
@endsection

@section('isi')
    <div class="px-3 py-2 bg-white rounded shadow">

        <form action="/user/update" method="post" enctype="multipart/form-data" style="padding: 20px 0px 20px 0px;" id="form-update">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Nama User</label>
                        <input class="custom-input" type="text" name="name" id="name" required="required"
                            size="50" value="{{ $user->name }}"><br>
                    </div>
                    <div class="col-md-6">
                        <label for="email">User Email</label>
                        <input class="custom-input" type="text" name="email" id="email" required="required"
                            value="{{ $user->email }}">
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-12">
                        <label for="password">Password</label>
                        <input class="custom-input" type="password" name="password" id="password" required="required"
                            oninput="checkPassword()">
                        <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()"> Tampilkan Password
                    </div>
                </div>
                <br>

                <div class="row">
                    <div>
                        <label for="profile">Photo Profile</label>
                    </div>

                    <div class="col-md-8" style="position: relative;">
                        <input class="custom-input" type="file" name="profile" id="file" accept=".png, .jpeg, .jpg"
                            onchange="loadFile(event)">
                        <br>

                        <!-- Tombol "Simpan Data" dan "Batal" ditempatkan di paling bawah -->
                        <div style="position: absolute; bottom: 0;">
                            <input class="btn btn-primary" type="submit" value="Simpan Data" id="btn-simpan">
                            <input class="btn btn-danger" type="button" value="Batal" id="btn-batal"
                                onclick="confirmAndClearForm()">
                        </div>
                    </div>


                    <div class="col-md-4 text-center">
                        @if ($user->profile)
                            <!-- Tampilkan gambar profil sebelumnya jika ada -->
                            <img id="output" src="data_file/{{ $user->profile }}" class="img-thumbnail"
                                alt="Profile Image" style="width: 200px; height: 200px; object-fit: cover;"
                                crossorigin="anonymous">
                            <label id="previousFileLabel" for="profile">Previous File: {{ $user->profile }}</label>
                        @else
                            <!-- Tampilkan gambar default jika tidak ada gambar profil sebelumnya -->
                            <img src="https://picsum.photos/200/" class="img-thumbnail" alt="Profile Image"
                                style="width: 200px; height: 200px; object-fit: cover;" crossorigin="anonymous">
                            <label for="profile">Previous File: {{ $user->profile }}</label><br>
                        @endif
                    </div>

                </div>
            </div>
        </form>

        <!-- Pastikan Anda sudah memasukkan Sweet Alert di sini -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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

            var loadFile = function(event) {
                var output = document.getElementById('output');
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

    @section('js')
        <script>
            function checkPassword() {
                const newPasswordInput = document.getElementById('email');
                const verifyPasswordDiv = document.getElementById('verifyPasswordDiv');

                if (newPasswordInput.value) {
                    verifyPasswordDiv.style.display = 'block';
                } else {
                    verifyPasswordDiv.style.display = 'none';
                }
            }
        </script>
    @endsection
