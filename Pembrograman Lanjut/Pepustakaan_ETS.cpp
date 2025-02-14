#include <iostream> // Mengimpor library untuk input-output
#include <string>   // Mengimpor library untuk menangani tipe data string
using namespace std; // Menggunakan namespace standar untuk mempermudah akses fungsi-fungsi standar

// Array of struct
struct Buku {
    string kode;    // Menyimpan kode buku
    string judul;   // Menyimpan judul buku
    string penulis; // Menyimpan nama penulis buku
    string penerbit;// Menyimpan nama penerbit buku
    int stock;      // Menyimpan jumlah stock buku
};

// Prototipe fungsi
void tambahBuku(Buku *&buku, int &n); // Fungsi untuk menambah buku
void ubahBuku(Buku *buku, int n);     // Fungsi untuk mengubah data buku
void hapusBuku(Buku *&buku, int &n);  // Fungsi untuk menghapus buku
void tampilkanBuku(Buku *buku, int n, int index = 0); // Fungsi untuk menampilkan buku secara rekursif
int lanjutkanOperasi(const string &pesan); // Fungsi untuk menanyakan apakah ingin melanjutkan operasi atau tidak
void lanjutkan4(); // Fungsi khusus untuk pilihan di menu ke-4 (Tampilkan Buku)

int main() {
    int pilihan, jumlahBuku = 0;   // Deklarasi variabel untuk menyimpan pilihan menu dan jumlah buku
    Buku *buku = nullptr;          // Pointer ke array dynamic untuk menyimpan data buku
    
    do {
        // Menampilkan menu utama
        cout << "\nMenu:\n";
        cout << "1. Tambah Data Buku\n";
        cout << "2. Ubah Data Buku\n";
        cout << "3. Hapus Data Buku\n";
        cout << "4. Tampilkan Data Buku\n";
        cout << "5. Keluar\n";
        cout << "Pilihan: ";
        cin >> pilihan;            // Input pilihan pengguna
        cin.ignore();              // Membersihkan buffer input
        
        // Memilih tindakan berdasarkan pilihan
        switch (pilihan) {
            case 1:
                do {
                    tambahBuku(buku, jumlahBuku); // Menambah data buku
                } while (lanjutkanOperasi("Tambah buku lain?")); // memberikan user pilihan untuk menambah buku lain
                break;
            case 2:
                do {
                    ubahBuku(buku, jumlahBuku);   // Mengubah data buku
                } while (lanjutkanOperasi("Ubah buku lain?")); // memberikan user pilihan untuk mengubah buku lain
                break;
            case 3:
                do {
                    hapusBuku(buku, jumlahBuku);  // Menghapus buku
                } while (lanjutkanOperasi("Hapus buku lain?")); // memberikan user pilihan untuk menghapus buku lain
                break;
            case 4:
                tampilkanBuku(buku, jumlahBuku);  // Menampilkan data buku
                lanjutkan4(); // memberikan user pilihan ke menu utama atau keluar
                break;
            case 5:
                cout << "Keluar dari program.\n"; // Output yang ditampilkan kepada user saat keluar dari program
                break;
            default:
                cout << "Pilihan tidak valid.\n"; // Output yang ditampilkan kepada user saat pilihan tidak valid
        }
    } while (pilihan != 5); // mengulangi program selama pengguna tidak memilih keluar
    
    delete[] buku; // Menghapus alokasi memori untuk array buku saat program berakhir
    return 0;      // Mengakhiri program dengan status 0 (berhasil)
}

// PROSEDUR
// Untuk menambah buku
void tambahBuku(Buku *&buku, int &n) {
    Buku *temp = new Buku[n + 1]; // Membuat array baru yang lebih besar dengan menambah ukuran 1 elemen
    
    // Memasukkan buku baru ke indeks pertama
    cout << "Masukkan kode buku: ";
    getline(cin, temp[0].kode);
    cout << "Masukkan judul buku: ";
    getline(cin, temp[0].judul);
    cout << "Masukkan penulis buku: ";
    getline(cin, temp[0].penulis);
    cout << "Masukkan penerbit buku: ";
    getline(cin, temp[0].penerbit);
    cout << "Masukkan jumlah stock: ";
    cin >> temp[0].stock;  // Input jumlah stock
    cin.ignore();          // Membersihkan buffer input

    // Memindahkan buku lama ke indeks berikutnya
    for (int i = 0; i < n; ++i) {
        temp[i + 1] = buku[i];
    }
    
    delete[] buku; // Menghapus array lama
    buku = temp;   // Mengarahkan pointer buku ke array baru
    ++n;           // Menambah jumlah buku
    
    cout << "Buku berhasil ditambahkan di depan!\n"; // Output yang ditampilkan kepada user saat berhasil menambahkan buku
}

