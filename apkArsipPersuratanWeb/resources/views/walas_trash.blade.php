@extends('master')

@section('konten')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-center">
                Data Wali Kelas
            </div>
            
            <div class="card-body">
                <a href="/walas/tambah">Data Wali Kelas</a>
                <br/>
                <br/>
                <a href="/walas/kembalikan_semua">Kembalikan Semua</a>
                |
                <a href="/walas/hapus_permanen_semua">Hapus Permanen Semua</a>
                <br/>
                <br/>
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nama Wali Kelas</th>
                            <th>NIP</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th width="30%">OPSI</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($walas as $w)
                            <tr>
                                <td>
                                    <img src="{{ url('data_file/' . $w->fotowalas) }}" alt="{{ $w->fotowalas }}" width="100px">    
                                </td>
                                <td>{{ $w->namawalas }}</td>
                                <td>{{ $w->nip }}</td>
                                <td>{{ $w->kelaswalas }}</td>
                                <td>{{ $w->mapel }}</td>
                                <td>
                                    <a href="/walas/kembalikan/{{ $w->idwalas }}" class="btn btn-success btn-sm">Restore</a>
                                    <a href="/walas/hapus_permanen/{{ $w->idwalas }}" class="btn btn-danger btn-sm">Hapus Permanen</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection