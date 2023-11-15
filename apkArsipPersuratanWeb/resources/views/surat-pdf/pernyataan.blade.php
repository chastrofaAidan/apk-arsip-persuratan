<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- CSS -->
    <link href="{{ asset('css/sidebar_style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Archie - Surat Pernyataan</title>
    <style>
    @page {
        size: a4 portrait;
    }

    .page-break {
    page-break-after: always;
    }

    header {
        display: table-header-group;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        display: block;
        font-size: 14px;
        font-weight: bolder;
        border-radius: 5px;
        height: 100px;
    }

    .center-table {
        margin: 0 auto;
        margin-bottom: 0;
    }

    td.align-bottom {
        vertical-align: bottom;
    }


    .text-center {
        text-align: center;
    }

    .text-left {
        text-align: left;
    }

    .txt-light{
        font-weight: lighter; /* or use numeric values like 100 or 200 */
    }
    
    .txt-bold{
        font-weight: bolder; /* or use numeric values like 100 or 200 */
    }

    .title{
        font-size:19px;
    }

    .big{
        font-size:22px;
    }


    body {
        font-family: 'Arial', sans-serif; /* Change 'Arial' to an available font for Dompdf */
    }

    .spacing{
        height: 200px;
    }

    .thick-hr {
        border: none; /* Remove the default border */
        border-top: 4px solid #000; /* Set the thickness (4px) and color (#000) of the top border */
        margin: 20px 0; /* Add some spacing for better visual separation */
    }

    .footer {
        position: absolute;
        bottom: 300px;
        left: 0;
        right: 0;
        text-align: center;
    }

</style>

</head>
<body>
<header>
<table class="center-table">
<tr>
    <td width=20%>
        <img src="{{ $image }}" alt="Kop Surat" class="kop-surat align-bottom">
    </td>
    <td width=80% class="text-center">
        <div class="txt-light title">PEMERINTAH DAERAH PROVINSI JAWA BARAT</div>
        <div class="txt-light title">DINAS PENDIDIKAN</div>
        <div class="txt-light title">CABANG DINAS PENDIDIKAN WILAYAH VII</div>
        <div class="txt-bold big">SEKOLAH MENENGAH KEJURUAN NEGERI 1 CIMAHI</div>
        <div class="txt-light">Jalan Mahar Martanegara No.48 Leuwigajah, Telp./Fax. (022) 6629683</div>
        <div class="txt-light">Website : http://www.smkn1-cmi.sch.id - email : <a href="info@smkn1-cmi.sch.id">info@smkn1-cmi.sch.id</a></div>
        <div class="txt-light">Kota Cimahi - 40533</div>
    </td>
</tr>
</table>
<hr class="thick-hr">
</header>
<div class="spacing">&nbsp;</div> <!-- Add some spacing -->
<div class="text-center"><b class="title"><u>S U R A T &nbsp; P E R N Y A T A A N</u></b></div>
<div class="text-center">Nomor : 800/268/SMKN.1.Cadisdik WIL.VII</div>
<div class="text-center">Tanggal : 20 Juni 2023</div>

<!-- <div class="page-break"></div>
<div class="page-break"></div>
<div class="page-break"></div> -->


<table class="footer" style="width: 100%;">
<tr>
    <td style="width: 55%;"></td>
    <td style="width: 45%;">
        <div class="txt-light text-left">
            <div class="txt-light title">K E P A L A</div>
            <br><br><br>
            <b>Agus Priyatmono Nugroho,S.Pd.M.Si</b><br>
            Pembina Tk.1 <br>
            NIP. 196708311990031003 <br>
        </div>
    </td>
</tr>
</table>
</body>
</html>