package com.darva.memome.VIEW_A20;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.cardview.widget.CardView;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
import com.darva.memome.DataClass;
import com.darva.memome.R;

import java.util.ArrayList;
import java.util.List;

public class MyAdapter extends RecyclerView.Adapter<MyViewHolder> {

    private Context context;
    private List<DataClass> dataList;

    public MyAdapter(Context context, List<DataClass> dataList) {
        this.context = context;
        this.dataList = dataList;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.recycler_item, parent, false);
        return new MyViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
        Glide.with(context).load(dataList.get(position).getDataImage()).into(holder.recImage);
        holder.recName.setText(dataList.get(position).getName());
        holder.recDeskripsi.setText(dataList.get(position).getDeskripsi());
        holder.recAbsen.setText(dataList.get(position).getAbsen());
        holder.recNisn.setText(dataList.get(position).getNisn());
        holder.recTanggal.setText(dataList.get(position).getTanggal());
        holder.recTempat.setText(dataList.get(position).getTempat());

        holder.recCard.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(context, DetailActivity.class);
                intent.putExtra("Image", dataList.get(holder.getAdapterPosition()).getDataImage());
                intent.putExtra("Nama", dataList.get(holder.getAdapterPosition()).getName());
                intent.putExtra("Deskripsi", dataList.get(holder.getAdapterPosition()).getDeskripsi());
                intent.putExtra("Key", dataList.get(holder.getAdapterPosition()).getKey());
                intent.putExtra("Absen", dataList.get(holder.getAdapterPosition()).getAbsen());
                intent.putExtra("Nisn", dataList.get(holder.getAdapterPosition()).getNisn());
                intent.putExtra("Tanggal", dataList.get(holder.getAdapterPosition()).getTanggal());
                intent.putExtra("Tempat", dataList.get(holder.getAdapterPosition()).getTempat());
                context.startActivity(intent);
            }
        });
    }

    @Override
    public int getItemCount() {
        return dataList.size();
    }

    public void searchDataList(ArrayList<DataClass> searchList){
        dataList = searchList;
        notifyDataSetChanged();
    }
}

class MyViewHolder extends RecyclerView.ViewHolder {
    ImageView recImage;
    TextView recNisn, recName, recTanggal, recDeskripsi, recTempat, recAbsen;
    CardView recCard;

    public MyViewHolder(@NonNull View itemView) {
        super(itemView);

        recImage = itemView.findViewById(R.id.recImage);
        recCard = itemView.findViewById(R.id.recCard);

        recNisn = itemView.findViewById(R.id.recNisn); // Menambahkan recNisn
        recName = itemView.findViewById(R.id.recName);
        recTanggal = itemView.findViewById(R.id.recTanggal);
        recDeskripsi = itemView.findViewById(R.id.recDeskripsi);
        recTempat = itemView.findViewById(R.id.recTempat);
        recAbsen = itemView.findViewById(R.id.recAbsen);
    }
}
