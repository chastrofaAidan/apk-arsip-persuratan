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
        <td>{{ $a->keterangan }}</td>

        <td>{{ $a->perihal_surat }}</td>
        <td>
            <a href="{{ asset('preview/' . $a->file_surat) }}" class="btn col-12 text-center" target="_blank"
                style="background-color: var(--bs-color2); color: white;">
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
