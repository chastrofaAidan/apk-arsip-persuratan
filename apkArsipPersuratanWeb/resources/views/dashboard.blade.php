@extends('partials/sidebar')

<style>
    .dashboard{
        padding: 5vh;
    }

    .custom-button {
        background-color: #9A4444;
        color: #fff; /* Text color */
        padding: 10px 20px; /* Adjust padding as needed */
        border-radius: 5px; /* Rounded corners */
    }

    .superadmin.box-jumlah{
        padding: 2vh 2vh;
    }
    
    .admin.box-jumlah{
        padding: 2vh 25vh;
    }
    
    .superadmin .jumlah{
        background-color: #9A4444;
        color: #fff; /* Text color */
        text-align: center;
        width: 2vh 0;
        margin: 0 5vh;
        padding: 10px 20px; /* Adjust padding as needed */
        border-radius: 10px; /* Rounded corners */
    }
    .admin .jumlah{
        background-color: #9A4444;
        color: #fff; /* Text color */
        text-align: center;
        width: 2vh 0;
        margin: 0 5vh;
        padding: 10px 20px; /* Adjust padding as needed */
        border-radius: 10px; /* Rounded corners */
    }
</style>

@section('Judul')
<i class="ri-dashboard-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Dashboard
@endsection

@section('isi')
<div class="px-3 py-2 bg-white rounded shadow">
    <div class="dashboard">
        <h3>Selamat Datang, Luna Maya</h3>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aut, quis inventore totam iste tempora doloribus? Necessitatibus incidunt, quia veritatis culpa facilis nihil, iste ea eveniet soluta reprehenderit, laboriosam tempore aliquam.
        <br>
        <br>
        
        @if (Auth::user()->role == 'superadmin')
        <div class="container">
            <div class="row">
                <div class="col-4 text-center">
                    <a href="{{ route('masuk') }}">
                        <button class="custom-button">
                            <i class="ri-mail-unread-line sidebar-menu-item-icon"></i>
                            <span>Surat Masuk</span>
                        </button>
                    </a>
                </div>
                <div class="col-4 text-center">
                    <a href="{{ route('keluar') }}">
                        <button class="custom-button">
                            <i class="ri-mail-send-line sidebar-menu-item-icon"></i>
                            <span>Surat Keluar</span>
                        </button>
                    </a>
                </div>
                <div class="col-4 text-center">
                    <a href="/surat_arsip">
                        <button class="custom-button">
                            <i class="ri-archive-2-line sidebar-menu-item-icon"></i>
                            <span>Surat Arsip</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>



        @elseif (Auth::user()->role == 'admin')
        <div class="container">
            <div class="row">
                <div class="col-6 text-center">
                    <a href="/surat_masuk">
                        <button class="custom-button">
                            <i class="ri-mail-unread-line sidebar-menu-item-icon"></i>
                            <span>Surat Masuk</span>
                        </button>
                    </a>
                </div>
                <div class="col-6 text-center">
                    <a href="/surat_keluar">
                        <button class="custom-button">
                            <i class="ri-mail-send-line sidebar-menu-item-icon"></i>
                            <span>Surat Keluar</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
<br>
@if (Auth::user()->role == 'superadmin')
<div class="container">
    <div class="superadmin box-jumlah row">
    <div class="col-md-4 container">
        <div class="jumlah row">
            <div class="col-md-4">
                <i class="ri-mail-unread-line sidebar-menu-item-icon" style="font-size: 65px;"></i>
            </div>
            <div class="col-md-8">
                <h6>Surat Masuk</h6>
                <h1>{{ $masuk }}</h1>
            </div>
        </div>
        </div>
        
        <div class="col-md-4 container">
        <div class="jumlah row">
            <div class="col-md-4">
                <i class="ri-mail-send-line sidebar-menu-item-icon" style="font-size: 65px;"></i>
            </div>
            <div class="col-md-8">
                <h6>Surat Keluar</h6>
                <h1>{{ $keluar }}</h1>
            </div>
        </div>
        </div>

        <div class="col-md-4 container">
        <div class="jumlah row">
            <div class="col-md-4">
                <i class="ri-archive-2-line sidebar-menu-item-icon" style="font-size: 65px;"></i>
            </div>
            <div class="col-md-8">
                <h6>Surat Arsip</h6>
                <h1>{{ $arsip }}</h1>
            </div>
        </div>
        </div>
</div>
@elseif (Auth::user()->role == 'admin')
<div class="container">
    <div class="admin box-jumlah row">
        <div class="col-md-6 container">
        <div class="jumlah row">
            <div class="col-md-4">
                <i class="ri-mail-unread-line sidebar-menu-item-icon" style="font-size: 65px;"></i>
            </div>
            <div class="col-md-8">
                <h6>Surat Masuk</h6>
                <h1>{{ $masuk }}</h1>
            </div>
        </div>
        </div>
        
        <div class="col-md-6 container">
        <div class="jumlah row">
            <div class="col-md-4">
                <i class="ri-mail-send-line sidebar-menu-item-icon" style="font-size: 65px;"></i>
            </div>
            <div class="col-md-8">
                <h6>Surat Keluar</h6>
                <h1>{{ $keluar }}</h1>
            </div>
        </div>
        </div>
    </div>
@endif
@endsection