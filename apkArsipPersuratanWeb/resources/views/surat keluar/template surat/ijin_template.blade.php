@extends('partials/pembuatan_surat')

@section('css')
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

    <form action="/surat_ijin/store" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="container">
        <br>
        <h5 class="fw-bold">Data Surat Ijin</h5>
        <div class="row">
            <div class="col-md-6">
                <label for="no_keluar">No</label>
                <input class="custom-input" type="text" name="no_keluar" id="no_keluar" value="{{ $newNoKeluarValue }}" readonly>

                <label for="tanggal_keluar">Tanggal</label>
                <input class="custom-input" type="date" name="tanggal_keluar" id="tanggal_keluar" required="required" value="{{ now()->toDateString() }}"><br>

                <label for="perihal_keluar">Perihal</label>
                <input class="custom-input" type="text" name="perihal_keluar" id="perihal_keluar" required="required" value="Surat Ijin"><br>      
            </div>
        
            <div class="col-md-6">
                <label for="kode_keluar1">Nomor Surat Keluar</label>
                <div class="row">
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

                <label for="ditujukan">Ditujukan Kepada</label>
                <input class="custom-input" type="text" name="ditujukan" id="ditujukan" required="required"><br>

                <label for="keterangan_keluar">Keterangan</label>
                <input class="custom-input" type="text" name="keterangan_keluar" id="keterangan_keluar" required="required"><br>
            </div>
        </div>
        <br>
        <h5 class="fw-bold">Konten Surat Ijin</h5>

        <div class="container">
            <div id="forms-container"></div>
            <br><br>
            <button class="custom-button" onclick="addParagraph()">
                <span>Add Paragraph</span>
            </button>
            <br>
            <button class="custom-button" onclick="addTable()">
                <span>Add Table</span>
            </button>
            <label for="tableRowCount">Jumlah Kolom:</label>
            <input type="number" id="tableRowCount" min="1" max="5" value="1" oninput="handleInputChange(this)">
            <br>
            <!-- <button class="custom-button" onclick="addPageBreak()">
                <span>Add Page Break</span>
            </button> -->
        </div>
    </div>
</div>

<br><br>

<div class="px-3 py-2 bg-white rounded shadow">
<h4 class="fw-bold">
    <i class="ri-mail-send-line sidebar-menu-item-icon" style="font-size: 20px;"></i>
    Surat Keluar
</h4>

<div class="container">
    <div class="container">
        <div class="row">
            <input class="btn format-surat col-md-6" type="submit" value="Catat Surat Keluar & Unduh Sebagai PDF" style="background-color: var(--bs-color1); color: white;">

            <a href="/surat_ijin" class="btn col-md-6 text-center" id="preview-link" target="_blank">
            <div class="btn format-surat col-md-12" style="background-color: var(--bs-color1); color: white;">Preview Surat</div>
            </a><br>
        </div>
    </div>
</div>
</form>
@endsection

