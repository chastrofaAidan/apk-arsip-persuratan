package com.darva.memome;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import com.darva.memome.VIEW_A19.MainActivity;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

public class ViewAngkatanActivity extends AppCompatActivity {

    FloatingActionButton btn_back;
    Button btn_kelas_a_19, btn_kelas_b_19, btn_kelas_a_20, btn_kelas_b_20, btn_kelas_a_21, btn_kelas_b_21;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_angkatan);

        btn_back = findViewById(R.id.btn_back);
        btn_kelas_a_19 = findViewById(R.id.btn_kelas_a_19);
        btn_kelas_b_19 = findViewById(R.id.btn_kelas_b_19);
        btn_kelas_a_20 = findViewById(R.id.btn_kelas_a_20);
        btn_kelas_b_20 = findViewById(R.id.btn_kelas_b_20);
        btn_kelas_a_21 = findViewById(R.id.btn_kelas_a_21);
        btn_kelas_b_21 = findViewById(R.id.btn_kelas_b_21);

        btn_kelas_a_19.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(ViewAngkatanActivity.this, com.darva.memome.VIEW_A19.MainActivity.class);
                startActivity(intent);
                finish();
            }
        });

        btn_kelas_b_19.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(ViewAngkatanActivity.this, com.darva.memome.VIEW_B19.MainActivity.class);
                startActivity(intent);
                finish();
            }
        });

        btn_kelas_a_20.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(ViewAngkatanActivity.this, com.darva.memome.VIEW_A20.MainActivity.class);
                startActivity(intent);
                finish();
            }
        });

        btn_kelas_b_20.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(ViewAngkatanActivity.this, com.darva.memome.VIEW_B20.MainActivity.class);
                startActivity(intent);
                finish();
            }
        });

        btn_kelas_a_21.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(ViewAngkatanActivity.this, com.darva.memome.VIEW_A21.MainActivity.class);
                startActivity(intent);
                finish();
            }
        });

        btn_kelas_b_21.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(ViewAngkatanActivity.this, com.darva.memome.VIEW_B21.MainActivity.class);
                startActivity(intent);
                finish();
            }
        });

        btn_back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(ViewAngkatanActivity.this, AwalActivity.class);
                startActivity(intent);
                finish();
            }
        });
    }

    @Override
    public void onBackPressed() {
        Intent intent = new Intent(this, AwalActivity.class);
        startActivity(intent);
        finish();
    }
}