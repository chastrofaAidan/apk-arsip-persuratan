@extends('partials/sidebar')

@section('Judul')
    <i class="ri-account-circle-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    <h1 style="font-size: 35px; font-weight: bold;">Edit Pegawai</h1>
@endsection

@section('isi')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div>
        <div class="p-4 border-2 border-gray-200 rounded-lg bg-white">
            <div class="p-2">
                <h2 class="text-lg font-poppins font-bold"><span>Edit Pegawai</span></h2>
                <h2 class="text-md font-poppins"><span>Edit Pegawai sesuai dengan ketentuan.</span></h2>
            </div>
            <div class="flex">
                <a href="{{ url()->previous() }}">
                    <button
                        class="bg-white hover:bg-blue-500 text-black hover:text-white transition ease-linear py-1 px-3 border border-black rounded-xl font-poppins font-semibold text-md">
                        <i class="fa-solid fa-caret-left"></i>
                        Kembali
                    </button>
                </a>
            </div>
            <br>
            <form action="{{ route('pegawai.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('PUT')

                <div class="relative flex flex-col shadow-lg mb-6 rounded-lg p-4">
                    <div class="block bg-transparent w-full overflow-x-auto">
                        <span class="font-poppins font-semibold">Pegawai</span>
                        <div class="flex w-full">
                            <div class="mt-3 w-1/2">
                                <div class="w-full flex flex-col rounded-lg border border-solid">
                                    <div class="w-full bg-gray-200 p-2 rounded-t-lg">
                                        <span
                                            class="w-full flex justify-center text-md font-poppins font-semibold text-black">Foto</span>
                                    </div>
                                    <div class="w-full rounded-b-lg h-64 p-2">
                                        <input type="file" name="profile" onchange="loadFile(event)" >
                                        <div class="w-full flex justify-center items-center">
                                            <img class="mt-2 h-48" id="output" src="{{ asset('data_file/' . $user->profile) }}" alt="Preview Gambar">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="ml-2 mt-1 w-1/2">
                                <div class="w-full flex border-solid border rounded-lg mt-2">
                                    <div class="w-4/12 bg-gray-200 p-2 rounded-l-lg">
                                        <span class="text-md font-poppins font-semibold text-black">Nama</span>
                                    </div>
                                    <div class="w-8/12 p-2 rounded-l-lg">
                                        <input class="h-full w-full outline-none font-poppins" type="text" name="name"
                                            placeholder="Masukkan Nama" value="{{ $user->name }}" >
                                    </div>
                                </div>
                                <div class="w-full flex border-solid border rounded-lg mt-2">
                                    <div class="w-4/12 bg-gray-200 p-2 rounded-l-lg">
                                        <span class="text-md font-poppins font-semibold text-black">Email</span>
                                    </div>
                                    <div class="w-8/12 p-2 rounded-l-lg">
                                        <input class="h-full w-full outline-none font-poppins" type="email"
                                            name="email" placeholder="Masukkan Email" value="{{ $user->email }}"
                                            >
                                    </div>
                                </div>
                                <div class="w-full flex border-solid border rounded-lg mt-2">
                                    <div class="w-4/12 bg-gray-200 p-2 rounded-l-lg">
                                        <span class="text-md font-poppins font-semibold text-black">Password</span>
                                    </div>
                                    <div class="w-8/12 p-2 rounded-l-lg">
                                        <input class="h-full w-full outline-none font-poppins" type="password"
                                            name="password" placeholder="Masukkan Password" required>
                                    </div>
                                </div>
                                <div class="w-full flex border-solid border rounded-lg mt-2">
                                    <div class="w-4/12 bg-gray-200 p-2 rounded-l-lg">
                                        <span class="text-md font-poppins font-semibold text-black">Role</span>
                                    </div>
                                    <div class="w-8/12 p-1 rounded-l-lg">
                                        <select class="h-full w-full outline-none font-poppins" name="role" >
                                            <option value="" disabled>Pilih Role</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-3 flex items-end justify-end">
                            <button
                                class="bg-white hover:bg-blue-500 text-black hover:text-white transition ease-linear py-2 px-3 border border-black rounded-xl font-poppins font-semibold text-md"
                                type="submit">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#toggleDrawer').click(function () {
                $('#logo-sidebar').toggleClass(
                    'translate-x-0'); // Mengganti class CSS untuk menggeser drawer
            });
        });

        var loadFile = function (event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</body>

</html>
@endsection