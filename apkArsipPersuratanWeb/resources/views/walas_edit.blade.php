@extends('master')

@section('konten')
<body>
    <h3>Edit Wali Kelas</h3>
    <a href="/walas/tambah"> Kembali</a>
    <br/>
    <br/>
    
    @foreach($datawalas as $s)
        <form action="/walas/update" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="idwalas" value="{{ $s->idwalas }}">
            
            File Gambar 
            <input class="list-group-item" type="file" name="fotowalas" value="{{ $s->fotowalas ? old('fotowalas', $s->fotowalas) : '' }}">
            <br/>
            <label>Assigned File: {{ $s->fotowalas }}</label>
            <br/><br/>
            
            
            Nama Wali Kelas <input class="list-group-item"  type="text" required="required" name="namawalas" value="{{ $s->namawalas }}">
            <br/>
            NIP <input class="list-group-item" type="number" required="required" name="nip" value="{{ $s->nip }}">
            <br/>
            Kelas <input class="list-group-item" type="text" required="required" name="kelaswalas" value="{{ $s->kelaswalas }}">
            <br/>
            Mata Pelajaran <input class="list-group-item" type="text" required="required" name="mapel" value="{{ $s->mapel }}">
            <br/>
            <input class="btn btn-primary" type="submit" value="Simpan Data">
        </form>

        <br><br><br><br><br>

        @include('walas_index')
    @endforeach
@endsection