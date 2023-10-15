{{-- @extends('master')

@section('konten')
@endsection
<!DOCTYPE html>
<html>
    <head>
        <title>Tutorial Membuat CRUD Pada Laravel 8</title>
    </head>

    <body>
        <h2>www.agussuratna.net</h2> --}}
        <h3>Data Wali Kelas</h3>

        {{-- <a href="/walas/tambah"> + Tambah Wali Kelas Baru +</a> --}}
        <br>
        <a href="/walas/trash" class="btn btn-primary">Tempat Sampah</a>

        <br/>
        <br/>

        <table class="table table-bordered" border="1">
            <tr> 
                <th>Foto</th>
                <th>Nama Wali Kelas</th>
                <th>NIP</th>
                <th>Kelas</th>
                <th>Mapel</th>
            </tr>

            @foreach($datawalas as $s)
            <tr>
                <td>
                    <img src="{{ asset('data_file/' . $s->fotowalas) }}" alt="Image" width="100">    
                </td>
                <td>{{ $s->namawalas }}</td>
                <td>{{ $s->nip }}</td>
                <td>{{ $s->kelaswalas }}</td>
                <td>{{ $s->mapel }}</td>
                <td>
                    <a href="/walas/edit/{{ $s->idwalas }}">Edit</a>
                    |
                    <a href="/walas/hapus/{{ $s->idwalas }}">Hapus</a>
                </td>
            </tr>
            @endforeach
        {{-- </table>
    </body>
</html> --}}