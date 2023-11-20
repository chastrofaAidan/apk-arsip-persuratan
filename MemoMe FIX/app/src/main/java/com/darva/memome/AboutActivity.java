package com.darva.memome;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import androidx.appcompat.app.AppCompatActivity;
import com.darva.memome.A19.MainActivity;

public class AboutActivity extends AppCompatActivity {

    Button kembali;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_about);

        kembali = (Button) findViewById(R.id.btn_kembali_about);
        kembali.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent tombol = new Intent(AboutActivity.this, AwalActivity.class);
                startActivity(tombol);
                finish();
            }
        });
    }

    @Override
    public void onBackPressed() {
        // Kembali ke halaman sebelumnya dengan menggunakan Intent
        Intent intent = new Intent(this, MainActivity.class);
        startActivity(intent);
        finish();
    }
}