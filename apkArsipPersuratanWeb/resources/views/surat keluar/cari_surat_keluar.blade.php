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
                    <td>{{ $k->keterangan_keluar }}</td>
                    
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
                    <td>{{ optional($k->user)->name }}</td>

                    @if (Auth::user()->role == 'admin')
                        <td>
                            <a href="/surat_keluar/edit/{{ $k->no_keluar }}" class="btn col-12 text-center"
                                style="background-color: var(--bs-color2); color: white;">
                                <i class="ri-edit-box-line"></i>
                            </a><br><br>

                            <a href="/surat_keluar/arsip/{{ $k->no_keluar }}" class="btn col-12 text-center"
                                style="background-color: var(--bs-color1); color: white;">
                                <i class="ri-book-2-line"></i>
                            </a><br><br>

                            <a href="/surat_keluar/hapus/{{ $k->no_keluar }}" class="btn col-12 text-center delete-btn"
                                data-url="/surat_keluar/hapus/{{ $k->no_keluar }}"
                                style="background-color: var(--bs-color2); color: white;">
                                <i class="ri-delete-bin-line"></i>
                            </a><br>

                        </td>
                    @endif
                </tr>
            @endforeach