@extends('partials/sidebar')

@section('css')
<style>
    th, td {
        vertical-align: middle; /* Center the content vertically */
    }
</style>
@endsection

@section('Judul')
<i class="ri-mail-unread-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Surat Masuk
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
    <i class="ri-mail-unread-line sidebar-menu-item-icon" style="font-size: 20px;"></i>
    Surat Masuk
</h4>
<br>
<!-- <form action="/surat_masuk/search" method="GET">
    <label for="search">Date Format: YYYY-MM-DD</label><br>
    <input type="search" name="search" placeholder="Search">
    <button type="submit">Find</button>
</form>
<br><br> -->

<form action="/surat_masuk" method="GET"> <!-- Add this form for per_page -->
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
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">No</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Tanggal</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Nomor Surat Masuk</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Pengirim</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Nomor dan Tanggal Masuk</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Pokok Isi Surat</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Keterangan</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Action</th>
    </tr>

    @foreach($datamasuk as $m)
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

        @if (Auth::user()->role == 'superadmin')
        <td>
            <a href="/surat_masuk/edit/{{ $m->no_masuk }}" class="btn col-12 text-center" style="background-color: var(--bs-color2); color: white;">
            <i class="ri-edit-box-line"></i>
            </a><br><br>
            
            <a href="/surat_masuk/hapus/{{ $m->no_masuk }}" class="btn col-12 text-center" style="background-color: var(--bs-color1); color: white;">
                <i class="ri-delete-bin-line"></i>
            </a><br>

        </td>
        @endif
    </tr>
    @endforeach
</table>

<!-- Pagination links -->
{{ $datamasuk->appends(['per_page' => $perPage])->links() }}
@endsection