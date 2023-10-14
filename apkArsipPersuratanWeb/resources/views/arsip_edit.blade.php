<body>
    <h3>Edit Arsip</h3>
    <a href="/arsip"> Kembali</a>

    @foreach($dataarsip as $a)
        <form action="/arsip/update" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id_surat" value="{{ $a->id_surat }}">

            <label for="kode_surat">Kode Surat</label>
            <input class="list-group-item" type="text" name="kode_surat" id="kode_surat" required="required" value="{{ $a->kode_surat }}"><br>

            <label for="judul_surat">Judul Surat</label>
            <input class="list-group-item" type="text" name="judul_surat" id="judul_surat" required="required" value="{{ $a->judul_surat }}"><br>

            <label for="jenis_surat">Jenis Surat</label>
                <select class="list-group-item" name="jenis_surat" id="jenis_surat" required="required">
                    <option value="" disabled>Select Jenis Surat</option>
                    <option value="Surat Masuk" {{ $a->jenis_surat === 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                    <option value="Surat Keluar" {{ $a->jenis_surat === 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar</option>
                </select><br>


            <label for="perusahaan">Perusahaan</label>
            <input class="list-group-item" type="text" name="perusahaan" id="perusahaan" required="required" value="{{ $a->perusahaan }}"><br>

            <label for="tanggal_surat">Tanggal Surat</label>
            <input class="list-group-item" type="date" name="tanggal_surat" id="tanggal_surat" required="required" value="{{ $a->tanggal_surat }}"><br>

            <label for="perihal_surat">Perihal Surat</label>
            <input class="list-group-item" type="text" name="perihal_surat" id="perihal_surat" required="required" value="{{ $a->perihal_surat }}"><br>

            <label for="file">New File</label>
            <input class="list-group-item" type="file" name="file" id="file"><br>
            <label for="file">Previous File: {{ $a->file_surat }}</label><br>


            <label for="keterangan">Keterangan</label>
            <input class="list-group-item" type="text" name="keterangan" id="keterangan" required="required" size="50" value="{{ $a->keterangan }}"><br>

            <input class="btn btn-primary" type="submit" value="Simpan Data">
        </form>
    @endforeach
</body>
