package com.darva.memome;

import androidx.appcompat.app.AppCompatActivity;

import android.app.Dialog;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

public class AwalActivity extends AppCompatActivity {

    Dialog dialog;
    Button about, datasiswa;
    FloatingActionButton login;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_awal);

        login = (FloatingActionButton) findViewById(R.id.btn_login);
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent tombol = new Intent(AwalActivity.this, LoginActivity.class);
                startActivity(tombol);
                finish();
            }
        });

        dialog = new Dialog(AwalActivity.this);
        dialog.setContentView(R.layout.alert_dialog);

        // Mengatur latar belakang dialog menjadi transparan
        dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

        // Mengatur ukuran dialog agar mengikuti content
        dialog.getWindow().setLayout(ViewGroup.LayoutParams.WRAP_CONTENT, ViewGroup.LayoutParams.WRAP_CONTENT);

        Button ya = dialog.findViewById(R.id.btn_ya);
        Button tidak = dialog.findViewById(R.id.btn_tidak);

        // Menampilkan dialog saat tombol diklik
        findViewById(R.id.btn_keluar).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                dialog.show();
            }
        });

        // Menutup aplikasi saat tombol "YA" diklik
        ya.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });

        // Menutup dialog saat tombol "TIDAK" diklik
        tidak.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                dialog.dismiss();
            }
        });

        about = (Button) findViewById(R.id.btn_about);
        about.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent tombol = new Intent(AwalActivity.this, AboutActivity.class);
                startActivity(tombol);
                finish();
            }
        });

        datasiswa = (Button) findViewById(R.id.btn_datasiswa);
        datasiswa.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent tombol = new Intent(AwalActivity.this, ViewAngkatanActivity.class);
                startActivity(tombol);
                finish();
            }
        });
    }

    @Override
    public void onBackPressed() {
        // Menampilkan dialog saat tombol "Back" ditekan
        if (!dialog.isShowing()) {
            dialog.show();
        }
    }
}