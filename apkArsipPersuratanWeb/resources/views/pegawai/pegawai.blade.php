@extends('partials/sidebar')

@section('Judul')
    <i class="ri-account-circle-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    <h1 style="font-size: 35px; font-weight: bold;">Pegawai</h1>
@endsection

@section('isi')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Daftar Pegawai</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    
    <body>
        
        {{-- Content-end --}}
        <div>
            <div class="p-4 border-2 border-gray-200 rounded-lg bg-white">
                <div class="p-2Psu">
                    <h4 class="fw-bold" style="margin: 5px 0;">
                        <i class="ri-file-list-line" style="font-size: 20px;"></i>
                        Daftar Pegawai
                    </h4>
                </div>

                <!-- Tambah Pegawai Buttons -->
                <div class="flex">
                    <div class="w-3/12 relative flex flex-col shadow-lg mb-6 rounded-lg p-4 mr-4">
                        <span class="font-poppins font-semibold text-gray-500">Total Pegawai</span>
                        <span
                            class="font-poppins font-bold text-[#8AA7FF] text-2xl p-2 text-center">{{ $totalPegawai }}</span>
                    </div>
                    <div class="w-2/12 relative flex flex-col shadow-lg mb-6 rounded-lg p-4 mr-4 hover:bg-[#8AA7FF] transition ease-linear font-poppins font-semibold text-gray-500 hover:text-white cursor-pointer text-center"
                        onclick="window.location.href='/pegawai/tambah'">
                        Tambah
                        <i class="fa-solid fa-plus w-full h-full flex justify-center items-center text-2xl"></i>
                    </div>

                </div>

                <!-- Search Input -->
                <div class="relative flex flex-col shadow-lg mb-6 rounded-lg p-4">

                    <div class="grid grid-cols-2 gap-4">
                        @php $counter = 1; @endphp
                        @foreach ($user as $user)
                            @if ($user->role !== 'superadmin')
                                <div class="p-1 block searchItems">
                                    <div class="bg-gray-200 p-2 rounded-t-lg flex justify-between">
                                        <div class="font-bold text-md text-gray-500 bg-gray-300 rounded-lg p-1 px-3">
                                            {{ $counter }}</div>
                                        <div>
                                            <button onclick="window.location.href = '{{ route('pegawai.edit', ['id' => $user->id]) }}'"
                                                class="bg-white hover:bg-blue-500 p-1 pl-2 rounded-lg text-blue-500 hover:text-white transition ease-linear cursor-pointer">
                                                <i class="fa-solid fa-pen-to-square font-bold text-lg mr-1"></i>
                                            </button>
                                            <button
                                                class="bg-white hover:bg-red-500 p-1 px-2 rounded-lg text-red-500 hover:text-white transition ease-linear cursor-pointer delete delete-btn"
                                                data-url="/pegawai/hapus/{{ $user->id }}">
                                                <i class="fa-solid fa-trash font-bold text-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Card Placeholder Data -->
                                    <div
                                        class="rounded-b-lg border border-gray-300 border-solid shadow-md p-2 hover:bg-red-500 transition ease-linear cursor-pointer">
                                        <div class="flex">
                                            <div class="w-40 h-40 border border-gray-300 relative overflow-hidden">
                                                <img src="data_file/{{ $user->profile }}" class="w-full h-full object-cover"
                                                    alt="placeholder_image">
                                            </div>
                                            <div
                                                class="w-full p-2 border border-gray-300 border-solid rounded-tr-lg bg-white ml-2">
                                                <div class="font-poppins font-bold text-md">{{ $user->name }}</div>
                                                <!-- Data Placeholder -->
                                                <div class="font-medium font-poppins text-sm line-clamp-1 overflow-hidden">
                                                    Email: {{ $user->email }}
                                                </div>
                                                <div class="font-medium font-poppins text-sm line-clamp-1 overflow-hidden">
                                                    Role: {{ $user->role }}
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="w-full rounded-b-lg p-2 border border-gray-300 mt-2 font-poppins font-semibold bg-white">
                                            <span class="text-blue-500"></span>
                                            <br>
                                            <span class="text-blue-400"></span>
                                        </div>
                                    </div>
                                    @php $counter++; @endphp
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen input pencarian
        var searchInput = document.getElementById('search');

        // Tambahkan event listener untuk setiap perubahan pada input
        searchInput.addEventListener('input', function() {
            var searchTerm = searchInput.value.toLowerCase();
            var searchItems = document.querySelectorAll('.searchItems');

            // Loop melalui setiap item dan sembunyikan/munculkan berdasarkan kesesuaian dengan kata kunci pencarian
            searchItems.forEach(function(item) {
                var userName = item.querySelector('.font-bold').textContent.toLowerCase();
                if (userName.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
        document.addEventListener('DOMContentLoaded', function() {
            // Tambahkan event listener untuk tombol delete
            var deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    var url = button.getAttribute('data-url');

                    // Tampilkan Sweet Alert untuk konfirmasi
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin menghapus data ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus data',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika pengguna memilih Ya, lanjutkan dengan mengarahkan ke URL hapus
                            window.location.href = url;

                            // Tampilkan pesan bahwa data berhasil dihapus
                            Swal.fire({
                                title: 'Sukses!',
                                text: 'Data berhasil dihapus.',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                });
            });
        });
    </script>

    </html>
@endsection
