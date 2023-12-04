package com.darva.memome.A19;

import androidx.activity.result.ActivityResult;
import androidx.activity.result.ActivityResultCallback;
import androidx.activity.result.ActivityResultLauncher;
import androidx.activity.result.contract.ActivityResultContracts;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

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

import com.bumptech.glide.Glide;
import com.darva.memome.DataClass;
import com.darva.memome.R;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.OnFailureListener;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.storage.FirebaseStorage;
import com.google.firebase.storage.StorageReference;
import com.google.firebase.storage.UploadTask;

import java.text.SimpleDateFormat;
import java.util.Calendar;

public class UpdateActivity extends AppCompatActivity {

    private int tahun, bulan, tanggal;
    private EditText upTanggal;
    private ImageButton btnTanggal;
    ImageView updateImage;
    Button updateButton;
    AutoCompleteTextView updateTempat, updateKelas, updateAbsen, updateAngkatan;
    EditText updateNisn, updateName, updateTanggal, updateDeskripsi;
    String imageUrl;
    String key, oldImageURL;
    Uri uri;
    DatabaseReference databaseReference;
    StorageReference storageReference;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_update_a19);

        upTanggal = findViewById(R.id.updateTanggal);
        btnTanggal = findViewById(R.id.btnTanggal);
        updateButton = findViewById(R.id.saveButton);
        updateDeskripsi = findViewById(R.id.updateDeskripsi);
        updateImage = findViewById(R.id.updateImage);
        updateName = findViewById(R.id.updateName);
        updateTanggal = findViewById(R.id.updateTanggal);
        updateTempat = findViewById(R.id.updateTempat);
        updateAbsen = findViewById(R.id.updateAbsen);
        updateNisn = findViewById(R.id.updateNisn);

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
                            if (uri != null) {
                                updateImage.setImageURI(uri);
                            } else {
                                Toast.makeText(UpdateActivity.this, "Tidak Ada Gambar yang Dipilih", Toast.LENGTH_SHORT).show();
                            }
                        }
                    }
                }
        );

        Bundle bundle = getIntent().getExtras();
        if (bundle != null) {
            Glide.with(UpdateActivity.this).load(bundle.getString("Image")).into(updateImage);
            updateNisn.setText(bundle.getString("Nisn"));
            updateName.setText(bundle.getString("Name"));
            updateDeskripsi.setText(bundle.getString("Deskripsi"));
            updateTanggal.setText(bundle.getString("Tanggal"));
            updateTempat.setText(bundle.getString("Tempat"));
            updateAbsen.setText(bundle.getString("Absen"));
            key = bundle.getString("Key");
            oldImageURL = bundle.getString("Image");
        }

        databaseReference = FirebaseDatabase.getInstance().getReference("Kelas A Angkatan 19").child(key);

        updateImage.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent photoPicker = new Intent(Intent.ACTION_PICK);
                photoPicker.setType("image/*");
                activityResultLauncher.launch(photoPicker);
            }
        });

        updateButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                saveData();
                Intent intent = new Intent(UpdateActivity.this, MainActivity.class);
                startActivity(intent);
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
                dialog = new DatePickerDialog(UpdateActivity.this, new DatePickerDialog.OnDateSetListener() {
                    @Override
                    public void onDateSet(DatePicker view, int year, int month, int dayOfMonth) {
                        tahun = year;
                        bulan = month;
                        tanggal = dayOfMonth;

                        // Menggunakan SimpleDateFormat untuk mengubah format tanggal
                        SimpleDateFormat dateFormat = new SimpleDateFormat("dd MMMM yyyy");
                        Calendar selectedDate = Calendar.getInstance();
                        selectedDate.set(Calendar.YEAR, tahun);
                        selectedDate.set(Calendar.MONTH, bulan);
                        selectedDate.set(Calendar.DAY_OF_MONTH, tanggal);
                        String formattedDate = dateFormat.format(selectedDate.getTime());

                        upTanggal.setText(formattedDate);
                    }
                }, tahun, bulan, tanggal);
                dialog.show();
            }
        });

        upTanggal.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Calendar calendar = Calendar.getInstance();
                tahun = calendar.get(Calendar.YEAR);
                bulan = calendar.get(Calendar.MONTH);
                tanggal = calendar.get(Calendar.DAY_OF_MONTH);

                DatePickerDialog dialog;
                dialog = new DatePickerDialog(UpdateActivity.this, new DatePickerDialog.OnDateSetListener() {
                    @Override
                    public void onDateSet(DatePicker view, int year, int month, int dayOfMonth) {
                        tahun = year;
                        bulan = month;
                        tanggal = dayOfMonth;

                        // Menggunakan SimpleDateFormat untuk mengubah format tanggal
                        SimpleDateFormat dateFormat = new SimpleDateFormat("dd MMMM yyyy");
                        Calendar selectedDate = Calendar.getInstance();
                        selectedDate.set(Calendar.YEAR, tahun);
                        selectedDate.set(Calendar.MONTH, bulan);
                        selectedDate.set(Calendar.DAY_OF_MONTH, tanggal);
                        String formattedDate = dateFormat.format(selectedDate.getTime());

                        upTanggal.setText(formattedDate);
                    }
                }, tahun, bulan, tanggal);
                dialog.show();
            }
        });
    }

    public void saveData() {
        if (uri != null) {
            storageReference = FirebaseStorage.getInstance().getReference().child("Android Images").child(uri.getLastPathSegment());

            AlertDialog.Builder builder = new AlertDialog.Builder(UpdateActivity.this);
            builder.setCancelable(false);
            builder.setView(R.layout.progress_layout);
            AlertDialog dialog = builder.create();
            dialog.show();

            storageReference.putFile(uri).addOnSuccessListener(new OnSuccessListener<UploadTask.TaskSnapshot>() {
                @Override
                public void onSuccess(UploadTask.TaskSnapshot taskSnapshot) {
                    Task<Uri> uriTask = taskSnapshot.getStorage().getDownloadUrl();
                    uriTask.addOnSuccessListener(new OnSuccessListener<Uri>() {
                        @Override
                        public void onSuccess(Uri uri) {
                            String imageUrl = uri.toString();
                            // Lakukan sesuatu dengan imageUrl, misalnya menyimpannya di database Firebase Realtime Database
                            // Di sini Anda dapat memanggil metode updateData() dengan imageUrl yang sudah didapatkan
                            updateData(imageUrl);
                        }
                    });
                    dialog.dismiss();
                }
            }).addOnFailureListener(new OnFailureListener() {
                @Override
                public void onFailure(@NonNull Exception e) {
                    dialog.dismiss();
                }
            });
        } else {
            // Jika gambar tidak diubah, langsung panggil updateData() tanpa memperbarui imageUrl
            updateData(oldImageURL);
        }
    }

    public void updateData(String imageUrl) {
        // Metode ini akan menerima imageUrl yang sudah didapatkan dan melanjutkan dengan memperbarui data di Firebase Database
        // Pastikan Anda sudah mendeklarasikan imageUrl sebagai atribut (field) kelas di atas
        this.imageUrl = imageUrl;

        String nisn = updateNisn.getText().toString().trim();
        String name = updateName.getText().toString().trim();
        String deskripsi = updateDeskripsi.getText().toString().trim();
        String tanggal = updateTanggal.getText().toString();
        String tempat = updateTempat.getText().toString();
        String absen = updateAbsen.getText().toString();

        DataClass dataClass;

        if (uri != null) {
            dataClass = new DataClass(nisn, name, tanggal, deskripsi, tempat, absen, imageUrl);
        } else {
            dataClass = new DataClass(nisn, name, tanggal, deskripsi, tempat, absen, oldImageURL);
        }

        databaseReference.setValue(dataClass).addOnCompleteListener(new OnCompleteListener<Void>() {
            @Override
            public void onComplete(@NonNull Task<Void> task) {
                if (task.isSuccessful()) {
                    Toast.makeText(UpdateActivity.this, "Diperbarui", Toast.LENGTH_SHORT).show();
                    finish();
                }
            }
        }).addOnFailureListener(new OnFailureListener() {
            @Override
            public void onFailure(@NonNull Exception e) {
                Toast.makeText(UpdateActivity.this, e.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }
}
