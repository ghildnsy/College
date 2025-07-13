#include "Kasir.h"
#include "ProdukTerjual.h"
#include "Produk.h"
#include "User.h"
#include "Admin.h"
#include "GlobalData.h"
#include <iostream>
#include <vector>
#include <string>
#include <limits>
#include <ctime>
#include <iomanip>
#include <fstream>

using namespace std;

// ==== DEKLARASI FUNGSI UNTUK SAVE DATA KE FILE ====
void savePenjualanToFile(); // deklarasi fungsi untuk menyimpan penjualan ke file

// ==== CONSTRUCTOR KASIR ====
Kasir::Kasir(int id, string uname, string pwd, string idKaryawan, Admin *admin)
    : User(id, uname, pwd, "Kasir"), idKaryawan(idKaryawan), admin(admin) {}

// FUNGSI TAMPILKAN MENU KASIR
void Kasir::tampilkanMenuKasir()
{
    cout << "\n+===================================+" << endl;
    cout << "|           MENU KASIR             |" << endl;
    cout << "+===================================+" << endl;
    cout << "| 1. Catat Penjualan               |" << endl;
    cout << "| 2. Lihat Semua Stok              |" << endl;
    cout << "| 3. Cari Produk                   |" << endl;
    cout << "| 4. Laporan Penjualan             |" << endl;
    cout << "| 0. Keluar                        |" << endl;
    cout << "+===================================+" << endl;
    cout << " Pilih menu: ";
}

// FUNGSI CATAT PENJUALAN
void Kasir::catatPenjualan()
{
    int id = generatePenjualanId();
    string tgl;
    time_t now = time(0);
    tm *ltm = localtime(&now);
    char buffer[17];
    strftime(buffer, sizeof(buffer), "%d-%m-%Y %H:%M", ltm);
    tgl = buffer;

    cout << "\n---------------------------------------------------------" << endl;
    cout << "ID Penjualan: " << id << " | Tanggal: " << tgl << endl;
    cout << "---------------------------------------------------------" << endl;

    double totalHarga = 0;

    while (true)
    {
        string nama;
        cout << "Nama Produk (ENTER untuk selesai): ";
        getline(cin, nama);
        if (nama.empty())
            break;

        bool found = false;
        for (auto &produk : daftarProduk)
        {
            if (produk.getnamaProduk() == nama)
            {
                if (produk.getstok() == 0)
                {
                    cout << "Stok habis.\n";
                    continue;
                }

                int jumlah;
                cout << "Stok: " << produk.getstok() << ", Harga: Rp" << produk.getharga() << "\nJumlah: ";
                while (!(cin >> jumlah) || jumlah <= 0 || jumlah > produk.getstok())
                {
                    cout << "Jumlah tidak valid. Coba lagi: ";
                    cin.clear();
                    cin.ignore(numeric_limits<streamsize>::max(), '\n');
                }
                cin.ignore(numeric_limits<streamsize>::max(), '\n');

                double subTotal = jumlah * produk.getharga();
                produk.kurangiStok(jumlah);
                daftarPenjualan.push_back(ProdukTerjual(id, tgl, nama, jumlah, produk.getharga()));
                totalHarga += subTotal;
                savePenjualanToFile();
                admin->saveProdukToFile();
                found = true;
                break;
            }
        }
        if (!found)
            cout << "Produk tidak ditemukan.\n";
    }

    cout << "TOTAL BELANJA: Rp" << totalHarga << endl;
}

// FUNGSI LIHAT STOK
void Kasir::lihatStok()
{
    cout << "\n+--------------------------------------------------------+" << endl;
    cout << "| ID  | Nama Produk          | Stok  | Harga/unit        |" << endl;
    cout << "+--------------------------------------------------------+" << endl;
    if (daftarProduk.empty())
    {
        cout << "Tidak ada stok tersedia.\n";
    }
    else
    {
        for (Produk &b : daftarProduk)
        {
            b.displayInfo();
        }
    }
    cout << "+--------------------------------------------------------+" << endl;
}

// FUNGSI CARI PRODUK
void Admin::cariProduk()
{
    string keyword;
    cout << "Masukkan nama produk yang dicari: ";
    cin >> keyword;

    bool found = false;
    for (Produk &b : daftarProduk)
    {
        if (b.getnamaProduk().find(keyword) != string::npos)
        {
            b.displayInfo();
            found = true;
        }
    }

    if (!found)
        cout << "Produk tidak ditemukan." << endl;
}

// FUNGSI LAPORAN PENJUALAN
void Kasir::laporanPenjualan()
{
    cout << "\n---------------------------------------------------------" << endl;
    cout << "                LAPORAN PENJUALAN                   " << endl;
    cout << "---------------------------------------------------------" << endl;
    if (daftarPenjualan.empty())
    {
        cout << "Belum ada data penjualan." << endl;
        return;
    }

    cout << "| ID    | Tanggal           | Produk          | Jml | Total    |" << endl;
    cout << "---------------------------------------------------------" << endl;

    for (auto &p : daftarPenjualan)
    {
        p.displayInfo();
    }

    double total = 0;
    for (auto &p : daftarPenjualan)
    {
        total += p.getjumlah() * p.getharga();
    }

    cout << "---------------------------------------------------------" << endl;
    cout << " TOTAL PENDAPATAN: Rp" << total << endl;
}

// TAMPILAN MENU KASIR
void Kasir::kelolaPenjualan()
{
    int choice;
    do
    {
        tampilkanMenuKasir();
        cin >> choice;
        cin.ignore(numeric_limits<streamsize>::max(), '\n');

        switch (choice)
        {
        case 1:
            catatPenjualan();
            break;
        case 2:
            lihatStok();
            break;
        case 3:
            cariProduk();
            break;
        case 4:
            laporanPenjualan();
            break;
        case 0:
            savePenjualanToFile();
            admin->saveProdukToFile();
            cout << "Keluar dari menu kasir." << endl;
            break;
        default:
            cout << "Pilihan tidak valid." << endl;
        }
    } while (choice != 0);
}

// ==== FUNGSI UNTUK SIMPAN KE FILE ====
void Kasir::savePenjualanToFile()
{
    ofstream file("penjualan.txt", ios::app);
    for (auto &p : daftarPenjualan)
    {
        file << p.getidPenjualan() << ","
             << p.gettanggal() << ","
             << p.getnamaProduk() << ","
             << p.getjumlah() << ","
             << p.getharga() << "\n";
    }
    file.close();
    daftarPenjualan.clear(); // clear setelah disimpan agar tidak dobel saat append lagi
}