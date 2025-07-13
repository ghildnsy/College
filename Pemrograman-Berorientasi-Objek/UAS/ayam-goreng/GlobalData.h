#ifndef GLOBALDATA_H
#define GLOBALDATA_H

#include <vector>
#include "Produk.h"
#include "ProdukTerjual.h"
#include "User.h"

using namespace std;

// ==== DEKLARASI VARIABEL GLOBAL ====
extern vector<Produk> daftarProduk;
extern vector<ProdukTerjual> daftarPenjualan;
extern vector<User*> users; 

// ==== DEKLARASI VARIABEL ID ====
int generateProdukId();
int generatePenjualanId();
void loadLastIdFromFile();
void saveLastIdToFile();

// ==== DEKLARASI FUNGSI UNTUK LOAD DATA ====
void loadProdukFromFile();
void loadPenjualanFromFile();
void loadUsersFromFile();

// ==== DEKLARASI FUNGSI UNTUK SAVE DATA ====
void saveUsersToFile();
void savePenjualanToFile();

#endif
