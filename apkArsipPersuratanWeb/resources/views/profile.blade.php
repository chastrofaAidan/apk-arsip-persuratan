@extends('partials/sidebar')

@section('css')
<style>
    .custom-input {
        width: 100%; /* Make the input element span the full width of its parent */
        background-color: #dedede; /* Set the background color to gray */
        border: none; /* Remove the default input border */
        padding: 10px; /* Add padding to style the input */
        color: black; /* Set text color to contrast with the gray background */
        border-radius: 1vh;
    }
</style>
@endsection

@section('Judul')
<i class="ri-account-circle-line sidebar-menu-item-icon" style="font-size: 40px;"></i>
    Profile
@endsection

@section('isi')
<div class="px-3 py-2 bg-white rounded shadow">
    <h4 class="fw-bold">
        <i class="ri-account-circle-line sidebar-menu-item-icon" style="font-size: 20px;"></i>
        Profile
    </h4>

    
<form action="/user/update" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <label for="name">Nama User</label>
                <input class="custom-input" type="text" name="name" id="name" required="required" size="50" value="{{ $user->name }}"><br>
            </div>
            <div class="col-md-6">
                <label for="kode_surat">User Email</label>
                <input class="custom-input" type="text" name="kode_surat" id="kode_surat" required="required" value="{{ $user->email }}">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <label for="kode_surat">New User Password</label>
                <input class="custom-input" type="password" name="kode_surat" id="kode_surat" oninput="checkPassword()">
            </div>
        </div>
        <div class="row" id="verifyPasswordDiv" style="display: none;">
            <div class="col-md-12">
                <label for="verify_kode_surat">Verify New Password</label>
                <input class="custom-input" type="password" name="verify_kode_surat" id="verify_kode_surat">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-8">
                <label for="profile">Photo Profile</label>
                <input class="custom-input" type="file" name="profile" id="profile" accept=".png, .jpeg, .jpg" required="required" onchange="previewImage()"><br>
                <label for="profile">Previous File: {{ $user->profile }}</label><br>
            </div>
            <!-- <div class="col-md-4">
                <img class="img-preview img-fluid" alt="Profile" width="100">
            </div> -->
        </div>
        
    </div>
    <br>
    <input class="btn btn-primary" type="submit" value="Simpan Data">
</form>

</br>
@endsection

@section('js')
<script>
    function checkPassword() {
        const newPasswordInput = document.getElementById('kode_surat');
        const verifyPasswordDiv = document.getElementById('verifyPasswordDiv');

        if (newPasswordInput.value) {
            verifyPasswordDiv.style.display = 'block';
        } else {
            verifyPasswordDiv.style.display = 'none';
        }
    }
    /* function previewImage(){
        const image = document.querySelector('#profile');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    } */
</script>
@endsection