#include "GlobalData.h"
#include "Produk.h"
#include "ProdukTerjual.h"
#include "User.h"
#include "Admin.h"
#include "Kasir.h"
#include "Pelanggan.h"
#include <iostream>
#include <vector>
#include <string>
#include <fstream>
#include <sstream>

using namespace std;

// ==== DEKLARASI VARIABEL GLOBAL ====
vector<Produk> daftarProduk;
vector<ProdukTerjual> daftarPenjualan;

// vector<User*> users; 

int lastProdukId = 0;
int lastPenjualanId = 0;

// ==== LOAD LAST ID DARI FILE ====
// ambil id terakhir dari file buat keperluan auto increment
void loadLastIdFromFile() {
    ifstream file("last_id.txt");
    if (file.is_open()) {
        file >> lastProdukId >> lastPenjualanId;
        file.close();
    } 
}

// ==== SAVE LAST ID KE FILE ====
// simpan id terakhir ke file agar tidak hilang saat program ditutup
void saveLastIdToFile() {
    ofstream file("last_id.txt");
    if (file.is_open()) {
        file << lastProdukId << " " << lastPenjualanId;
        file.close();
    }
}

// ==== GENERATE ID UNTUK PRODUK ====
int generateProdukId() {
    lastProdukId++;
    saveLastIdToFile();
    return lastProdukId;
}

// ==== GENERATE ID UNTUK PENJUALAN ====
int generatePenjualanId() {
    lastPenjualanId++;
    saveLastIdToFile();
    return lastPenjualanId;
}

// ==== LOAD PENJUALAN DARI FILE ====
void loadPenjualanFromFile() {
    ifstream file("penjualan.txt");
    if (!file.is_open()) return;

    string line;
    while (getline(file, line)) {
        stringstream ss(line);
        string idStr, tanggal, namaProduk, jumlahStr, hargaStr;

        getline(ss, idStr, ',');
        getline(ss, tanggal, ',');
        getline(ss, namaProduk, ',');
        getline(ss, jumlahStr, ',');
        getline(ss, hargaStr);

        int id = stoi(idStr);
        int jumlah = stoi(jumlahStr);
        double harga = stod(hargaStr);

        daftarPenjualan.push_back(ProdukTerjual(id, tanggal, namaProduk, jumlah, harga));
    }
    file.close();
}
// ==== LOAD PRODUK DARI FILE ==== 
void loadProdukFromFile() {
    ifstream file("produk_baku.txt");
    // variavel untuk menyimpan data hsil konversi
    int id, stok;
    string nama;
    double harga;

    string line;
    // membaca tiap baris
    while (getline(file, line)) {
        stringstream ss(line); // gunakan stringstream untuk memecah baris
        string idStr, namaStr, stokStr, hargastr; // variabel untuk menyimpan string sementara
        
        // memecah string berdasarkan koma
        getline(ss, idStr, ',');
        getline(ss, namaStr, ',');
        getline(ss, stokStr, ',');
        getline(ss, hargastr, ',');

        // konversi string ke tipe data yang sesuai
        id = stoi(idStr); // stoi untuk mengkonversi string ke integer
        nama = namaStr;
        stok = stoi(stokStr); // stoi untuk mengkonversi string ke integer
        harga = stod(hargastr); // stod untuk mengkonversi string ke double

        daftarProduk.push_back(Produk(id, nama, stok, harga));
    }

    file.close();
}

// ==== LOAD DATA USER DARI FILE ====
Admin* globalAdmin = nullptr;
void loadUsersFromFile() {
    ifstream file("users.txt");
    if (!file.is_open()) return;

    string line;
    while (getline(file, line)) {
        stringstream ss(line);
        string idStr, username, password, role, extraData;
        
        getline(ss, idStr, ',');
        getline(ss, username, ',');
        getline(ss, password, ',');
        getline(ss, role, ',');
        getline(ss, extraData);  // Untuk data tamproduk (idAdmin/idKasir/namaLengkap)

        int id = stoi(idStr);

        // role menentukan jenis user yang akan dibuat
        if (role == "Admin") {
            Admin* admin = new Admin(id, username, password, extraData);
            users.push_back(admin);
            globalAdmin = admin; // simpan admin sebagai fungsi global
        } 
        else if (role == "Kasir") {
            if (globalAdmin != nullptr) {
                users.push_back(new Kasir(id, username, password, extraData, globalAdmin));
            } else {
                cerr << "Error: Admin belum dibuat sebelum Kasir. Pastikan urutan di file users.txt benar.\n";
            }
        }
        else if (role == "Pelanggan") {
            users.push_back(new Pelanggan(id, username, password, extraData));
        }
    }
    file.close();
}

// ==== SAVE DATA USER KE FILE ====
void saveUsersToFile() {
    ofstream file("users.txt");
    for (User* user : users) {
        file << user->getId() << ","
             << user->getUsername() << ","
             << user->getPassword() << ","
             << user->getRole() << ",";

        // simpan data tamproduk sesuai role
        if (user->getRole() == "Admin") {
            Admin* admin = dynamic_cast<Admin*>(user);
            file << admin->getIdAdmin();
        }
        else if (user->getRole() == "Kasir") {
            Kasir* kasir = dynamic_cast<Kasir*>(user);
            file << kasir->getIdKaryawan();
        }
        else if (user->getRole() == "Pelanggan") {
            Pelanggan* pelanggan = dynamic_cast<Pelanggan*>(user);
            file << pelanggan->getNamaLengkap();
        }
        file << "\n";
    }
    file.close();
}



