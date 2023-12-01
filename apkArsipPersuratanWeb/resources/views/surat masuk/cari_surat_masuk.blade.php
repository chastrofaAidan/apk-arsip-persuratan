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