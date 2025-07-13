#ifndef PRODUK_H
#define PRODUK_H
#include <string>

using namespace std;

// ==== DEKLARASI PRODUK CLASS ====
class Produk{
private:
    int idProduk;
    string namaProduk;
    int stok;
    double harga;

public:
    // ==== CONSTRUKTOR PRODUK ====
    Produk(int id, string nama, int stok, double harga);

    // ==== DISPLAY INFO PRODUK ====
    void displayInfo();

    // ==== UPDATE STOK PRODUK ====
    void tambahStok(int jumlah); // menambah stok produk
    void kurangiStok(int jumlah); // mengurangi stok produk

    // ==== GETTER PRODUK ====
    int getidProduk() const; // ambil id produk
    string getnamaProduk() const; // ambil nama produk
    int getstok() const; // ambil stok produk
    double getharga() const; // ambil harga produk
};

#endif