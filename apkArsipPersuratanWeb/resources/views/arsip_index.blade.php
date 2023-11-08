@extends('partials/sidebar')

@section('css')
<style>
    th, td {
        vertical-align: middle; /* Center the content vertically */
    }
</style> 
@endsection

@section('Judul')
<i class="ri-archive-2-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Surat Arsip
@endsection

@section('isi')

<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-equalizer-line" style="font-size: 20px;"></i>
    Filter
</h4>
<div class="row">
    <div class="col-md-4">
        <label>Perusahaan</label>
        <select id="filter-perusahaan" class="form-control filter">
            <option value="" disabled selected>Pilih Perusahaan</option>
            @foreach($dataarsip as $a)
                <option value="{{ $a->id_surat }}">{{ $a->perusahaan }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label>Jenis Surat</label>
        <select id="filter-jenis" class="form-control filter">
            <option value="" disabled selected>Pilih Jenis Surat</option>
            @foreach($dataarsip as $a)
                <option value="{{ $a->id_surat }}">{{ $a->jenis_surat }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label>Perihal</label>
        <select id="filter-perihal" class="form-control filter">
            <option value="" disabled selected>Pilih Perihal</option>
            @foreach($dataarsip as $a)
                <option value="{{ $a->id_surat }}">{{ $a->perihal_surat }}</option>
            @endforeach
        </select>
    </div>
    
</div>
</div>
<br><br>


<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-archive-2-line sidebar-menu-item-icon" style="font-size: 20px;"></i>
    Surat Arsip
</h4>
<br>
<!-- <form action="/surat_arsip/search" method="GET">
    <label for="search">Date Format: YYYY-MM-DD</label><br>
    <input type="search" name="search" placeholder="Search">
    <button type="submit">
        find
    </button>
</form>
<br/><br/> -->
<form action="/surat_arsip" method="GET"> <!-- Add this form for per_page -->
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
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">ID</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Kode Surat</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Judul Surat</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Jenis Surat</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Perusahaan</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Tanggal Surat</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Perihal Surat</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">File</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Keterangan</th>
        <th class="text-center" style="background-color: var(--bs-color1); color: white;">Action</th>
    </tr>

    @foreach($dataarsip as $a)
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
        <td>
            <a href="{{ asset('preview/' . $a->file_surat) }}" class="btn col-12 text-center" target="_blank" style="background-color: var(--bs-color2); color: white;">
                <i class="ri-eye-line"></i>
            </a><br><br>
            <a href="{{ asset('preview/' . $a->file_surat) }}" class="btn col-12 text-center" style="background-color: var(--bs-color1); color: white;" download>
                <i class="ri-file-download-line"></i>
            </a><br>
        </td>

        <td>{{ $a->keterangan }}</td>
        <td>
            <a href="/surat_arsip/edit/{{ $a->id_surat }}" class="btn col-12 text-center" style="background-color: var(--bs-color2); color: white;">
            <i class="ri-edit-box-line"></i>
            </a><br><br>
            <a href="/arsip/hapus/{{ $a->id_surat }} " class="btn col-12 text-center" style="background-color: var(--bs-color1); color: white;">
                <i class="ri-delete-bin-line"></i>            
            </a><br>
        </td>
    </tr>
    @endforeach
</table>

<!-- Pagination links -->
{{ $dataarsip->appends(['per_page' => $perPage])->links() }}
</div>
</div>


@endsection


<!-- @section('js')
<script>
    let perusahaan = $("#filter-perusahaan").val()
    let jenis = $("#filter-jenis").val()
    let perihal = $("#filter-perihal").val()
    
    $(".filter").on('change',function(){
        perusahaan = $("#filter-perusahaan").val()
        jenis = $("#filter-jenis").val()
        perihal = $("#filter-perihal").val()
        // console.log([perusahaan,jenis,perihal])
        // console.log("FILTER")
    })
</script>
@endsection -->
