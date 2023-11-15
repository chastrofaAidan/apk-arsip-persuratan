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
    <i class="ri-mail-send-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Surat Keluar
@endsection


@section('isi')
    <div class="px-3 py-2 bg-white rounded shadow">
        <h4 class="fw-bold" style="margin: 5px 0;">
            <i class="ri-equalizer-line" style="font-size: 20px;"></i>
            Filter
        </h4>

    </div>
    <br><br>
    <div class="px-3 py-2 bg-white rounded shadow" style="overflow-x: auto; max-width: 100%;">
        <form action="/surat_keluar/search" method="GET">
            <label for="search">Date Format: YYYY-MM-DD</label><br>
            <input type="search" name="search" placeholder="Search">
            <button type="submit">
                Find
            </button>
        </form>

        <form action="/surat_keluar" method="GET" style="padding: 20px 0px 20px 0px;"> <!-- Add this form for per_page -->
            <label for="per_page">Records Per Page: </label>
            <select name="per_page" id="per_page" onchange="this.form.submit()">
                <option value="3" @if ($perPage == 3) selected @endif>3</option>
                <option value="5" @if ($perPage == 5) selected @endif>5</option>
                <option value="10" @if ($perPage == 10) selected @endif>10</option>
                <option value="25" @if ($perPage == 25) selected @endif>25</option>
                <option value="50" @if ($perPage == 50) selected @endif>50</option>
                <option value="100" @if ($perPage == 100) selected @endif>100</option>
            </select>
        </form>

        <table class="table table-bordered table-striped" border="1">
            <tr>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">No </th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Tanggal</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Nomor Surat Keluar</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Ditujukan Kepada</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Perihal</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">File Template</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Keterangan</th>
                <th class="text-center" style="background-color: var(--bs-color1); color: white;">Action</th>
            </tr>

            @foreach ($datakeluar as $k)
                <tr>
                    <td>{{ $k->no_keluar }}</td>
                    <td>
                        @if ($k->tanggal_keluar)
                            {{ $k->tanggal_keluar->format('Y-m-d') }}
                        @else
                            No Date Available
                        @endif
                    </td>
                    <td>{{ $k->kode_keluar }}</td>
                    <td>{{ $k->ditujukan }}</td>
                    <td>{{ $k->perihal_keluar }}</td>

                    <td>
                        <a href="{{ asset('preview/' . $k->surat_keluar) }}" class="btn col-12 text-center" target="_blank"
                            style="background-color: var(--bs-color2); color: white;">
                            <i class="ri-eye-line"></i>
                        </a><br><br>
                        <a href="{{ asset('preview/' . $k->surat_keluar) }}" class="btn col-12 text-center"
                            style="background-color: var(--bs-color1); color: white;" download>
                            <i class="ri-file-download-line"></i>
                        </a><br>
                    </td>
                    <td>{{ $k->keterangan_keluar }}</td>

                    @if (Auth::user()->role == 'admin')
                        <td>
                            <a href="/surat_keluar/edit/{{ $k->no_keluar }}" class="btn col-12 text-center"
                                style="background-color: var(--bs-color2); color: white;">
                                <i class="ri-edit-box-line"></i>
                            </a><br><br>

                            <a href="/surat_keluar/hapus/{{ $k->no_keluar }}" class="btn col-12 text-center delete-btn"
                                data-url="/surat_keluar/hapus/{{ $k->no_keluar }}"
                                style="background-color: var(--bs-color1); color: white;">
                                <i class="ri-delete-bin-line"></i>
                            </a><br>

                        </td>
                    @endif
                </tr>
            @endforeach
        </table>

        <!-- Pagination links -->
        {{ $datakeluar->appends(['per_page' => $perPage])->links() }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
