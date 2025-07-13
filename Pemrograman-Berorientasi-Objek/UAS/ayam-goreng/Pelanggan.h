#ifndef PELANGGAN_H
#define PELANGGAN_H

#include "User.h"
#include <string>

using namespace std;

// ==== DEKLARASI PELANGGAN CLASS ====
// class pelanggan ini merupakan turunan dari class User
class Pelanggan : public User {
private:
    string namaLengkap;
public:
    // ==== CONSTRUKTOR PELANGGAN ====
    Pelanggan(int id, string uname, string pwd, string nama);

    // ==== DISPLAY INFO PELANGGAN ====
    void displayInfo() override;

    // ==== LIHAT MENU PRODUK ====
    void lihatMenu();

    // ==== GETTER NAMA LENGKAP PELANGGAN ====
    string getNamaLengkap() const;
};

#endif