@extends('partials/sidebar')

<style>
    .text-left {
        text-align: left;
    }

    @media screen and (max-width: 685px) {
        .col-md {
            display: flex;
            flex-direction: column;
        }

        .col-md a {
            margin-bottom: 7px;
        }
    }

    .dashboard {
        padding: 5vh;
    }

    .custom-button {
        background-color: #9A4444;
        color: #fff;
        /* Text color */
        padding: 8px 20px;
        /* Adjust padding as needed */
        border-radius: 10px;
        /* Rounded corners */
        border: 2px solid white;
    }

    .superadmin.box-jumlah {
        padding: 2vh 2vh;
    }

    .admin.box-jumlah {
        padding: 2vh 25vh;
    }

    .superadmin .jumlah {
        background-color: #fff;
        color: #fff;
        /* Text color */
        text-align: center;
        width: 2vh 0;
        margin: 0 5vh;
        padding: 10px 20px;
        /* Adjust padding as needed */
        border-radius: 10px;
        /* Rounded corners */

    }

    .admin .jumlah {
        background-color: #9A4444;
        color: #fff;
        /* Text color */
        text-align: center;
        width: 2vh 0;
        margin: 0 5vh;
        padding: 10px 20px;
        /* Adjust padding as needed */
        border-radius: 10px;
        /* Rounded corners */
    }
</style>

@section('Judul')
    <i class="ri-dashboard-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Dashboard
@endsection

@section('isi')
<div class="px-3 py-2 rounded shadow" style="background: #9A4444; color:#fff;">
<div class="dashboard">
    <h3>Selamat Datang, {{ $user->name }}</h3>
    ARCHIE - Untuk Segala Kebutuhan Persuratan Anda ^^
    <br>
    SMK Negeri 1 Cimahi (STM Pembangunan Bandung) merupakan salah satu Lembaga Pendidikan Menengah Kejuruan di Kota Cimahi, Jawa Barat yang menyelenggarakan Program Pendidikan Kejuruan 4 Tahun, dan merupakan salah satu SMK dari 8 (delapan) SMK Negeri di Indonesia yang memiliki program 4 (empat) Tahun.
    <br>
    <br>
    <div>
        <div>
            <div class="col-md py-2">
                <a href="{{ route('masuk') }}" style="margin-right: 5px;">
                    <button class="custom-button">
                        <i class="ri-mail-unread-line sidebar-menu-item-icon"></i>
                        <span>Surat Masuk</span>
                    </button>
                </a>
                <a href="{{ route('keluar') }}" style="margin-right: 5px;">
                    <button class="custom-button">
                        <i class="ri-mail-send-line sidebar-menu-item-icon"></i>
                        <span>Surat Keluar</span>
                    </button>
                </a>
                <a href="/surat_arsip">
                    <button class="custom-button" style="margin-right: 5px;">
                        <i class="ri-archive-2-line sidebar-menu-item-icon"></i>
                        <span>Surat Arsip</span>
                        <span style="color: #9A4444">.</span>
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
</div>
<br>
<div class="containers text-center" style="overflow: hidden; padding-bottom: 10px;">
<div class="row">
    <div class="col-md" style="margin-bottom: 10px;">
        <div class="container px-3 py-2 bg-white rounded shadow ">
            <div class="jumlah row">
                <div class="col-md-4">
                    <i class="ri-mail-unread-line sidebar-menu-item-icon"
                        style="font-size: 65px; color: #9A4444;"></i>
                </div>
                <div class="col-md-8 text-left">
                    <h6 style="color: black; margin-top:20px;">Surat Masuk</h6>
                    <h4 style="color: black;">{{ $masuk }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md" style="margin-bottom: 10px">
        <div class="container px-3 py-2 bg-white rounded shadow ">
            <div class="jumlah row">
                <div class="col-md-4">
                    <i class="ri-mail-send-line sidebar-menu-item-icon"
                        style="font-size: 65px; color: #9A4444;"></i>
                </div>
                <div class="col-md-8 text-left">
                    <h6 style="color: black; margin-top:20px;">Surat Keluar</h6>
                    <h4 style="color: black;">{{ $keluar }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md">
        <div class="container px-3 py-2 bg-white rounded shadow ">
            <div class="jumlah row">
                <div class="col-md-4">
                    <i class="ri-archive-2-line sidebar-menu-item-icon"
                        style="font-size: 65px; color: #9A4444;"></i>
                </div>
                <div class="col-md-8 text-left">
                    <h6 style="color: black; margin-top:20px;">Surat Arsip</h6>
                    <h4 style="color: black;">{{ $arsip }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
