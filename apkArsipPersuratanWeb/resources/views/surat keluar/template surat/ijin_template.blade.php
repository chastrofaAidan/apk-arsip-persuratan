@extends('partials/pembuatan_surat')

@section('css')
<link rel="stylesheet" href="/css/surat_style.css">
<style>
    .container {
        /* max-width: 800px;
        margin: auto;
        padding: 20px; */
    }

    .row {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .col-md-10 {
        flex: 1;
    }

    .custom-input {
        width: 100%;
        background-color: #dedede;
        border: none;
        padding: 10px;
        color: black;
        border-radius: 1vh;
    }

    .paragraph {
        height: 100px;
        word-wrap: break-word;
        resize: vertical; /* Optional: Allow vertical resizing */
    }

    .custom-button {
        background-color: #9A4444;
        color: #fff;
        padding: 8px 20px;
        border-radius: 10px;
        border: 2px solid white;
    }

    .delete-button {
        background-color: #9A4444;
    }
</style>
@endsection

@section('template')
<div class="px-3 py-2 bg-white rounded shadow">
    <h4 class="fw-bold">
        <i class="ri-mail-add-line sidebar-menu-item-icon" style="font-size: 20px;"></i>
        Pembuatan Surat - Izin
    </h4>

    <form action="{{ route('pembuatanSuratStore') }}" method="post" enctype="multipart/form-data" target="_blank">
    {{ csrf_field() }}
    <div class="container">
        <br>

        <!-- Add this text input for the PDF file name -->
        <div class="col-md-12">
            <label for="surat_keluar">Nama Surat</label>
            <input class="custom-input" type="text" name="surat_keluar" id="surat_keluar" required="required"><br><br>
        </div>

        <div class="container">
            <textarea name="konten" id="konten" class="konten">
                <header>
                <table class="center-table">
                <tr>
                    <td width=20%>
                        <img src="{{ $kop_surat->logo_instansi }}" alt="Kop Surat" class="kop-surat align-bottom">
                    </td>
                    <td width=80% class="text-center">
                        <div class="txt-light title">PEMERINTAH DAERAH PROVINSI JAWA BARAT</div>
                        <div class="txt-light title">DINAS PENDIDIKAN</div>
                        <div class="txt-light title">{{ $kop_surat->lingkup_wilayah }}</div>
                        <div class="txt-bold big">{{ $kop_surat->nama_instansi }}</div>
                        <div class="txt-light">{{ $kop_surat->alamat_instansi }}, Telp./Fax. {{ $kop_surat->kontak_instansi }}</div>
                        <div class="txt-light">Website : {{ $kop_surat->website_instansi }} - email : <a href="{{ $kop_surat->email_instansi }}">{{ $kop_surat->email_instansi }}</a></div>
                        <div class="txt-light">{{ $kop_surat->kode_pos }}</div>
                    </td>
                </tr>
                </table>
                <hr class="thick-hr">
                </header>
                <div class="spacing">&nbsp;</div> <!-- Add some spacing -->
                <div class="text-center"><b class="title"><u>S U R A T &nbsp; I J I N</u></b></div>
                <div class="text-center">Nomor : 800/515/SMKN.1.Cadisdik WIL.VII</div>
                <div class="text-center">Tanggal : 01 November 2023</div>
            </textarea>
            <br><br>
            <div class="row">
                <div class="col-md-6">
                <input class="btn format-surat col-md-12" type="submit" name="pendataan" value="Pendataan Surat Keluar" style="background-color: var(--bs-color1); color: white;">
            </div>
            <div class="col-md-6">
                <input class="btn format-surat col-md-12" type="submit" name="unduh" value="Unduh File PDF" style="background-color: var(--bs-color1); color: white;">
            </div>
        </div>
    </div>
    </form>
@endsection

@section('js')

<!-- Include the jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.0/tinymce.min.js" integrity="sha512-SOoMq8xVzqCe9ltHFsl/NBPYTXbFSZI6djTMcgG/haIFHiJpsvTQn0KDCEv8wWJFu/cikwKJ4t2v1KbxiDntCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




<!-- <script>
    function generateAndSubmitForm() {
        // Get the TinyMCE editor content
        var editorContent = tinymce.get('editor').getContent();

        // Generate a unique PDF file name with the current datetime
        var currentDate = new Date();
        var formattedDate = currentDate.toISOString().replace(/:/g, '-').replace(/\..*$/, ''); // Format: YYYY-MM-DDTHH-MM-SS
        var pdfFileName = 'generated_file_' + formattedDate + '.pdf';

        // Set the PDF file name in the hidden input field
        document.getElementById('surat_keluar').value = pdfFileName;

        // Submit the form
        document.getElementById('suratForm').submit();
    }


    function generatePdfFromContent(content) {
        // Create a new jsPDF instance
        var pdf = new jsPDF();

        // Add HTML content to the PDF
        pdf.fromHTML(content, 15, 15);

        // Generate a unique file name with the current datetime
        var currentDate = new Date();
        var formattedDate = currentDate.toISOString().replace(/:/g, '-').replace(/\..*$/, ''); // Format: YYYY-MM-DDTHH-MM-SS
        var pdfFileName = 'generated_file_' + formattedDate + '.pdf';

        // Save the PDF to a file
        pdf.save(pdfFileName);

        // Return the generated file name
        return pdfFileName;
    }
</script> -->


<script>
    tinymce.init({
        selector: 'textarea.konten',
        height: 350,
        plugins: 'table advlist pagebreak image',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | table | bullist numlist outdent indent | pagebreak | image',
        // content_css: 'http://localhost/apk-arsip-persuratan/apkArsipPersuratanWeb/public/css/surat_style.css',
        file_picker_callback: function(callback, value, meta) {
        // Open a file dialog
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        // Listen for the file input change event
        input.addEventListener('change', function() {
            var file = input.files[0];

            // Create a FileReader to read the file as a data URL
            var reader = new FileReader();
            reader.onload = function(e) {
                // Pass the data URL to the callback
                callback(e.target.result, {
                    alt: file.name
                });
            };

            // Read the file as a data URL
            reader.readAsDataURL(file);
        });

        // Trigger the file input click event
        input.click();
    }
    });


    // Add a listener to the button click event
    document.getElementById('generatePdfBtn').addEventListener('click', function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Get the TinyMCE content
        var konten = tinymce.activeEditor.getContent();

        // Update the hidden input with the TinyMCE content
        document.getElementById('hiddenContent').value = konten;

        // Submit the form
        document.getElementById('myForm').submit();
    });



    // Set the initial content after TinyMCE is initialized
    // tinymce.get('editor').setContent(`
    // <header>
    //     <table class="center-table">
    //     <tr>
    //         <td width=20%>
    //             <img src="{{ $kop_surat->logo_instansi }}" alt="Kop Surat" class="kop-surat align-bottom">
    //         </td>
    //         <td width=80% class="text-center">
    //             <div class="txt-light title">PEMERINTAH DAERAH PROVINSI JAWA BARAT</div>
    //             <div class="txt-light title">DINAS PENDIDIKAN</div>
    //             <div class="txt-light title">{{ $kop_surat->lingkup_wilayah }}</div>
    //             <div class="txt-bold big">{{ $kop_surat->nama_instansi }}</div>
    //             <div class="txt-light">{{ $kop_surat->alamat_instansi }}, Telp./Fax. {{ $kop_surat->kontak_instansi }}</div>
    //             <div class="txt-light">Website : {{ $kop_surat->website_instansi }} - email : <a href="{{ $kop_surat->email_instansi }}">{{ $kop_surat->email_instansi }}</a></div>
    //             <div class="txt-light">{{ $kop_surat->kode_pos }}</div>
    //         </td>
    //     </tr>
    //     </table>
    //     <hr class="thick-hr">
    //     </header>
    //     <div class="spacing">&nbsp;</div> <!-- Add some spacing -->
    //     <div class="text-center"><b class="title"><u>S U R A T &nbsp; I J I N</u></b></div>
    //     <div class="text-center">Nomor : 800/515/SMKN.1.Cadisdik WIL.VII</div>
    //     <div class="text-center">Tanggal : 01 November 2023</div>
    // `);

</script>
@endsection
