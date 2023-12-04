package com.darva.memome.VIEW_A19;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.SearchView;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.darva.memome.A19.UploadActivity;
import com.darva.memome.AngkatanActivity;
import com.darva.memome.DataClass;
import com.darva.memome.R;
import com.darva.memome.ViewAngkatanActivity;
import com.google.android.material.floatingactionbutton.FloatingActionButton;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.List;

    public class MainActivity extends AppCompatActivity {
        // Deklarasi variabel
        DatabaseReference databaseReference;
        ValueEventListener eventListener;
        RecyclerView recyclerView;
        List<DataClass> dataList;
        MyAdapter adapter;
        SearchView searchView;

        @Override
        protected void onCreate(Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            setContentView(R.layout.activity_a19_view);

            // Inisialisasi komponen UI
            recyclerView = findViewById(R.id.recyclerView);
            searchView = findViewById(R.id.search);

            // Atur tampilan RecyclerView
            GridLayoutManager gridLayoutManager = new GridLayoutManager(MainActivity.this, 1);
            recyclerView.setLayoutManager(gridLayoutManager);

            // Tampilkan dialog progres
            AlertDialog.Builder builder = new AlertDialog.Builder(MainActivity.this);
            builder.setCancelable(false);
            builder.setView(R.layout.progress_layout);
            final AlertDialog dialog = builder.create();
            dialog.show();

            // Inisialisasi ArrayList untuk data
            dataList = new ArrayList<>();
            adapter = new MyAdapter(MainActivity.this, dataList);
            recyclerView.setAdapter(adapter);

            // Ambil data dari Firebase Realtime Database
            databaseReference = FirebaseDatabase.getInstance().getReference("Kelas A Angkatan 19");
            eventListener = databaseReference.addValueEventListener(new ValueEventListener() {
                @Override
                public void onDataChange(@NonNull DataSnapshot snapshot) {
                    dataList.clear();
                    for (DataSnapshot itemSnapshot : snapshot.getChildren()) {
                        DataClass dataClass = itemSnapshot.getValue(DataClass.class);
                        dataClass.setKey(itemSnapshot.getKey());
                        dataList.add(dataClass);
                    }

                    // Urutkan dataList berdasarkan no absen (dalam format string)
                    Collections.sort(dataList, new Comparator<DataClass>() {
                        @Override
                        public int compare(DataClass data1, DataClass data2) {
                            // Mengonversi nomor absen ke integer sebelum membandingkan
                            int absen1 = Integer.parseInt(data1.getAbsen());
                            int absen2 = Integer.parseInt(data2.getAbsen());
                            return Integer.compare(absen1, absen2);
                        }
                    });


                    adapter.notifyDataSetChanged();
                    dialog.dismiss(); // Tutup dialog setelah selesai
                }

                @Override
                public void onCancelled(@NonNull DatabaseError error) {
                    dialog.dismiss(); // Tutup dialog jika ada kesalahan
                }
            });

            // Fungsi pencarian menggunakan SearchView
            searchView.setOnQueryTextListener(new SearchView.OnQueryTextListener() {
                @Override
                public boolean onQueryTextSubmit(String query) {
                    return false;
                }

                @Override
                public boolean onQueryTextChange(String newText) {
                    searchList(newText);
                    return true;
                }
            });
        }

        // Fungsi untuk melakukan pencarian dan mengupdate tampilan
        public void searchList(String text) {
            ArrayList<DataClass> searchList = new ArrayList<>();
            for (DataClass dataClass : dataList) {
                if (dataClass.getName().toLowerCase().contains(text.toLowerCase())) {
                    searchList.add(dataClass);
                }
            }
            adapter.searchDataList(searchList);
        }
        @Override
        public void onBackPressed() {
            Intent intent = new Intent(this, ViewAngkatanActivity.class);
            startActivity(intent);
            finish();
        }
    }

