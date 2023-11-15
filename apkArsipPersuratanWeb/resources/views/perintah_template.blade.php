@extends('pembuatan_surat')

@section('template')

<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-mail-add-line sidebar-menu-item-icon"  style="font-size: 20px;"></i>
    Pembuatan Surat - Perintah
</h4>
<form id="myForm" action="/submit_form" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <div id="additionalInputs"></div>

        <button type="button" onclick="addInput()">Add More</button>

        <input type="submit" value="Submit">
    </form>
</div>

<br><br>

<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-mail-send-line sidebar-menu-item-icon" style="font-size: 20px;"></i>
    Surat Keluar
</h4>

<div class="row">
    <a href="/surat_perintah" class="btn col-md-6 text-center" target="_blank">
        <div class="btn format-surat col-md-12" style="background-color: var(--bs-color1); color: white;"> Catat Surat Keluar & Unduh Sebagai PDF</div>
    </a><br>
    <a href="/surat_perintah" class="btn col-md-6 text-center" target="_blank">
        <div class="btn format-surat col-md-12" style="background-color: var(--bs-color1); color: white;">Preview Surat</div>
    </a><br>
    <!-- <a href="/surat_perintah" class="btn btn-primary" >Unduh Sebagai PDF</a> -->
</div>
@endsection

@section('js')
<script>
    let inputCounter = 1;

    function addInput() {
        const container = document.getElementById('additionalInputs');

        // Create new input element
        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'additionalInput' + inputCounter;
        newInput.placeholder = 'Additional Input ' + inputCounter;
        newInput.required = true;

        // Create remove button
        const removeButton = document.createElement('span');
        removeButton.className = 'removeButton';
        removeButton.innerHTML = 'Remove';
        removeButton.onclick = function () {
            container.removeChild(newInput);
            container.removeChild(removeButton);
        };

        // Append the new input and remove button to the container
        container.appendChild(newInput);
        container.appendChild(removeButton);

        // Increment the counter for the next input
        inputCounter++;
    }
</script>
@endsection
