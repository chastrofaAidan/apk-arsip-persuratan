<h3>Surat Arsip</h3>
<br>
<a href="/arsip/tambah" class="btn btn-primary">Tambah Arsip</a>
<br/>
<br/>

<table class="table table-bordered" border="1">
    <tr> 
        <th>ID</th>
        <th>Kode Surat</th>
        <th>Judul Surat</th>
        <th>Jenis Surat</th>
        <th>Perusahaan</th>
        <th>Tanggal Surat</th>
        <th>Perihal Surat</th>
        <th>File</th>
        <th>Keterangan</th>
        <th>Action</th>
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
            <a href="{{ asset('preview/' . $a->file_surat) }}" target="_blank">Preview</a>
            |
            <a href="{{ asset('preview/' . $a->file_surat) }}" download>Download</a>
        </td>

        <td>{{ $a->keterangan }}</td>
        <td>
            <a href="/arsip/edit/{{ $a->id_surat }}">Edit</a>
            |
            <a href="/arsip/hapus/{{ $a->id_surat }}">Hapus</a>
        </td>
    </tr>
    @endforeach
</table>