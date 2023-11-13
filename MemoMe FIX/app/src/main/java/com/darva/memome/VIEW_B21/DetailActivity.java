package com.darva.memome.VIEW_B21;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.bumptech.glide.Glide;
import com.darva.memome.B21.UpdateActivity;
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
        setContentView(R.layout.activity_detail_b_21_view);

        detailImage = findViewById(R.id.detailImage);
        detailNisn = findViewById(R.id.detailNisn);
        detailName = findViewById(R.id.detailName);
        detailTanggal = findViewById(R.id.detailTanggal);
        detailDeskripsi = findViewById(R.id.detailDeskripsi);
        detailTempat = findViewById(R.id.detailTempat);
        detailAbsen = findViewById(R.id.detailAbsen);

        detailImage = findViewById(R.id.detailImage);


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

    }
}