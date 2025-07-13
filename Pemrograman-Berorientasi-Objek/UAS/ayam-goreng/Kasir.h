#ifndef KASIR_H
#define KASIR_H
#include "User.h"
using namespace std;

// ==== DEKLARASI KASIR CLASS ====
// class kasir ini merupakan turunan dari class User
// tpi dia punya fitur tambahan yatu kelola penjualan

class Admin;

class Kasir : public User {
private:
    string idKaryawan;
    Admin* admin; //pointer ke admin untuk akses data bahan baku
public:
    // ==== CONSTRUCTOR KASIR ====
    Kasir(int id, string uname, string pwd, string idKaryawan, Admin* admin);
    
    // ==== GETTER KASIR ====
    string getIdKaryawan() const { return idKaryawan; }

    // ==== METHODE KASIR ====
    void kelolaPenjualan();
    void tampilkanMenuKasir();
    void catatPenjualan();
    void lihatStok();
    void cariProduk();
    void laporanPenjualan();
    void savePenjualanToFile();
    void loadPenjualanFromFile();

};
#endif