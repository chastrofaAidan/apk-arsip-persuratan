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
        Pembuatan Surat - Perintah
    </h4>

    <form id="myForm" action="{{ route('pembuatanSuratStore') }}" method="post" enctype="multipart/form-data" target="_blank">
    {{ csrf_field() }}
    <div class="container">
        <br>

        <!-- Add this text input for the PDF file name -->
        <div class="row">
        <div class="col-md-12">
            <label for="surat_keluar">Nama Surat</label>
            <input class="custom-input" type="text" name="surat_keluar" id="surat_keluar" placeholder="Tidak Mengandung Spasi / Karakter Spesial" required="required"><br><br>
        </div>
        <!-- <div class="col-12">
            <input type="checkbox" id="showSignature" class="form-check-input" style="transform: scale(1.5);">
            <label for="showSignature">&nbsp; Gunakan Tanda Tangan Digital</label>
        </div> -->
        </div>
        <!-- <div class="row">
            <div class="col-md-6 row">
                <label for="kode_keluar1">Nomor Surat Keluar</label>
                <div class="col-md-4">
                    <select class="custom-input form-select" name="kode_keluar1" id="kode_keluar1" required="required">
                        <option value="" disabled selected>Pilih Kode Surat</option>
                        @foreach($datakodesurat as $ks)
                        <option value="{{ $ks->kode_surat }}">{{ $ks->kode_surat }} / {{ $ks->keterangan_kode_surat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <b>/</b>
                </div>
                <div class="col-md-7">
                    <input class="custom-input" type="text" name="kode_keluar2" id="kode_keluar2" required="required" value="{{ $newNoKeluarValue }}/{{ $kode_surat->kode_surat }}">
                </div>
            </div>
            <div class="col-md-6">
                <label for="tanggal_keluar">Tanggal Pembuatan</label>
                <input class="custom-input" type="date" name="tanggal_keluar" id="tanggal_keluar" required="required" value="{{ now()->toDateString() }}"><br>
            </div>
            <div id="displayedValues" style="text-align: center;">
                <div></div>
                <div></div>
            </div>
        </div> -->

        <div class="container">
            <textarea name="konten" id="konten" class="konten">
            <style>
                /* Additional styles for page breaks and positioning */
                .page-break-before {
                    page-break-before: always;
                }

                .page-break-after {
                    page-break-after: always;
                }

                .table-container {
                    position: relative;
                    margin-bottom: 300px; /* Adjust as needed */
                }

                .footer {
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    text-align: center;
                }

                /* Fixed header for repeating at the beginning of each page */
                .fixed-header {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    text-align: center;
                }
            </style>
            <div class="fixed-header">
                <table style="margin: 0 auto; margin-bottom: 0; width: 100%;" class="center-table page-break-before">
                    <tr>
                        <td width="15%" style="text-align: center;">
                            <img src="{{ $image }}" alt="Kop Surat" style="vertical-align: bottom;" class="kop-surat">
                        </td>
                        <td width="85%" style="text-align: center;">
                            <div style="font-weight: lighter; font-size: 19px;" class="title">PEMERINTAH DAERAH PROVINSI JAWA BARAT</div>
                            <div style="font-weight: lighter; font-size: 19px;" class="title">DINAS PENDIDIKAN</div>
                            <div style="font-weight: lighter; font-size: 19px;" class="title">{{ $kop_surat->lingkup_wilayah }}</div>
                            <div style="font-weight: bolder; font-size: 22px;" class="big">{{ $kop_surat->nama_instansi }}</div>
                            <div style="font-weight: lighter;">{{ $kop_surat->alamat_instansi }}, Telp./Fax. {{ $kop_surat->kontak_instansi }}</div>
                            <div style="font-weight: lighter;">Website : {{ $kop_surat->website_instansi }} - email : <a href="{{ $kop_surat->email_instansi }}">{{ $kop_surat->email_instansi }}</a></div>
                            <div style="font-weight: lighter;">{{ $kop_surat->kode_pos }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr style="border: none; border-top: 4px solid #000; margin: 20px 0;">
                        </td>
                    </tr>
                </table>
            </div>
            <div style="text-align: center;"><b style="font-size: 19px;"><u>S U R A T &nbsp; P E R I N T A H</u></b></div>
            <div id="displayedValues" style="text-align: center;">
                <div>Nomor : (kode-surat)/{{ $newNoKeluarValue }}/{{ $kode_surat->kode_surat }}</div>
            </div>
            <div></div>
            

            <table style="width: 100%; position: absolute; bottom: 300px; left: 0; right: 0; text-align: center;" class="footer page-break-after">
                <tr>
                    <td style="width: 55%;"></td>
                    <td style="width: 45%;">
                        <div style="position: relative;">
                            <div id="signatureContainer" style="position: absolute; top: 0; left: 0; z-index: 3; text-align: left;">
                                <br>
                                <img src="{{ $tanda_tangan }}" alt="ttd">
                            </div>
                            <div style="position: absolute; top: 0; left: 0; z-index: 2; text-align: left;">
                                <div style="font-weight: lighter; font-size: 19px;" class="title">K E P A L A</div>
                                <br><br><br><br><br>
                                <b>{{ $kepala_sekolah->nama_kepala_sekolah }}</b><br>
                                {{$kepala_sekolah->golongan_kepala_sekolah}} <br>
                                NIP. {{$kepala_sekolah->nip_kepala_sekolah}} <br>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>    
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    tinymce.init({
        selector: 'textarea.konten',
        height: 1250,
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




    // jQuery script to update displayed values
    $(document).ready(function () {
        // Function to update displayed values
        function updateDisplayedValues() {
            // Get values from inputs
            var kodeSurat = $('#kode_keluar1').val() + '/' + $('#kode_keluar2').val();
            var tanggalSurat = $('#tanggal_keluar').val();

            // Update the displayed values with placeholders if inputs are empty
            $('#displayedValues div:nth-child(1)').text('Nomor : ' + (kodeSurat || '---'));
            $('#displayedValues div:nth-child(2)').text('Tanggal : ' + (tanggalSurat || '---'));
        }

        // Listen for changes in the select and input fields
        $('#kode_keluar1, #kode_keluar2, #tanggal_keluar').on('input', function () {
            // Update the displayed values
            updateDisplayedValues();
        });

        // Initial update to handle default values
        updateDisplayedValues();
    });






    // jQuery script for input validation
    $(document).ready(function () {
        // Listen for changes in the input field
        $('#surat_keluar').on('input', function () {
            // Get the current value of the input
            var inputValue = $(this).val();

            // Remove spaces and special characters
            var sanitizedValue = inputValue.replace(/[^a-zA-Z0-9_-]/g, '');

            // Update the input value with the sanitized value
            $(this).val(sanitizedValue);
        });
    });





        // $(document).ready(function () {
    // // Function to update displayed values
    //     function updateDisplayedValues() {
    //         var kodeSurat = $('#kode_keluar1').val() + '/' + $('#kode_keluar2').val();
    //         var tanggalSurat = $('#tanggal_keluar').val();

    //         $('#displayedValues div:nth-child(1)').text('Nomor : ' + (kodeSurat || '---'));
    //         $('#displayedValues div:nth-child(2)').text('Tanggal : ' + (tanggalSurat || '---'));
    //     }

    //     // Function to toggle signature visibility
    //     function toggleSignatureVisibility() {
    //         var showSignature = $('#showSignature').prop('checked');
    //         $('#signatureContainer').toggle(showSignature);
    //     }

    //     // Listen for changes in the select and input fields
    //     $('#kode_keluar1, #kode_keluar2, #tanggal_keluar').on('input', function () {
    //         updateDisplayedValues();
    //     });

    //     // Listen for changes in the checkbox
    //     $('#showSignature').on('change', function () {
    //         toggleSignatureVisibility();
    //     });

    //     // Initial update to handle default values
    //     updateDisplayedValues();
    //     // Initial toggle to handle default checkbox state
    //     toggleSignatureVisibility();

    //     // Add input validation for the 'surat_keluar' field
    //     $('#surat_keluar').on('input', function () {
    //         var inputValue = $(this).val();
    //         var sanitizedValue = inputValue.replace(/[^a-zA-Z0-9_-]/g, '');
    //         $(this).val(sanitizedValue);
    //     });

    //     // Add a listener to the button click event
    //     $('#generatePdfBtn').on('click', function (event) {
    //         event.preventDefault();
    //         var konten = tinymce.activeEditor.getContent();
    //         $('#hiddenContent').val(konten);
    //         $('#myForm').submit();
    //     });
    // });


</script>
@endsection



