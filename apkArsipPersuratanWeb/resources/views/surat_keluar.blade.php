@extends('partials/sidebar')
@section('Judul')
<i class="ri-mail-send-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Surat Keluar
@endsection


@section('isi')

<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-equalizer-line" style="font-size: 20px;"></i>
    Filter
</h4>

</div>
<br><br>
<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-mail-send-line sidebar-menu-item-icon" style="font-size: 20px;"></i>
    Surat Keluar
</h4>
<br>
<!-- <form action="/surat_keluar/search" method="GET">
    <label for="search">Date Format: YYYY-MM-DD</label><br>
    <input type="search" name="search" placeholder="Search">
    <button type="submit">
        find
    </button>
</form>
<br/><br/> -->
<form action="/surat_keluar" method="GET"> <!-- Add this form for per_page -->
    <label for="per_page">Records Per Page: </label>
    <select name="per_page" id="per_page" onchange="this.form.submit()">
        <option value="3" @if($perPage == 3) selected @endif>3</option>
        <option value="5" @if($perPage == 5) selected @endif>5</option>
        <option value="10" @if($perPage == 10) selected @endif>10</option>
        <option value="25" @if($perPage == 25) selected @endif>25</option>
        <option value="50" @if($perPage == 50) selected @endif>50</option>
        <option value="100" @if($perPage == 100) selected @endif>100</option>
    </select>
</form>

<table class="table table-bordered table-striped" border="1">
    <tr> 
        <th style="background-color: var(--bs-color1); color: white;">Kode Surat</th>
        <th style="background-color: var(--bs-color1); color: white;">Judul Surat</th>
        <th style="background-color: var(--bs-color1); color: white;">Perusahaan</th>
        <th style="background-color: var(--bs-color1); color: white;">Tanggal Keluar</th>
        <th style="background-color: var(--bs-color1); color: white;">Perihal Surat</th>
        <th style="background-color: var(--bs-color1); color: white;">File</th>
        <th style="background-color: var(--bs-color1); color: white;">Keterangan</th>
    </tr>

    @foreach($dataarsip as $a)
    <tr>
        <td>{{ $a->kode_surat }}</td>
        <td>{{ $a->judul_surat }}</td>
        <td>{{ $a->perusahaan }}</td>
        <td>
            @if ($a->tanggal_surat)
                {{ $a->tanggal_surat->format('Y-m-d') }}
            @else
                No Date Available
            @endif
        </td>

        <td>{{ $a->perihal_surat }}</td>
        <td>
            <a href="{{ asset('preview/' . $a->file_surat) }}" class="btn col-12 text-center" target="_blank" style="background-color: var(--bs-color2); color: white;">
                <i class="ri-eye-line"></i>
            </a><br><br>
            <a href="{{ asset('preview/' . $a->file_surat) }}" class="btn col-12 text-center" style="background-color: var(--bs-color1); color: white;" download>
                <i class="ri-file-download-line"></i>
            </a><br>
        </td>

        <td>{{ $a->keterangan }}</td>
    </tr>
    @endforeach
</table>

<!-- Pagination links -->
{{ $dataarsip->appends(['per_page' => $perPage])->links() }}
</div>
@endsection