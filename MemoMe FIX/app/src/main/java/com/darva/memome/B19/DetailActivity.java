package com.darva.memome.B19;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.bumptech.glide.Glide;
import com.darva.memome.R;
import com.github.clans.fab.FloatingActionButton;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.storage.FirebaseStorage;

public class DetailActivity extends AppCompatActivity {

    TextView detailTempat, detailKelas, detailAbsen, detailAngkatan, detailNisn, detailName, detailTanggal, detailDeskripsi;
    ImageView detailImage;
    FloatingActionButton deleteButton, editButton;
    String key = "";
    String imageUrl = "";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_b_19);

        detailImage = findViewById(R.id.detailImage);
        detailNisn = findViewById(R.id.detailNisn);
        detailName = findViewById(R.id.detailName);
        detailTanggal = findViewById(R.id.detailTanggal);
        detailDeskripsi = findViewById(R.id.detailDeskripsi);
        detailTempat = findViewById(R.id.detailTempat);
        detailAbsen = findViewById(R.id.detailAbsen);

        detailImage = findViewById(R.id.detailImage);
        deleteButton = findViewById(R.id.deleteButton);
        editButton = findViewById(R.id.editButton);

        Bundle bundle = getIntent().getExtras();
        if (bundle != null){
            detailNisn.setText(bundle.getString("Nisn"));
            detailName.setText(bundle.getString("Nama"));
            detailTanggal.setText(bundle.getString("Tanggal"));
            detailDeskripsi.setText(bundle.getString("Deskripsi"));
            detailTempat.setText(bundle.getString("Tempat"));
            detailAbsen.setText(bundle.getString("Absen"));
            key = bundle.getString("Key");
            imageUrl = bundle.getString("dataImage");
            Glide.with(this).load(bundle.getString("Image")).into(detailImage);
        }
        deleteButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                final DatabaseReference reference = FirebaseDatabase.getInstance().getReference("Kelas B Angkatan 19");
                FirebaseStorage storage = FirebaseStorage.getInstance();

                // Mengambil referensi ke data dengan menggunakan kunci (key)
                DatabaseReference dataReference = reference.child(key);

                // Menghapus data dari Firebase Realtime Database
                dataReference.removeValue().addOnSuccessListener(new OnSuccessListener<Void>() {
                    @Override
                    public void onSuccess(Void unused) {
                        // Data berhasil dihapus
                        Toast.makeText(DetailActivity.this, "Data berhasil dihapus", Toast.LENGTH_SHORT).show();

                        // Anda juga dapat menambahkan kode untuk menghapus data gambar dari Firebase Storage di sini jika diperlukan.

                        // Kembali ke halaman utama
                        startActivity(new Intent(getApplicationContext(), MainActivity.class));
                        finish();
                    }
                });
            }
        });



        editButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(DetailActivity.this, UpdateActivity.class);
                intent.putExtra("Nisn", detailNisn.getText().toString());
                intent.putExtra("Name", detailName.getText().toString());
                intent.putExtra("Tanggal", detailTanggal.getText().toString());
                intent.putExtra("Deskripsi", detailDeskripsi.getText().toString());
                intent.putExtra("Tempat", detailTempat.getText().toString());
                intent.putExtra("Absen", detailAbsen.getText().toString());
                intent.putExtra("Image", imageUrl);
                intent.putExtra("Key", key);
                startActivity(intent);
            }
        });

    }
}