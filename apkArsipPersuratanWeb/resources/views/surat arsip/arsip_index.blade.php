@extends('partials/sidebar')

@section('css')
    <style>
        th,
        td {
            vertical-align: middle;
            /* Center the content vertically */
        }
    </style>
@endsection

@section('Judul')
    <i class="ri-archive-2-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Surat Arsip
@endsection

@section('isi')
    <div class="px-3 py-2 bg-white rounded shadow">
        <h4 class="fw-bold" style="margin: 5px 0;">
            <i class="ri-equalizer-line" style="font-size: 20px;"></i>
            Filter
        </h4>
        <div class="row" style="padding: 5px 0px 20px 0px;">
            <div class="col-md-4">
                <label>Perusahaan</label>
                <select id="filter-perusahaan" class="form-control filter">
                    <option value="" disabled selected>Pilih Perusahaan</option>
                    <option value="all">Semua Perusahaan</option>
                    @foreach ($perusahaanList as $perusahaan)
                        <option value="{{ $perusahaan }}">
                            {{ $perusahaan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label>Jenis Surat</label>
                <select id="filter-jenis" name="search" class="form-control filter">
                    <option value="" disabled selected>Pilih Jenis Surat</option>
                    <option value="all">Surat Masuk & Keluar</option>
                    <option value="masuk">Surat Masuk</option>
                    <option value="keluar">Surat Keluar</option>
                </select>
            </div>

            <div class="col-md-4">
                <label>Pengarsip</label>
                <select id="filter-pengarsip" name="pengarsip" class="form-control filter">
                    <option value="" disabled selected>Pilih Pengarsip</option>
                    <option value="all">Semua Pengarsip</option>
                    @foreach ($admins as $admin)
                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <br>


    <div class="px-3 py-2 bg-white rounded shadow" style="overflow-x: auto; max-width: 100%;">
        <div class="col-md-4">
            <label>Kode Surat / Judul Surat</label>
            <br>
            <input type="text" id="search"
                class="w-full p-2  border border-gray-300 border-solid rounded-lg outline-none font-poppins"
                placeholder="Cari...">
        </div>
        <br>

        <table class="table table-bordered table-striped" border="1">
            <tr>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">ID</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Kode Surat</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Judul Surat</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Jenis Surat</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Perusahaan</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Tanggal Surat</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Perihal Surat</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Keterangan</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">File</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Pengarsip</th>
                @if (Auth::user()->role == 'admin')
                    <th class="text-center" style="background-color: var(--bs-color1); color: white;">Action</th>
                @endif
            </tr>

            <tbody class="container-arsip">
                @foreach ($dataarsip as $a)
                    <tr>
                        <td>{{ $a->id_surat }}</td>
                        <td>{{ $a->kode_surat }}</td>
                        <td>{{ $a->judul_surat }}</td>
                        <td>{{ $a->jenis_surat }}</td>
                        <td>{{ $a->perusahaan }}</td>
                        <td>
                            @if ($a->tanggal_surat)
                                {{ $a->tanggal_surat->format('Y-m-d') }}
                            @else
                                No Date Available
                            @endif
                        </td>
                        <td>{{ $a->perihal_surat }}</td>
                        <td>{{ $a->keterangan }}</td>

                        <td>
                            <a href="{{ asset('preview/' . $a->file_surat) }}" class="btn col-12 text-center"
                                target="_blank" style="background-color: var(--bs-color2); color: white;">
                                <i class="ri-eye-line"></i>
                            </a><br><br>
                            <a href="{{ asset('preview/' . $a->file_surat) }}" class="btn col-12 text-center"
                                style="background-color: var(--bs-color1); color: white;" download>
                                <i class="ri-file-download-line"></i>
                            </a><br>
                        </td>

                        <td>{{ optional($a->user)->name }}</td>
                        @if (Auth::user()->role == 'admin')
                            <td>
                                <a href="/surat_arsip/edit/{{ $a->id_surat }}" class="btn col-12 text-center"
                                    style="background-color: var(--bs-color2); color: white;">
                                    <i class="ri-edit-box-line"></i>
                                </a><br><br>
                                <a href="/arsip/hapus/{{ $a->id_surat }}" class="btn col-12 text-center delete-btn"
                                    data-url="/arsip/hapus/{{ $a->id_surat }}"
                                    style="background-color: var(--bs-color1); color: white;">
                                    <i class="ri-delete-bin-line"></i>
                                </a><br>
                          </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $dataarsip->links() }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("search");

            searchInput.addEventListener("input", function() {
                const searchPengarsip = searchInput.value.toLowerCase();

                $.ajax({
                    url: '/arsip/cari-arsip',
                    type: 'GET',
                    data: {
                        search: searchPengarsip
                    },
                    success: function(data) {
                        document.querySelector('.container-arsip').innerHTML = data;
                    }
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("filter-jenis");

            searchInput.addEventListener("input", function() {
                const searchTerm = searchInput.value.toLowerCase();

                $.ajax({
                    url: '/arsip/cari-arsip',
                    type: 'GET',
                    data: {
                        search: searchTerm
                    },
                    success: function(data) {
                        document.querySelector('.container-arsip').innerHTML = data;
                    }
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const selectPerusahaan = document.getElementById("filter-perusahaan");

            selectPerusahaan.addEventListener("change", function() {
                const selectedPerusahaan = selectPerusahaan.value;

                $.ajax({
                    url: '/arsip/cari-arsip',
                    type: 'GET',
                    data: {
                        perusahaan: selectedPerusahaan
                    },
                    success: function(data) {
                        document.querySelector('.container-arsip').innerHTML = data;
                    }
                });
            });
        });


        document.addEventListener("DOMContentLoaded", function() {
            const selectPengarsip = document.getElementById("filter-pengarsip");

            selectPengarsip.addEventListener("change", function() {
                const selectedPengarsipName = selectPengarsip.value;

                $.ajax({
                    url: '/arsip/cari-arsip',
                    type: 'GET',
                    data: {
                        pengarsip: selectedPengarsipName
                    },
                    success: function(data) {
                        document.querySelector('.container-arsip').innerHTML = data;
                    }
                });
            });
        });
    </script>


    <script>
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
@endsection
