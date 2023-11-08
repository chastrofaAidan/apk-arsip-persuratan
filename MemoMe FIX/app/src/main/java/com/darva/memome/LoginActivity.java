package com.darva.memome;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

public class LoginActivity extends AppCompatActivity {

    EditText username, password;
    com.google.android.material.floatingactionbutton.FloatingActionButton tombol;

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        username = (EditText) findViewById(R.id.et_username);
        password = (EditText) findViewById(R.id.et_password);
        tombol = (FloatingActionButton) findViewById(R.id.bawah);
        tombol.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String idKey = username.getText().toString();
                String idPass = password.getText().toString();
                if (idKey.equals("admin") && idPass.equals("123")) {
                    //jika login berhasil
                    Toast.makeText(getApplicationContext(), "Login Berhasil", Toast.LENGTH_SHORT).show();
                    Intent mulai = new Intent(LoginActivity.this, AngkatanActivity.class);
                    startActivity(mulai);
                    finish();
                }
                else {
                    //jika login gagal
                    AlertDialog.Builder notifikasi = new AlertDialog.Builder(LoginActivity.this);
                    notifikasi.setMessage("Nice Try").setNegativeButton("Coba lagi yaaa", null).create().show();
                }
            }
        });
    }

    @Override
    public void onBackPressed() {
        Intent intent = new Intent(this, AngkatanActivity.class);
        startActivity(intent);
        finish();
    }
}