// Untuk mengubah data buku
void ubahBuku(Buku *buku, int n) {
    string kodeCari;
    cout << "Masukkan kode buku yang ingin diubah: ";
    getline(cin, kodeCari); // Input kode buku yang ingin diubah
    
    // Mencari buku berdasarkan kode
    for (int i = 0; i < n; ++i) {
        if (buku[i].kode == kodeCari) {
            // Jika ditemukan, minta input untuk data yang baru
            cout << "Masukkan judul buku baru: ";
            getline(cin, buku[i].judul); // Input judul baru
            cout << "Masukkan penulis buku baru: ";
            getline(cin, buku[i].penulis); // Input penulis baru baru
            cout << "Masukkan penerbit buku baru: ";
            getline(cin, buku[i].penerbit); // Input penerbit baru
            cout << "Masukkan jumlah stock baru: ";
            cin >> buku[i].stock; // Input stock baru
            cin.ignore();
            cout << "Data buku berhasil diubah!\n"; // Output yang ditampilkan kepada user saat berhasil mengubah buku
            return;
        }
    }
    cout << "Buku dengan kode " << kodeCari << " tidak ditemukan.\n"; // Jika buku tidak ditemukan
}

// Untuk menghapus data buku
void hapusBuku(Buku *&buku, int &n) {
    string kodeCari;
    cout << "Masukkan kode buku yang ingin dihapus: ";
    getline(cin, kodeCari); // Input kode buku yang ingin dihapus
    
    // Mencari buku berdasarkan kode
    for (int i = 0; i < n; ++i) {
        if (buku[i].kode == kodeCari) {
            Buku *temp = new Buku[n - 1]; // Membuat array baru dengan ukuran lebih kecil
            for (int j = 0, k = 0; j < n; ++j) {
                if (j != i) {
                    temp[k++] = buku[j]; // Menyalin data kecuali buku yang dihapus
                }
            }
            delete[] buku; // Menghapus array lama
            buku = temp;   // Mengarahkan pointer buku ke array baru
            --n;           // Mengurangi jumlah buku
            cout << "Buku berhasil dihapus!\n"; // Pesan sukses
            return; // Keluar dari fungsi setelah buku dihapus
        }
    }
    cout << "Buku dengan kode " << kodeCari << " tidak ditemukan.\n"; // Jika buku tidak ditemukan
}

// Fungsi khusus untuk menu ke-4 (Tampilkan Data Buku) - hanya kembali ke menu utama atau keluar
void lanjutkan4() {
    int pilihan;
    do {
        // Menampilkan opsi setelah menampilkan data buku
        cout << "Kembali ke menu utama atau keluar? (1: Kembali ke menu utama, 2: Keluar): ";
        cin >> pilihan;
        cin.ignore(); // Mengabaikan newline di buffer
        if (pilihan == 2) {
            exit(0); // Keluar dari program
        }
    } while (pilihan != 1); // Pilihan 1: Kembali ke menu utama
}

// Rekursif untuk menampilkan data buku
void tampilkanBuku(Buku *buku, int n, int index) {
    if (n == 0) {
        // Jika tidak ada buku di dalam library
        cout << "Belum ada buku dalam library.\n";
        return;
    }
    if (index == n) return; // Basis rekursi jika sudah sampai akhir
    // Menampilkan data buku
    cout << "Kode Buku: " << buku[index].kode << endl;
    cout << "Judul: " << buku[index].judul << endl;
    cout << "Penulis: " << buku[index].penulis << endl;
    cout << "Penerbit: " << buku[index].penerbit << endl;
    cout << "Stock: " << buku[index].stock << endl;
    cout << "-------------------------\n";
    tampilkanBuku(buku, n, index + 1); // Rekursi untuk buku berikutnya
}


// FUNGSI
// Fungsi untuk melanjutkan operasi
int lanjutkanOperasi(const string &pesan) {
    int pilihan;
    do {
        // Menampilkan pertanyaan kepada pengguna apakah ingin melanjutkan operasi
        cout << pesan << " (1: Ya, 2: Kembali ke menu utama, 3: Keluar): ";
        cin >> pilihan;
        cin.ignore(); // Mengabaikan newline di buffer
        if (pilihan == 3) {
            exit(0); // Keluar dari program
        }
    } while (pilihan != 1 && pilihan != 2); // Ulangi sampai pengguna memilih pilihan yang valid
    return pilihan == 1; // Mengembalikan true jika pengguna memilih 1 (Ya)
}
