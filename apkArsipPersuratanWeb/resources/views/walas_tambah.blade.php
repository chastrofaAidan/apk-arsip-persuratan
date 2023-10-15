@extends('master')

@section('konten')
<h3>Tambah Wali Kelas</h3>
        <form action="/walas/store" method="post" enctype="multipart/form-data"> 
            {{ csrf_field() }} 
            File Gambar <input class="list-group-item"type="file" name="fotowalas" required="required"> 
            <br />
            Nama Wali Kelas     <input class="list-group-item"type="text" name="namawalas" required="required"> 
            <br />
            NIP    <input class="list-group-item"type="number" name="nip" required="required"> 
            <br /> 
            Kelas   <input class="list-group-item"type="text" name="kelaswalas" required="required"> 
            <br /> 
            Mata Pelajaran  <input class="list-group-item"type="text" name="mapel" required="required"> 
            <br />
            <input  class="btn btn-primary" type="submit" value="Simpan Data"> 
        </form>

        <br><br><br><br><br>

        @include('walas_index')
@endsection