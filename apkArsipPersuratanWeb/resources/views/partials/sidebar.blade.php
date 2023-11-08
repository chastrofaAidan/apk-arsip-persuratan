<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Icons -->
    <link rel="icon" href="data_file/Logo-SMKN1-Cimahi.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- CSS -->
    <link href="{{ asset('css/sidebar_style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://unpkg.com/chart.js"></script>
    <title>Archie</title>
    @yield('css')
    <style>
        /* body{
            background-color: var(--bs-color4);
        } */
        
        .kepala {
            background-color: #9A4444;
        }

        .navigasi {
            color: white;
            padding: 3vh;
            height: 11vh;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .left-container {
            display: block;
        }

        .left-container h6,
        .left-container h5 {
            float: left;
            clear: left;
            width: 100%;
        }

        
        .konten {
            max-width: 100%; /* Set the maximum width to 100% of the screen width */
            overflow-x: auto; /* Add horizontal scrollbar if needed */
            margin: 0 2vh; /* Center align the content horizontally */
            z-index: 1;
            top: 8vh; /* Adjust this value to control the overlay height */
        }

        th{
            background-color: var(--bs-color1);
        }

        /* .sidebar-minimized {
            width: 60px; Adjust to your desired width
        }

        .content-minimized {
            width: calc(100% - 60px);
        } */

    </style>
</head>

<body>

    <!-- Sidebar -->
    @if (Auth::user()->role == 'superadmin')
    <div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
        <div class="d-flex align-items-center p-3">
            <a href="/" class="sidebar-logo">
                <img src="{{ asset('images/logo_archie.png') }}" alt="Error" width="120">
            </a>
            <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
        </div>
        <ul class="sidebar-menu p-3 m-0 mb-0">
            <li class="sidebar-menu-item" id="dashboard">
                <a href="/">
                    <i class="ri-dashboard-line sidebar-menu-item-icon"></i>
                    Dashboard
                </a>
            </li>

            <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Arsip</li>
            <li class="sidebar-menu-item" id="surat_masuk">
                <a href="/surat_masuk">
                    <i class="ri-mail-unread-line sidebar-menu-item-icon"></i>
                    Surat Masuk
                </a>
            </li>
            <li class="sidebar-menu-item" id="surat_keluar">
              <a href="/surat_keluar">
                  <i class="ri-mail-send-line sidebar-menu-item-icon"></i>
                  Surat Keluar
              </a>
          </li>
          <li class="sidebar-menu-item" id="surat_arsip">
            <a href="/surat_arsip">
                <i class="ri-archive-2-line sidebar-menu-item-icon"></i>
                Surat Arsip
            </a>
        </li>
            <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Tools</li>
            <li class="sidebar-menu-item" id="pembuatan_surat">
                <a href="/pembuatan_surat_ijin">
                    <i class="ri-mail-add-line sidebar-menu-item-icon"></i>
                    Pembuatan Surat
                </a>
            </li>
            <li class="sidebar-menu-item" id="pengarsipan_surat">
                <a href="/pengarsipan_surat">
                    <i class="ri-inbox-unarchive-line sidebar-menu-item-icon"></i>
                    Pengarsipan Surat
                </a>
            </li>
            <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Option</li>
            <li class="sidebar-menu-item" id="profile">
                <a href="/profile">
                    <i class="ri-account-circle-line sidebar-menu-item-icon"></i>
                    Profile
                </a>
            </li>
            <li class="sidebar-menu-item" id="settings">
                <a href="/settings">
                    <i class="ri-settings-line sidebar-menu-item-icon"></i>
                    Settings
                </a>
            </li>
            <li class="sidebar-menu-item">
              <a href="/logout">
                  <i class="ri-logout-box-line sidebar-menu-item-icon"></i>
                  Logout
              </a>
          </li>
        </ul>
    </div>

    @elseif (Auth::user()->role == 'admin')

    <div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
        <div class="d-flex align-items-center p-3">
            <a href="/" class="sidebar-logo">
                <img src="{{ asset('images/logo_archie.png') }}" alt="Error" width="120">
            </a>
            <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
        </div>
        <ul class="sidebar-menu p-3 m-0 mb-0">
            <li class="sidebar-menu-item" id="dashboard">
                <a href="/">
                    <i class="ri-dashboard-line sidebar-menu-item-icon"></i>
                    Dashboard
                </a>
            </li>

            <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Arsip</li>
            <li class="sidebar-menu-item" id="surat_masuk">
                <a href="/surat_masuk">
                    <i class="ri-mail-unread-line sidebar-menu-item-icon"></i>
                    Surat Masuk
                </a>
            </li>
            <li class="sidebar-menu-item" id="surat_keluar">
              <a href="/surat_keluar">
                  <i class="ri-mail-send-line sidebar-menu-item-icon"></i>
                  Surat Keluar
              </a>
          </li>
            <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Option</li>
            <li class="sidebar-menu-item" id="profile">
                <a href="/profile">
                    <i class="ri-account-circle-line sidebar-menu-item-icon"></i>
                    Profile
                </a>
            </li>
            <!-- <li class="sidebar-menu-item" id="setting">
                <a href="/settings">
                    <i class="ri-settings-line sidebar-menu-item-icon"></i>
                    Settings
                </a>
            </li> -->
            <li class="sidebar-menu-item">
              <a href="/logout">
                  <i class="ri-logout-box-line sidebar-menu-item-icon"></i>
                  Logout
              </a>
          </li>
        </ul>
    </div>
    
    @endif













    <div class="sidebar-overlay wrapper d-flex flex-column"></div>
    <!-- Main -->
    <main>
        <div class="kepala p-2 flex-grow-1">
            <!-- Navbar -->
            <nav class="navigasi">
                <div class="left-container">
                    <h6 class="mb-0 me-auto">SMK Negeri 1 Cimahi</h6>
                    <h4 class="fw-bold mb-0 me-auto">Surat & Arsip Tata Usaha</h4>
                </div>
                <a href="/profile" style="text-decoration: none; cursor: default;">
                    <div class="d-flex align-items-center cursor-pointer">
                        <span class="me-2 d-none d-sm-block no-link" >{{$user->name}}</span>

                        <img class="navbar-profile-image" src="data_file/{{$user->profile}}" alt="Image">
                    </div>
                </a>

            </nav>
        </div>
        <div class="konten p-2">
            <div class="px-3 py-2 bg-white rounded shadow" >
                <h1 class="fw-bold">
                    @yield('Judul')
                    <br>
                </h1>
            </div>
            <br>
            @yield('isi')
        </div>
        <hr>
        <footer class="p-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-4" style="text-align: center;">Copyright @ 2023</div>
                            <div class="col-md-4" style="text-align: center;">Powered by Laravel and MySQL</div>
                            <div class="col-md-4" style="text-align: center;">Brought to you by Darva & Aidan</div>
                        </div>
                    </div>
                    <div class="col-md-2" style="text-align: right;">
                        Versi 1.0.0
                    </div>
                </div>
                <br>
            </div>
        </footer>
    </main>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('js/sidebar_script.js') }}"></script>
