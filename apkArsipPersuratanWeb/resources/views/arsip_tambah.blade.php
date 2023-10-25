<h3>Tambah Arsip</h3>
<a href="/arsip"> Kembali</a>
<form action="/arsip/store" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <label for="kode_surat">Kode Surat</label>
    <input class="list-group-item" type="text" name="kode_surat" id="kode_surat" required="required"><br>

    <label for="judul_surat">Judul Surat</label>
    <input class="list-group-item" type="text" name="judul_surat" id="judul_surat" required="required"><br>

    <label for="jenis_surat">Jenis Surat</label>
    <select class="list-group-item" name="jenis_surat" id="jenis_surat" required="required">
        <option value="" disabled selected>Select Jenis Surat</option>
        <option value="Surat Masuk">Surat Masuk</option>
        <option value="Surat Keluar">Surat Keluar</option>
    </select><br>

    <label for="perusahaan">Perusahaan</label>
    <input class="list-group-item" type="text" name="perusahaan" id="perusahaan" required="required"><br>

    <label for="tanggal_surat">Tanggal Surat</label>
    <input class="list-group-item" type="date" name="tanggal_surat" id="tanggal_surat" required="required"><br>

    <label for="perihal_surat">Perihal Surat</label>
    <input class="list-group-item" type="text" name="perihal_surat" id="perihal_surat" required="required"><br>

    <label for="file">File</label>
    <input class="list-group-item" type="file" name="file" id="file" required="required"><br>

    <label for="keterangan">Keterangan</label>
    <input class="list-group-item" type="text" name="keterangan" id="keterangan" required="required" size="50"><br>

    <input class="btn btn-primary" type="submit" value="Simpan Data">
</form>