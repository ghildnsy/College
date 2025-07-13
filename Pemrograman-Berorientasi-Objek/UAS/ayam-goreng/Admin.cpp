#include "Admin.h"
#include "Produk.h"
#include "GlobalData.h"
#include "ProdukTerjual.h"
#include <iostream>
#include <vector>
#include <fstream>
#include <string>
#include <limits>
#include <map>
#include <sstream>
#include <iomanip>

using namespace std;

// ==== DEKLARASI FUNGSI UNTUK SAVE DATA KE FILE ====

// CONSTRUKTOR ADMIN
Admin::Admin(int id, string uname, string pwd, string idAdmin)
    : User(id, uname, pwd, "Admin"), idAdmin(idAdmin) {}

// FUNGSI TAMPILKAN MENU ADMIN
void Admin::tampilkanMenuAdmin()
{
    cout << "\n+===================================+" << endl;
    cout << "|           MENU ADMIN             |" << endl;
    cout << "+===================================+" << endl;
    cout << "| 1. Tambah Produk                 |" << endl;
    cout << "| 2. Lihat Stok Produk             |" << endl;
    cout << "| 3. Update Stok Produk            |" << endl;
    cout << "| 4. Hapus Produk                  |" << endl;
    cout << "| 5. Cari Produk                   |" << endl;
    cout << "| 6. Laporan Penjualan             |" << endl;
    cout << "| 0. Keluar                        |" << endl;
    cout << "+===================================+" << endl;
}

// FUNGSI TAMBAH PRODUK
void Admin::tambahProduk()
{
    string nama;
    int id, stok;
    double harga;

    id = generateProdukId(); // auto generate id
    cout << "\n---------------------------------------------------------" << endl;
    cout << "                TAMBAH PRODUK BARU                " << endl;
    cout << "---------------------------------------------------------" << endl;
    cout << " ID Produk       : " << id << endl;
    cout << "---------------------------------------------------------" << endl;
    cout << " Nama Produk     : ";
    getline(cin, nama);
    cout << "---------------------------------------------------------" << endl;
    cout << " Stok           : ";
    cin >> stok;
    cin.ignore(); // clear buffer
    cout << "---------------------------------------------------------" << endl;
    cout << " Harga per unit : ";
    cin >> harga;
    cout << "---------------------------------------------------------" << endl;

    daftarProduk.push_back(Produk(id, nama, stok, harga));
    cout << " Produk berhasil ditambahkan!                      " << endl;
    cout << "---------------------------------------------------------" << endl;

    this->saveProdukToFile(); // langsung simpan ke file
}

// FUNGSI LIHAT STOK
void Admin::lihatStok()
{
    if (daftarProduk.empty())
    {
        cout << "Tidak ada produk tersedia." << endl;
    }
    else
    {
        cout << "\n---------------------------------------------------------" << endl;
        cout << "| ID  | Nama Produk          | Stok  | Harga/unit        |" << endl;
        cout << "---------------------------------------------------------" << endl;
        for (Produk &produk : daftarProduk)
        {
            produk.displayInfo(); // show info Produk
        }
        cout << "+--------------------------------------------------------+" << endl;
    }
}

// FUNGSI UPDATE STOK
void Admin::updateStok()
{
    string nama;
    int jumlah;

    cout << "\n---------------------------------------------------------" << endl;
    cout << "                UPDATE STOK PRODUK               " << endl;
    cout << "---------------------------------------------------------" << endl;
    cout << " Nama Produk     : ";
    getline(cin, nama);
    cout << "---------------------------------------------------------" << endl;
    cout << " Jumlah         : ";
    cin >> jumlah;
    cout << "---------------------------------------------------------" << endl;

    if (jumlah == 0)
    {
        cout << " Error: Jumlah tidak boleh 0." << endl;
        cout << "---------------------------------------------------------" << endl;
        return; // langsung keluar dari fungsi
    }

    bool found = false;
    for (Produk &produk : daftarProduk)
    {
        if (produk.getnamaProduk() == nama)
        {
            found = true; // ditemuin dulu baru proses
            if (jumlah > 0)
            {
                produk.tambahStok(jumlah);
                cout << " Stok produk " << nama << " berhasil ditambahkan!" << endl;
                cout << " Stok sekarang: " << produk.getstok() << endl;
            }
            else
            {
                if (produk.getstok() >= -jumlah)
                {
                    produk.kurangiStok(-jumlah);
                    cout << " Stok produk " << nama << " berhasil dikurangi!" << endl;
                    cout << " Stok sekarang: " << produk.getstok() << endl;
                }
                else
                {
                    cout << " Error: Stok tidak mencukupi!" << endl;
                }
            }
            cout << "---------------------------------------------------------" << endl;
            this->saveProdukToFile(); // simpan peruproduk
            break;
        }
    }
    if (!found)
    {
        cout << " Produk " << nama << " tidak ditemukan!" << endl;
        cout << "---------------------------------------------------------" << endl;
    }
}