@section('js')
<script>
    function handleInputChange(inputElement) {
    // Get the selected value from the dropdown
    var selectedValue = inputElement.value;

    // Check if the selected value is within the valid range (1 to 5)
    if (selectedValue < 1) {
      inputElement.value = 1;
    } else if (selectedValue > 5) {
      inputElement.value = 5;
    } else {
      inputElement.value = selectedValue;
    }
  }



    let elementCounter = 1;

    function addParagraph() {
        const container = document.getElementById('forms-container');

        // Create new paragraph container
        const newParagraph = document.createElement('div');
        newParagraph.className = 'row';

        // Create label
        const newLabel = document.createElement('label');
        newLabel.setAttribute('for', 'paragraf-' + elementCounter);
        newLabel.textContent = 'Paragraf ' + elementCounter;

        // Create textarea for paragraph content
        const newTextarea = document.createElement('textarea');
        newTextarea.className = 'custom-input paragraph';
        newTextarea.name = 'paragraf[' + elementCounter + ']'; // Use an array for dynamic names
        newTextarea.id = 'paragraf-' + elementCounter;
        newTextarea.required = true;

        // Create delete button
        const deleteButton = document.createElement('button');
        deleteButton.className = 'custom-button delete-button';
        deleteButton.onclick = function () {
            deleteElement(newParagraph);
        };
        deleteButton.innerHTML = '<span>Delete</span>';

        // Append elements to the new paragraph container
        newParagraph.appendChild(newLabel);
        newParagraph.appendChild(newTextarea);
        newParagraph.appendChild(deleteButton);

        // Append the new paragraph to the container
        container.appendChild(newParagraph);

        // Increment the counter for the next element
        elementCounter++;
    }

    // function addPageBreak(){

    // }

    function addTable() {
        const tableRowCount = document.getElementById('tableRowCount').value;
        const container = document.getElementById('forms-container');

        // Create break
        const lineBreak1 = document.createElement('br');
        const lineBreak2 = document.createElement('br');
        const lineBreak3 = document.createElement('br');
        const lineBreak4 = document.createElement('br');

        // Create Div
        const newTable = document.createElement('div');
        newTable.className = 'custom-table';
        newTable.id = 'table-' + elementCounter;

        // Create delete button for the table
        const deleteTableButton = document.createElement('button');
        deleteTableButton.className = 'custom-button delete-button';
        deleteTableButton.onclick = function () {
            deleteElement(newTable);
        };
        deleteTableButton.innerHTML = '<span>Delete Table</span>';

        // Create add row button
        const addRowButton = document.createElement('button');
        addRowButton.className = 'custom-button';
        addRowButton.onclick = function () {
            addRow(newTable, tableRowCount);
        };
        addRowButton.innerHTML = '<span>Add Row</span>';

        // Create label
        const newLabel = document.createElement('label');
        newLabel.textContent = 'Table Header';

        // Append buttons to the new table container
        newTable.appendChild(deleteTableButton);
        newTable.appendChild(addRowButton);
        newTable.appendChild(lineBreak1);
        newTable.appendChild(newLabel);

        // Create textareas based on the number of rows
        for (let i = 0; i < tableRowCount; i++) {
            const newTextarea = document.createElement('textarea');
            newTextarea.className = 'custom-input';
            newTextarea.placeholder = "Nama Kolom " + (i + 1);  // Updated variable name
            newTextarea.name = 'kepala-kolom-' + elementCounter;
            newTextarea.id = 'kepala-kolom-' + elementCounter;
            newTextarea.required = true;
            newTable.appendChild(newTextarea);
        }

        // Append buttons to the new table container
        newTable.appendChild(lineBreak2);
        newTable.appendChild(lineBreak3);
        newTable.appendChild(lineBreak4);

        // Append the new table to the container
        container.appendChild(newTable);

        // Increment the counter for the next element
        elementCounter++;

        // Assuming you have a button to trigger the page transition
        // const transitionButton = document.getElementById('transitionButton');
        // transitionButton.addEventListener('click', function () {
        //     navigateToAnotherPage();
        // });
    }

    function addRow(table, rowCount) {
        // Create break
        const lineBreak = document.createElement('br');

        // Create row container
        const newRow = document.createElement('div');
        newRow.className = 'table-row';

        // Create delete row button
        const deleteRowButton = document.createElement('button');
        deleteRowButton.className = 'custom-button delete-button';
        deleteRowButton.onclick = function () {
            deleteRow(newRow);
        };
        deleteRowButton.innerHTML = '<span>Delete Row</span>';

        // Append delete row button to the row
        newRow.appendChild(deleteRowButton);

        // Create textareas for the new row
        for (let i = 0; i < rowCount; i++) {
            const newTextarea = document.createElement('textarea');
            newTextarea.className = 'custom-input';
            newTextarea.placeholder = 'Value ' + (i + 1);
            newTextarea.name = 'value-' + elementCounter + '-row-' + (i + 1);
            newTextarea.id = 'value-' + elementCounter + '-row-' + (i + 1);
            newTextarea.required = true;
            newRow.appendChild(newTextarea);
        }

        // Append row and line break to the table
        table.appendChild(newRow);
        table.appendChild(lineBreak);
    }


    function deleteRow(row) {
        // Remove the row from its parent node
        row.parentNode.removeChild(row);
    }


    function deleteElement(element) {
        const container = document.getElementById('forms-container');
        container.removeChild(element);
    }
</script>
@endsection
