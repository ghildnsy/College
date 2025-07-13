#include "Produk.h"
#include <iostream>
#include <string>
#include <iomanip>

using namespace std;

// ==== CONSTRUKTOR PRODUK ====
Produk::Produk(int id, string nama, int stok, double harga)
    : idProduk(id), namaProduk(nama), stok(stok), harga(harga){}

// ==== TAMPILKAN INFO PRODUK ====
void Produk::displayInfo() {
    cout << "| " << setw(4) << left << idProduk
         << "| " << setw(20) << left << namaProduk
         << "| " << setw(6) << right << stok << " "
         << "| Rp" << setw(9) << right << fixed << setprecision(0) << harga << " |" << endl;
}

// ==== TAMBAH STOK PRODUK ====
void Produk::tambahStok(int jumlah){
    stok += jumlah;
}

// ==== KURANGI STOK PRODUK ====
void Produk::kurangiStok(int jumlah){
    if(jumlah<=0) {
        cout << "ERROR: Jumlah harus lebih besar dari 0." << endl;
        return;
    }
    if(jumlah > stok) {
        cout << "ERROR: Stok tidak cukup untuk mengurangi " << jumlah << endl;
        return;
    }
    stok -= jumlah;
}

// ==== GETTER PRODUK ====
int Produk::getidProduk() const {
    return idProduk;
}

string Produk::getnamaProduk() const{
    return namaProduk;
}

int Produk::getstok() const {
    return stok;
}

double Produk::getharga() const {
    return harga;
}