// FUNGSI HAPUS PRODUK
void Admin::hapusProduk()
{
    string nama;
    cout << "Nama Produk yang ingin dihapus: ";
    cin >> nama;

    bool found = false;
    for (auto it = daftarProduk.begin(); it != daftarProduk.end(); ++it)
    {
        if (it->getnamaProduk() == nama)
        {
            daftarProduk.erase(it);
            cout << "Produk " << nama << " berhasil dihapus!" << endl;
            this->saveProdukToFile(); // simpan ke file
            found = true;
            break;
        }
    }
    if (!found)
    {
        cout << "Produk " << nama << " tidak ditemukan!" << endl;
    }
}

// FUMGSI CARI PRODUK
void Admin::cariProduk()
{
    string keyword;
    cout << "Cari Produk: ";
    getline(cin, keyword);
    bool found = false;
    for (Produk &produk : daftarProduk)
    {
        if (produk.getnamaProduk().find(keyword) != string::npos)
        {
            produk.displayInfo();
            found = true;
        }
    }
    if (!found)
    {
        cout << "Tidak ada produk yang ditemukan dengan keyword '" << keyword << "'." << endl;
    }
}

// FUNGSI LAPORAN PENJUALAN
void Admin::laporanPenjualan() {
    loadPenjualanFromFile(); // readfile penjualan.txt 

    cout << "\n+=================================================================================+" << endl;
    cout << "|                             LAPORAN PENJUALAN                                   |" << endl;
    cout << "+=================================================================================+" << endl;

    if (daftarPenjualan.empty()) {
        cout << "| Tidak ada data penjualan.                                                      |\n";
        cout << "+=================================================================================+" << endl;
        return;
    }

    // header tabel
    cout << left
         << "| " << setw(5) << "ID"
         << "| " << setw(16) << "Tanggal"
         << "| " << setw(20) << "Produk"
         << "| " << setw(6) << "Qty"
         << "| " << setw(10) << "Harga"
         << "| " << setw(12) << "Subtotal" << " |" << endl;
    cout << "+---------------------------------------------------------------------------------+" << endl;

    int total = 0;
    map<string, int> rekapProduk; //rangkuman penjualan per produk

    // isi tabel
    for (auto& p : daftarPenjualan) {
        int subtotal = p.getjumlah() * p.getharga();
        total += subtotal;

        // save ke map untuk rangkman
        rekapProduk[p.getnamaProduk()] += p.getjumlah();

        cout << "| " << setw(5)  << p.getidPenjualan()
             << "| " << setw(16) << p.gettanggal()
             << "| " << setw(20) << p.getnamaProduk()
             << "| " << setw(6)  << p.getjumlah()
             << "| Rp" << setw(8) << p.getharga()
             << "| Rp" << setw(10) << subtotal << " |" << endl;
    }

    cout << "+---------------------------------------------------------------------------------+" << endl;

    // nampilin total
    cout << "| " << setw(63) << right << "TOTAL"
         << " | Rp" << setw(10) << total << " |" << endl;
    cout << "+=================================================================================+" << endl;

    // nampilin rekap produk
    cout << "\n+======================== REKAP PENJUALAN PER PRODUK ========================+" << endl;
    cout << "| Produk                | Jumlah Terjual |" << endl;
    cout << "+------------------------+-----------------+" << endl;
    for (const auto& entry : rekapProduk) {
        cout << "| " << left << setw(22) << entry.first
             << "| " << right << setw(15) << entry.second << " |" << endl;
    }
}

// TAMPILKAN MENU ADMIN
void Admin::manajemenStok()
{
    int choice;
    do
    {
        tampilkanMenuAdmin();
        cout << "Masukkan Pilihan: ";
        cin >> choice;
        cin.ignore(); // biar aman dari sisa input

        switch (choice)
        {
        case 1:
            tambahProduk();
            break;
        case 2:
            lihatStok();
            break;
        case 3:
            updateStok();
            break;
        case 4:
            hapusProduk();
            break;
        case 5:
            cariProduk();
            break;
        case 6:
            laporanPenjualan();
            break;
            cout << "Kembali ke menu sebelumnya.\n";
            break;
        case 0:
            saveProdukToFile(); // simpan sebelum keluar
            cout << "Keluar dari program.\n";
            break;
        default:
            cout << "Pilihan tidak valid.\n";
        }
    } while (choice != 0);
}

// === FUNGSI UNTUK SIMPAN PRODUK KE FILE ===
void Admin::saveProdukToFile()
{
    ofstream file("produk_baku.txt");
    for (const Produk &produk : daftarProduk)
    {
        file << produk.getidProduk() << ","
             << produk.getnamaProduk() << ","
             << produk.getstok() << ","
             << produk.getharga() << "\n";
    }
    file.close();
}

// === FUNGSI UNTUK LOAD PENJUALAN DARI FILE ===
void Admin::loadPenjualanFromFile() {
    daftarPenjualan.clear();
    ifstream file("penjualan.txt");
    if (!file.is_open()) return;

    int id, jumlah, harga;
    string tanggal, namaProduk, line;

    while (getline(file, line)) {
        stringstream ss(line);
        string token;
        getline(ss, token, ',');
        id = stoi(token);
        getline(ss, tanggal, ',');
        getline(ss, namaProduk, ',');
        getline(ss, token, ',');
        jumlah = stoi(token);
        getline(ss, token, ',');
        harga = stoi(token);

        daftarPenjualan.push_back(ProdukTerjual(id, tanggal, namaProduk, jumlah, harga));
    }

    file.close();
}