</body>

</html>

@yield('js')
<script>
    $(document).ready(function () {
        // Get the current URL path
        var currentPath = window.location.pathname;
        
        // Define the URL of the link you want to check
        var dashboard = '/dashboard';
        var surat_masuk1 = '/surat_masuk';
        var surat_masuk2 = '/surat_masuk/edit';
        var surat_keluar1 = '/surat_keluar';
        var surat_keluar2 = '/surat_keluar/edit';
        var surat_arsip1 = '/surat_arsip';
        var surat_arsip2 = '/surat_arsip/edit';
        var pembuatan_surat1 = '/pembuatan_surat_ijin';
        var pembuatan_surat2 = '/pembuatan_surat_pengantar';
        var pembuatan_surat3 = '/pembuatan_surat_perintah';
        var pembuatan_surat4 = '/pembuatan_surat_pernyataan';
        var pengarsipan_surat = '/pengarsipan_surat';
        var profile = '/profile';
        var settings = '/settings';
        
    
        // Check if the current URL matches the link's URL
        if (currentPath === dashboard) 
        {
            // Add the "active" class to the list item
            $("#dashboard").addClass("active");
        } 

        else if (currentPath === surat_masuk1) 
        {
            // Add the "active" class to the list item
            $("#surat_masuk").addClass("active");
        }
        else if (currentPath === surat_masuk2) 
        {
            // Add the "active" class to the list item
            $("#surat_masuk").addClass("active");
        }

        else if (currentPath === surat_keluar1) 
        {
            // Add the "active" class to the list item
            $("#surat_keluar").addClass("active");
        }
        else if (currentPath === surat_keluar2) 
        {
            // Add the "active" class to the list item
            $("#surat_keluar").addClass("active");
        }

        else if (currentPath === surat_arsip1) 
        {
            // Add the "active" class to the list item
            $("#surat_arsip").addClass("active");
        }
        else if (currentPath === surat_arsip2) 
        {
            // Add the "active" class to the list item
            $("#surat_arsip").addClass("active");
        }

        else if (currentPath === pembuatan_surat1) 
        {
            // Add the "active" class to the list item
            $("#pembuatan_surat").addClass("active");
        }
        else if (currentPath === pembuatan_surat2) 
        {
            // Add the "active" class to the list item
            $("#pembuatan_surat").addClass("active");
        }
        else if (currentPath === pembuatan_surat3) 
        {
            // Add the "active" class to the list item
            $("#pembuatan_surat").addClass("active");
        }
        else if (currentPath === pembuatan_surat4) 
        {
            // Add the "active" class to the list item
            $("#pembuatan_surat").addClass("active");
        }
        
        else if (currentPath === pengarsipan_surat) 
        {
            // Add the "active" class to the list item
            $("#pengarsipan_surat").addClass("active");
        }
        else if (currentPath === profile) 
        {
            // Add the "active" class to the list item
            $("#profile").addClass("active");
        }
        else if (currentPath === settings) 
        {
            // Add the "active" class to the list item
            $("#settings").addClass("active");
        }
    });


    $(document).ready(function () {
        // Sidebar toggle button click event
        $(".sidebar-toggle").click(function () {
            $(".sidebar").toggleClass("sidebar-minimized");
            $(".konten").toggleClass("content-minimized");
        });
    });
</script>
