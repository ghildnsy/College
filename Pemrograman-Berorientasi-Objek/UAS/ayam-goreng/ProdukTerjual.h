#ifndef PRODUKTERJUAL_H
#define PRODUKTERJUAL_H
#include <string>

using namespace std;

// ==== DEKLARASI PRODUK TERJUAL CLASS ====
class ProdukTerjual{
private:
    int idPenjualan;
    string tanggal;
    string namaProduk;
    int jumlah;
    double harga;

public:
    // ==== CONSTRUKTOR PRODUK TERJUAL ====
    ProdukTerjual(int id, string tgl, string nama, int jml, double hrg);

    // ==== GETTER PRODUK TERJUAL ====
    int getidPenjualan() const { return idPenjualan; }
    string gettanggal() const { return tanggal; }
    string getnamaProduk() const { return namaProduk; }
    int getjumlah() const { return jumlah; }
    double getharga() const { return harga; }

    // ==== DISPLAY INFO PRODUK TERJUAL ====
    void displayInfo();

};

#endif