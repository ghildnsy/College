#include "ProdukTerjual.h"
#include <iostream>
#include <iomanip>

using namespace std;

// ==== CONSTRUKTOR PRODUK TERJUAL ====
// class ProdukTerjual ini digunakan untuk menyimpan data penjualan produk
ProdukTerjual::ProdukTerjual(int id, string tgl, string nama, int jml, double hrg)
    : idPenjualan(id), tanggal(tgl), namaProduk(nama), jumlah(jml), harga(hrg) {}

// ==== DISPLAY INFO PRODUK TERJUAL ====
void ProdukTerjual::displayInfo() {
    // itung total price
    double total = harga * jumlah;
    
    cout << "| " << left << setw(8) << idPenjualan << " | "
         << setw(17) << tanggal << " | "
         << setw(15) << namaProduk << " | "
         << setw(6) << jumlah << " | "
         << "Rp" << setw(8) << total << " |" << endl;
}