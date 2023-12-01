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
    <i class="ri-mail-unread-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Surat Masuk
@endsection

@section('isi')
    <div class="px-3 py-2 bg-white rounded shadow">
        <h4 class="fw-bold" style="margin: 5px 0;">
            <i class="ri-equalizer-line" style="font-size: 20px;"></i>
            Filter
        </h4>
        <div class="row" style="padding: 5px 0px 20px 0px;">
            <div class="col-md-4">
                <label>Pengirim</label>
                <select id="filter-pengirim" class="form-control filter">
                    <option value="" disabled selected>Pilih Pengirim</option>
                    <option value="all">Semua Pengirim</option>
                    @foreach ($pengirimList as $pengirim)
                        <option value="{{ $pengirim }}">
                            {{ $pengirim }}
                        </option>
                    @endforeach
                </select>
            </div>
        
            <div class="col-md-4">
                <label>Pendata</label>
                <select id="filter-pendata" name="pendata" class="form-control filter">
                    <option value="" disabled selected>Pilih Pendata</option>
                    <option value="all">Semua Pendata</option>
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
            <label>Tanggal / Nomor Surat Masuk / Pokok isi Surat </label>
            <br>
            <input type="text" id="search"
                class="w-full p-2  border border-gray-300 border-solid rounded-lg outline-none font-poppins"
                placeholder="Cari...">
        </div>
        <br>

        <table class="table table-bordered table-striped" border="1">
            <tr>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">No</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Tanggal</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Nomor Surat Masuk</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Pengirim</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Tanggal Surat Datang
                </th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Pokok Isi Surat</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Keterangan</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Pendata</th>
                @if (Auth::user()->role == 'admin')
                    <th class="text-center" style="background-color: var(--bs-color1); color: white;">Action</th>
                @endif
            </tr>

            <tbody class="container-masuk">
            @foreach ($datamasuk as $m)
                <tr>
                    <td>{{ $m->no_masuk }}</td>
                    <td>
                        @if ($m->tanggal_masuk)
                            {{ $m->tanggal_masuk->format('Y-m-d') }}
                        @else
                            No Date Available
                        @endif
                    </td>
                    <td>{{ $m->kode_masuk }}</td>
                    <td>{{ $m->pengirim }}</td>

                    <td>{{ $m->identitas_masuk }}</td>
                    <td>{{ $m->pokok_masuk }}</td>
                    <td>{{ $m->keterangan_masuk }}</td>
                    <td>{{ optional($m->user)->name }}</td>

                    @if (Auth::user()->role == 'admin')
                        <td>
                            <a href="/surat_masuk/edit/{{ $m->no_masuk }}" class="btn col-12 text-center"
                                style="background-color: var(--bs-color2); color: white;">
                                <i class="ri-edit-box-line"></i>
                            </a><br><br>

                            <a href="/surat_masuk/arsip/{{ $m->no_masuk }}" class="btn col-12 text-center"
                                style="background-color: var(--bs-color1); color: white;">
                                <i class="ri-book-2-line"></i>
                            </a><br><br>

                            <a href="#" class="btn col-12 text-center delete-btn"
                                data-url="/surat_masuk/hapus/{{ $m->no_masuk }}"
                                style="background-color: var(--bs-color2); color: white;">
                                <i class="ri-delete-bin-line"></i>
                            </a><br>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Pagination links -->
        {{ $datamasuk->appends(['per_page' => $perPage])->links() }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("search");

        searchInput.addEventListener("input", function() {
            const searchPengarsip = searchInput.value.toLowerCase();

            $.ajax({
                url: '/surat_masuk/cari-masuk',
                type: 'GET',
                data: {
                    search: searchPengarsip
                },
                success: function(data) {
                    document.querySelector('.container-masuk').innerHTML = data;
                }
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const searchInputPengirim = document.getElementById("filter-pengirim"); // Perbaikan nama variabel

        searchInputPengirim.addEventListener("input", function() {
            const searchTerm = searchInputPengirim.value.toLowerCase(); // Perbaikan nama variabel

            $.ajax({
                url: '/surat_masuk/cari-masuk',
                type: 'GET',
                data: {
                    search: searchTerm
                },
                success: function(data) {
                    document.querySelector('.container-masuk').innerHTML = data;
                }
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const selectPendata = document.getElementById("filter-pendata");

        selectPendata.addEventListener("change", function() {
            const selectedPendata = selectPendata.value;

            $.ajax({
                url: '/surat_masuk/cari-masuk',
                type: 'GET',
                data: {
                    pendata: selectedPendata
                },
                success: function(data) {
                    document.querySelector('.container-masuk').innerHTML = data;
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
