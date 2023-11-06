package com.darva.memome;

public class DataClass {

    private String nisn;
    private String name;
    private String tanggal;
    private String deskripsi;
    private String tempat;
    private String absen;
    private String dataImage;
    private String key;

    public DataClass(String nisn, String name, String tanggal, String deskripsi, String tempat, String absen, String dataImage) {
        this.nisn = nisn;
        this.name = name;
        this.tanggal = tanggal;
        this.deskripsi = deskripsi;
        this.tempat = tempat;
        this.absen = absen;
        this.dataImage = dataImage;
    }

    public String getNisn() {
        return nisn;
    }

    public void setNisn(String nisn) {
        this.nisn = nisn;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getTanggal() {
        return tanggal;
    }

    public void setTanggal(String tanggal) {
        this.tanggal = tanggal;
    }

    public String getDeskripsi() {
        return deskripsi;
    }

    public void setDeskripsi(String deskripsi) {
        this.deskripsi = deskripsi;
    }

    public String getTempat() {
        return tempat;
    }

    public void setTempat(String tempat) {
        this.tempat = tempat;
    }

    public String getAbsen() {
        return absen;
    }

    public void setAbsen(String absen) {
        this.absen = absen;
    }
    public String getDataImage() {
        return dataImage;
    }

    public void setDataImage(String dataImage) {
        this.dataImage = dataImage;
    }

    public String getKey() {
        return key;
    }

    public void setKey(String key) {
        this.key = key;
    }
    public DataClass(){

    }
}