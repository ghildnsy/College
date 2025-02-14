#include <iostream>
#include <string>
#include <limits>
using namespace std;

// Fungsi untuk membersihkan buffer input
void clearInputBuffer() {
    cin.clear();
    cin.ignore(numeric_limits<streamsize>::max(), '\n');
}

struct Node {
    int nim;
    string nama;
    Node* left;
    Node* right;
    Node(int n, string nm) : nim(n), nama(nm), left(nullptr), right(nullptr) {}
};

class BST {
private:
    Node* root;
    Node* insertMh(Node* node, int nim, string nama);
    Node* deleteMh(Node* node, int nim);
    Node* findMin(Node* node);
    void inorderMh(Node* node);
    Node* searchMh(Node* node, int nim);

    // Helper function untuk validasi NIM
    bool isValidNIM(int nim) {
        return (nim > 0 && nim >= 10000 && nim <= 9999999999);
    }

public:
    BST() : root(nullptr) {}
    void insert(int nim, string nama);
    void remove(int nim);
    void search(int nim);
    void display();
};

// Implementasi fungsi insert
Node* BST::insertMh(Node* node, int nim, string nama) {
    if (node == nullptr) {
        return new Node(nim, nama);
    }

    if (nim < node->nim) {
        node->left = insertMh(node->left, nim, nama);
    } else if (nim > node->nim) {
        node->right = insertMh(node->right, nim, nama);
    } else {
        cout << "NIM " << nim << " sudah ada dalam sistem!" << endl;
    }

    return node;
}

void BST::insert(int nim, string nama) {
    root = insertMh(root, nim, nama);
    cout << "Data mahasiswa berhasil ditambahkan!" << endl;
}

// Implementasi fungsi search
Node* BST::searchMh(Node* node, int nim) {
    if (node == nullptr || node->nim == nim) {
        return node;
    }

    if (nim < node->nim) {
        return searchMh(node->left, nim);
    }
    return searchMh(node->right, nim);
}

void BST::search(int nim) {
    Node* result = searchMh(root, nim);
    if (result) {
        cout << "Mahasiswa ditemukan!" << endl;
        cout << "NIM  : " << result->nim << endl;
        cout << "Nama : " << result->nama << endl;
    } else {
        cout << "Mahasiswa dengan NIM " << nim << " tidak ditemukan." << endl;
    }
}

// Implementasi fungsi delete
Node* BST::findMin(Node* node) {
    while (node->left != nullptr) {
        node = node->left;
    }
    return node;
}

Node* BST::deleteMh(Node* node, int nim) {
    if (node == nullptr) {
        cout << "Mahasiswa dengan NIM " << nim << " tidak ditemukan." << endl;
        return nullptr;
    }

    if (nim < node->nim) {
        node->left = deleteMh(node->left, nim);
    } else if (nim > node->nim) {
        node->right = deleteMh(node->right, nim);
    } else {
        // Node dengan satu atau tidak ada anak
        if (node->left == nullptr) {
            Node* temp = node->right;
            delete node;
            return temp;
        } else if (node->right == nullptr) {
            Node* temp = node->left;
            delete node;
            return temp;
        }

        // Node dengan dua anak
        Node* temp = findMin(node->right);
        node->nim = temp->nim;
        node->nama = temp->nama;
        node->right = deleteMh(node->right, temp->nim);
    }
    return node;
}

void BST::remove(int nim) {
    Node* result = searchMh(root, nim);
    if (result) {
        root = deleteMh(root, nim);
        cout << "Data mahasiswa dengan NIM " << nim << " berhasil dihapus!" << endl;
    } else {
        cout << "Data mahasiswa dengan NIM " << nim << " tidak ditemukan!" << endl;
    }
}

// Implementasi fungsi display
void BST::inorderMh(Node* node) {
    if (node != nullptr) {
        inorderMh(node->left);
        cout << "NIM: " << node->nim << ", Nama: " << node->nama << endl;
        inorderMh(node->right);
    }
}

void BST::display() {
    if (root == nullptr) {
        cout << "BST kosong!" << endl;
        return;
    }
    cout << "\nDaftar Mahasiswa (urut berdasarkan NIM):" << endl;
    inorderMh(root);
    cout << endl;
}

// Fungsi untuk memvalidasi input menu
int getValidMenuChoice() {
    int choice;
    while (true) {
        if (cin >> choice) {
            clearInputBuffer();
            if (choice >= 1 && choice <= 5) {
                return choice;
            }
            cout << "Error: Pilihan harus antara 1-5" << endl;
        } else {
            cout << "Error: Masukkan angka yang valid" << endl;
            clearInputBuffer();
        }
        cout << "Pilihan: ";
    }
}

// Fungsi untuk memvalidasi input NIM
int getValidNIM() {
    int nim;
    while (true) {
        if (cin >> nim) {
            clearInputBuffer();
            if (nim > 0) {
                return nim;
            }
            cout << "Error: NIM harus berupa angka positif" << endl;
        } else {
            cout << "Error: Masukkan NIM yang valid (angka)" << endl;
            clearInputBuffer();
        }
        cout << "Masukkan NIM: ";
    }
}

// Fungsi untuk memvalidasi input nama
string getValidNama() {
    string nama;
    while (true) {
        getline(cin, nama);
        if (!nama.empty() && nama.length() <= 25) {
            // Validasi karakter nama (hanya huruf dan spasi)
            bool valid = true;
            for (char c : nama) {
                if (!isalpha(c) && !isspace(c)) {
                    valid = false;
                    break;
                }
            }
            if (valid) return nama;
        }
        cout << "Error: Nama harus berisi huruf dan spasi (maks. 25 karakter)" << endl;
        cout << "Masukkan Nama: ";
    }
}

int main() {
    BST bst;
    int pilihan;

    do {
        cout << "\n=== SISTEM MANAJEMEN DATA MAHASISWA ===" << endl;
        cout << "1. Tambah Data Mahasiswa" << endl;
        cout << "2. Cari Data Mahasiswa" << endl;
        cout << "3. Hapus Data Mahasiswa" << endl;
        cout << "4. Tampilkan Semua Data" << endl;
        cout << "5. Keluar" << endl;
        cout << "Pilihan: ";
        
        pilihan = getValidMenuChoice();

        switch (pilihan) {
            case 1: {
                cout << "Masukkan NIM: ";
                int nim = getValidNIM();
                cout << "Masukkan Nama: ";
                string nama = getValidNama();
                bst.insert(nim, nama);
                break;
            }

            case 2: {
                cout << "Masukkan NIM yang dicari: ";
                int nim = getValidNIM();
                bst.search(nim);
                break;
            }

            case 3: {
                cout << "Masukkan NIM yang akan dihapus: ";
                int nim = getValidNIM();
                bst.remove(nim);
                break;
            }

            case 4:
                bst.display();
                break;

            case 5:
                cout << "Terima kasih telah menggunakan sistem ini!" << endl;
                break;
        }
    } while (pilihan != 5);

    return 0;
}