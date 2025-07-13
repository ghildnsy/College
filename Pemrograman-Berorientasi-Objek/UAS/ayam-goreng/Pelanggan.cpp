#include "Pelanggan.h"
#include "User.h"
#include <iostream>
#include "GlobalData.h"
#include <iomanip>

using namespace std;

// ==== CONSTRUKTOR PELANGGAN ====
// class pelanggan merupakan turunan dari class User
Pelanggan::Pelanggan(int id, string uname, string pwd, string nama)
    : User(id, uname, pwd, "Pelanggan"), namaLengkap(nama) {}

// ==== DISPLAY INFO PELANGGAN ====
void Pelanggan::displayInfo()
{
    cout << "\n===================================" << endl;
    cout << "         INFO PELANGGAN            " << endl;
    cout << "===================================" << endl;
    cout << left << setw(15) << "Username"     << ": " << username     << endl;
    cout << left << setw(15) << "Nama Lengkap" << ": " << namaLengkap << endl;
    cout << "-----------------------------------" << endl;
}


// ==== LIHAT MENU PRODUK ====
void Pelanggan::lihatMenu()
{
    cout << "\n---------------------------------------------------------" << endl;
    cout << "| " << setw(3) << left << "ID"
         << " | " << setw(20) << left << "Nama Produk"
         << " | " << setw(5) << right << "Stok"
         << " | " << setw(17) << right << "Harga/unit"
         << " |" << endl;
    cout << "---------------------------------------------------------" << endl;

    int id = 1;
    for (const Produk &produk : daftarProduk)
    {
        cout << "| " << setw(3) << left << id++
             << " | " << setw(20) << left << produk.getnamaProduk()
             << " | " << setw(5) << right << produk.getstok()
             << " | " << "Rp" << setw(10) << right << produk.getharga()
             << " |" << endl;
    }

    cout << "+--------------------------------------------------------+" << endl;
}

// ==== GETTER NAMA LENGKAP PELANGGAN ====
string Pelanggan::getNamaLengkap() const
{
    return namaLengkap;
}