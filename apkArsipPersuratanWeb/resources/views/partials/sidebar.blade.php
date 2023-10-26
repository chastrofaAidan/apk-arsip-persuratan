<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- CSS -->
    <link href="{{ asset('css/sidebar_style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Archie</title>
    <style>
        
        
        .kepala {
            background-color: #9A4444;
        }

        .navigasi {
            color: white;
            padding: 3vh;
            height: 15vh;
            display: flex;
            justify-content: space-between; /* Align items at the top */
            align-items: flex-start; /* Align items at the top */
        }


        .left-container {
            display: block;
        }

        .left-container h6, .left-container h5 {
            float: left;
            clear: left;
            width: 100%;
        }

        .konten{
            /* width: 75%; */
            margin: 0vh 5vh;
            position: absolute;
            z-index: 1; /* Higher z-index to make it overlay */
            top: 11vh; /* Adjust this value to control the overlay height */
        }
        
        .px-3.py-2.bg-white.rounded.shadow {
            padding: 10rem;
        }

    </style>
</head>

<body>

    <!-- Sidebar -->
    @if (Auth::user()->role == 'superadmin')
    <div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
        <div class="d-flex align-items-center p-3">
            <a href="#" class="sidebar-logo">
                <img src="{{ asset('images/logo_archie.png') }}" alt="Error" width="120">
            </a>
            <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
        </div>
        <ul class="sidebar-menu p-3 m-0 mb-0">
            <li class="sidebar-menu-item active">
                <a href="#">
                    <i class="ri-dashboard-line sidebar-menu-item-icon"></i>
                    Dashboard
                </a>
            </li>

            <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Arsip</li>
            <li class="sidebar-menu-item has-dropdown">
                <a href="{{ route('masuk') }}">
                    <i class="ri-mail-unread-line sidebar-menu-item-icon"></i>
                    Surat Masuk
                    <i class="ri-arrow-down-s-line sidebar-menu-item-accordion ms-auto"></i>
                </a>
                <ul class="sidebar-dropdown-menu">
                    <li class="sidebar-dropdown-menu-item">
                        <a href="{{ route('masuk') }}">
                            Terbaru
                        </a>
                    </li>
                    <li class="sidebar-dropdown-menu-item">
                        <a href="{{ route('masuk') }}">
                            Terlama
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-menu-item has-dropdown">
              <a href="{{ route('keluar') }}">
                  <i class="ri-mail-send-line sidebar-menu-item-icon"></i>
                  Surat Keluar
                  <i class="ri-arrow-down-s-line sidebar-menu-item-accordion ms-auto"></i>
              </a>
              <ul class="sidebar-dropdown-menu">
                  <li class="sidebar-dropdown-menu-item">
                      <a href="#">
                          Terbaru
                      </a>
                  </li>
                  <li class="sidebar-dropdown-menu-item">
                      <a href="#">
                          Terlama
                      </a>
                  </li>
              </ul>
          </li>
          <li class="sidebar-menu-item has-dropdown">
            <a href="/arsip">
                <i class="ri-archive-2-line sidebar-menu-item-icon"></i>
                Surat Arsip
                <i class="ri-arrow-down-s-line sidebar-menu-item-accordion ms-auto"></i>
            </a>
            <ul class="sidebar-dropdown-menu">
                <li class="sidebar-dropdown-menu-item">
                    <a href="/arsip">
                        Terbaru
                    </a>
                </li>
                <li class="sidebar-dropdown-menu-item">
                    <a href="/arsip">
                        Terlama
                    </a>
                </li>
            </ul>
        </li>
            <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Tools</li>
            <li class="sidebar-menu-item">
                <a href="https://www.youtube.com/watch?v=Vnx-oCyocxA">
                    <i class="ri-mail-add-line sidebar-menu-item-icon"></i>
                    Pembuatan Surat
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="/arsip/tambah">
                    <i class="ri-inbox-unarchive-line sidebar-menu-item-icon"></i>
                    Pengarsipan Surat
                </a>
            </li>
            <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Option</li>
            <li class="sidebar-menu-item">
                <a href="#">
                    <i class="ri-account-circle-line sidebar-menu-item-icon"></i>
                    Profile
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="#">
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
            <a href="#" class="sidebar-logo">
                <img src="{{ asset('images/logo_archie.png') }}" alt="Error" width="120">
            </a>
            <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
        </div>
        <ul class="sidebar-menu p-3 m-0 mb-0">
            <li class="sidebar-menu-item active">
                <a href="#">
                    <i class="ri-dashboard-line sidebar-menu-item-icon"></i>
                    Dashboard
                </a>
            </li>

            <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Arsip</li>
            <li class="sidebar-menu-item has-dropdown">
                <a href="{{ route('masuk') }}">
                    <i class="ri-mail-unread-line sidebar-menu-item-icon"></i>
                    Surat Masuk
                    <i class="ri-arrow-down-s-line sidebar-menu-item-accordion ms-auto"></i>
                </a>
                <ul class="sidebar-dropdown-menu">
                    <li class="sidebar-dropdown-menu-item">
                        <a href="#">
                            Terbaru
                        </a>
                    </li>
                    <li class="sidebar-dropdown-menu-item">
                        <a href="#">
                            Terlama
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-menu-item has-dropdown">
              <a href="{{ route('keluar') }}">
                  <i class="ri-mail-send-line sidebar-menu-item-icon"></i>
                  Surat Keluar
                  <i class="ri-arrow-down-s-line sidebar-menu-item-accordion ms-auto"></i>
              </a>
              <ul class="sidebar-dropdown-menu">
                  <li class="sidebar-dropdown-menu-item">
                      <a href="#">
                          Terbaru
                      </a>
                  </li>
                  <li class="sidebar-dropdown-menu-item">
                      <a href="#">
                          Terlama
                      </a>
                  </li>
              </ul>
          </li>
          <li class="sidebar-menu-item has-dropdown">
           
            <ul class="sidebar-dropdown-menu">
                <li class="sidebar-dropdown-menu-item">
                    <a href="#">
                        Terbaru
                    </a>
                </li>
                <li class="sidebar-dropdown-menu-item">
                    <a href="#">
                        Terlama
                    </a>
                </li>
            </ul>
        </li>
            <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Option</li>
            <li class="sidebar-menu-item">
                <a href="#">
                    <i class="ri-account-circle-line sidebar-menu-item-icon"></i>
                    Profile
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="#">
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
    @endif













    <div class="sidebar-overlay"></div>
    <!-- Main -->
    <main>
        <div class="kepala p-2">
            <!-- Navbar -->
            <nav class="navigasi">
                <div class="left-container">
                    <h6 class="mb-0 me-auto">SMK Negeri 1 Cimahi</h6>
                    <h4 class="fw-bold mb-0 me-auto">Surat & Arsip Tata Usaha</h4>
                </div>

                <div class="dropdown me-3 ms-auto">
                    <div class="cursor-pointer dropdown-toggle navbar-link" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-notification-line"></i>
                    </div>
                    <div class="dropdown-menu fx-dropdown-menu">
                        <h5 class="p-3 bg-indigo text-light">Notification</h5>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-semibold">Subheading</div>
                                    <span class="fs-7">Content for list item</span>
                                </div>
                                <span class="badge bg-primary rounded-pill">14</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-semibold">Subheading</div>
                                    <span class="fs-7">Content for list item</span>
                                </div>
                                <span class="badge bg-primary rounded-pill">14</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-semibold">Subheading</div>
                                    <span class="fs-7">Content for list item</span>
                                </div>
                                <span class="badge bg-primary rounded-pill">14</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-semibold">Subheading</div>
                                    <span class="fs-7">Content for list item</span>
                                </div>
                                <span class="badge bg-primary rounded-pill">14</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-semibold">Subheading</div>
                                    <span class="fs-7">Content for list item</span>
                                </div>
                                <span class="badge bg-primary rounded-pill">14</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    <div class="d-flex align-items-center cursor-pointer dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-2 d-none d-sm-block">Luna Maya</span>
                        <img class="navbar-profile-image" src="6rs6duyf" alt="Image">
                    </div>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="konten p-2">
            <div class="px-3 py-2 bg-white rounded shadow">
                <h1 class="fw-bold">
                    @yield('Judul')
                    <br>
                </h1>
            </div>
            <br>
            @yield('isi')
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </main>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/sidebar_script.js') }}"></script>
</body>

</html>
