package com.darva.memome.B19;

import android.app.Activity;
import android.app.DatePickerDialog;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.Toast;

import androidx.activity.result.ActivityResult;
import androidx.activity.result.ActivityResultCallback;
import androidx.activity.result.ActivityResultLauncher;
import androidx.activity.result.contract.ActivityResultContracts;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import com.darva.memome.DataClass;
import com.darva.memome.R;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.OnFailureListener;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.storage.FirebaseStorage;
import com.google.firebase.storage.StorageReference;
import com.google.firebase.storage.UploadTask;

import java.text.SimpleDateFormat;
import java.util.Calendar;

public class UploadActivity extends AppCompatActivity {

    ImageView uploadImage;
    Button saveButton;
    AutoCompleteTextView uploadTempat, uploadKelas, uploadAbsen, uploadAngkatan;
    EditText uploadNisn, uploadName, uploadTanggal, uploadDeskripsi;
    String imageURL;
    Uri uri;
    private int tahun, bulan, tanggal;
    private EditText etTanggal;
    private ImageButton btnTanggal;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_upload_b19);

        etTanggal = findViewById(R.id.uploadTanggal);
        btnTanggal = findViewById(R.id.btnTanggal);
        uploadImage = findViewById(R.id.uploadImage);
        uploadNisn = findViewById(R.id.uploadNisn);
        uploadName = findViewById(R.id.uploadName);
        uploadTanggal = findViewById(R.id.uploadTanggal);
        uploadDeskripsi = findViewById(R.id.uploadDeskripsi);
        uploadTempat = findViewById(R.id.uploadTempat);
        uploadAbsen = findViewById(R.id.uploadAbsen);
        saveButton = findViewById(R.id.saveButton);

        // Pindahkan inisialisasi tanggal ke metode tersendiri
        initTanggalPicker();

        ActivityResultLauncher<Intent> activityResultLauncher = registerForActivityResult(
                new ActivityResultContracts.StartActivityForResult(),
                new ActivityResultCallback<ActivityResult>() {
                    @Override
                    public void onActivityResult(ActivityResult result) {
                        if (result.getResultCode() == Activity.RESULT_OK) {
                            Intent data = result.getData();
                            uri = data.getData();
                            uploadImage.setImageURI(uri);
                        } else {
                            Toast.makeText(UploadActivity.this, "Tidak ada Gambar yang Dipilih", Toast.LENGTH_SHORT).show();
                        }
                    }
                }
        );

        uploadImage.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent photoPicker = new Intent(Intent.ACTION_PICK);
                photoPicker.setType("image/*");
                activityResultLauncher.launch(photoPicker);
            }
        });

        saveButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                saveData();
            }
        });
    }

    // Metode untuk menginisialisasi pemilih tanggal
    private void initTanggalPicker() {
        btnTanggal.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Calendar calendar = Calendar.getInstance();
                tahun = calendar.get(Calendar.YEAR);
                bulan = calendar.get(Calendar.MONTH);
                tanggal = calendar.get(Calendar.DAY_OF_MONTH);

                DatePickerDialog dialog;
                dialog = new DatePickerDialog(UploadActivity.this, new DatePickerDialog.OnDateSetListener() {
                    @Override
                    public void onDateSet(DatePicker view, int year, int month, int dayOfMonth) {
                        tahun = year;
                        bulan = month;
                        tanggal = dayOfMonth;

                        SimpleDateFormat dateFormat = new SimpleDateFormat("dd MMMM yyyy");
                        Calendar selectedDate = Calendar.getInstance();
                        selectedDate.set(Calendar.YEAR, tahun);
                        selectedDate.set(Calendar.MONTH, bulan);
                        selectedDate.set(Calendar.DAY_OF_MONTH, tanggal);
                        String formattedDate = dateFormat.format(selectedDate.getTime());

                        etTanggal.setText(formattedDate);
                    }
                }, tahun, bulan, tanggal);
                dialog.show();
            }
        });

        etTanggal.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Calendar calendar = Calendar.getInstance();
                tahun = calendar.get(Calendar.YEAR);
                bulan = calendar.get(Calendar.MONTH);
                tanggal = calendar.get(Calendar.DAY_OF_MONTH);

                DatePickerDialog dialog;
                dialog = new DatePickerDialog(UploadActivity.this, new DatePickerDialog.OnDateSetListener() {
                    @Override
                    public void onDateSet(DatePicker view, int year, int month, int dayOfMonth) {
                        tahun = year;
                        bulan = month;
                        tanggal = dayOfMonth;

                        SimpleDateFormat dateFormat = new SimpleDateFormat("dd MMMM yyyy");
                        Calendar selectedDate = Calendar.getInstance();
                        selectedDate.set(Calendar.YEAR, tahun);
                        selectedDate.set(Calendar.MONTH, bulan);
                        selectedDate.set(Calendar.DAY_OF_MONTH, tanggal);
                        String formattedDate = dateFormat.format(selectedDate.getTime());

                        etTanggal.setText(formattedDate);
                    }
                }, tahun, bulan, tanggal);
                dialog.show();
            }
        });
    }

    public void saveData() {
        if (uri == null || uploadNisn.getText().toString().isEmpty() ||
                uploadName.getText().toString().isEmpty() || etTanggal.getText().toString().isEmpty() ||
                uploadDeskripsi.getText().toString().isEmpty() || uploadTempat.getText().toString().isEmpty() ||
                uploadAbsen.getText().toString().isEmpty()) {
            Toast.makeText(UploadActivity.this, "Harap isi semua data sebelum menyimpan/upload.", Toast.LENGTH_SHORT).show();
            return; // Jika ada data yang kosong, hentikan proses penyimpanan/upload.
        }

        StorageReference storageReference = FirebaseStorage.getInstance().getReference().child("Android Images")
                .child(uri.getLastPathSegment());

        AlertDialog.Builder builder = new AlertDialog.Builder(UploadActivity.this);
        builder.setCancelable(false);
        builder.setView(R.layout.progress_layout);
        AlertDialog dialog = builder.create();
        dialog.show();

        storageReference.putFile(uri).addOnSuccessListener(new OnSuccessListener<UploadTask.TaskSnapshot>() {
            @Override
            public void onSuccess(UploadTask.TaskSnapshot taskSnapshot) {
                taskSnapshot.getStorage().getDownloadUrl().addOnCompleteListener(new OnCompleteListener<Uri>() {
                    @Override
                    public void onComplete(@NonNull Task<Uri> uriTask) {
                        if (uriTask.isSuccessful()) {
                            Uri urlImage = uriTask.getResult();
                            imageURL = urlImage.toString();
                            uploadData();
                            dialog.dismiss();
                        } else {
                            dialog.dismiss();
                            Toast.makeText(UploadActivity.this, "Gagal mendapatkan URL gambar", Toast.LENGTH_SHORT).show();
                        }
                    }
                });
            }
        }).addOnFailureListener(new OnFailureListener() {
            @Override
            public void onFailure(@NonNull Exception e) {
                dialog.dismiss();
                Toast.makeText(UploadActivity.this, "Gagal mengunggah gambar: " + e.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    public void uploadData() {
        String nisn = uploadNisn.getText().toString();
        String name = uploadName.getText().toString();
        String tanggal = etTanggal.getText().toString();
        String deskripsi = uploadDeskripsi.getText().toString();
        String tempat = uploadTempat.getText().toString();
        String absen = uploadAbsen.getText().toString();

        DataClass dataClass = new DataClass(nisn, name, tanggal, deskripsi, tempat, absen, imageURL);

        FirebaseDatabase.getInstance().getReference().child("Kelas B Angkatan 19").push()
                .setValue(dataClass).addOnCompleteListener(new OnCompleteListener<Void>() {
                    @Override
                    public void onComplete(@NonNull Task<Void> task) {
                        if (task.isSuccessful()) {
                            Toast.makeText(UploadActivity.this, "Data berhasil disimpan", Toast.LENGTH_SHORT).show();
                            finish();
                        } else {
                            Toast.makeText(UploadActivity.this, "Gagal menyimpan data", Toast.LENGTH_SHORT).show();
                        }
                    }
                });
    }
}
