#include <iostream>
#include <fstream>
#include <string>
#include <vector>
#include <iomanip>

using namespace std;

// Struktur Node untuk AVL
struct AVLContactNode
{
    string name;
    string phoneNumber;
    AVLContactNode* left;
    AVLContactNode* right;
    int height;
};

// Struktur Node untuk BST
struct BSTContactNode
{
    string name;
    string phoneNumber;
    BSTContactNode* left;
    BSTContactNode* right;
};

// SEMUA FUNGSI AVL

// Fungsi untuk membuat node AVL
AVLContactNode* createAVLContactNode(string name, string phoneNumber)
{
    AVLContactNode* newAVLContactNode = new AVLContactNode;
    newAVLContactNode->name = name;
    newAVLContactNode->phoneNumber = phoneNumber;
    newAVLContactNode->left = nullptr;
    newAVLContactNode->right = nullptr;
    newAVLContactNode->height = 1;
    return newAVLContactNode;
}

// Fungsi untuk mendapatkan tinggi dari node AVL
int getAVLHeight(AVLContactNode* node) {
    return node ? node->height : 0;
}

// Fungsi untuk mendapatkan keseimbangan dari node AVL
int getBalance(AVLContactNode* node) {
    return node ? getAVLHeight(node->left) - getAVLHeight(node->right) : 0;
}

// Fungsi untuk memutar kanan
AVLContactNode* rotateRight(AVLContactNode* y) {
    AVLContactNode* x = y->left;
    AVLContactNode* T2 = x->right;
    x->right = y;
    y->left = T2;
    y->height = max(getAVLHeight(y->left), getAVLHeight(y->right)) + 1;
    x->height = max(getAVLHeight(x->left), getAVLHeight(x->right)) + 1;
    return x;
}

// Fungsi untuk memutar kiri
AVLContactNode* rotateLeft(AVLContactNode* x) {
    AVLContactNode* y = x->right;
    AVLContactNode* T2 = y->left;
    y->left = x;
    x->right = T2;
    x->height = max(getAVLHeight(x->left), getAVLHeight(x->right)) + 1;
    y->height = max(getAVLHeight(y->left), getAVLHeight(y->right)) + 1;
    return y;
}

// Fungsi pencarian untuk AVL
vector<pair<string, string>> findAVLContact(AVLContactNode* root, string name) {
    vector<pair<string, string>> results;
    
    if (root == nullptr) return results;
    
    if (name <= root->name && root->name <= name) {
        results.push_back({root->name, root->phoneNumber});
        // Rekursif ke kiri untuk mencari duplikat
        vector<pair<string, string>> leftResults = findAVLContact(root->left, name);
        results.insert(results.end(), leftResults.begin(), leftResults.end());
    }
    else if (name < root->name) {
        vector<pair<string, string>> leftResults = findAVLContact(root->left, name);
        results.insert(results.end(), leftResults.begin(), leftResults.end());
    }
    else {
        vector<pair<string, string>> rightResults = findAVLContact(root->right, name);
        results.insert(results.end(), rightResults.begin(), rightResults.end());
    }
    
    return results;
}

// Fungsi untuk menambahkan kontak di AVL
AVLContactNode* insertAVLContact(AVLContactNode* root, string name, string phoneNumber) {
    if (root == nullptr) {
        return createAVLContactNode(name, phoneNumber);
    }
    if (name <= root->name) {  // Ubah < menjadi <=
        root->left = insertAVLContact(root->left, name, phoneNumber);
    } else {
        root->right = insertAVLContact(root->right, name, phoneNumber);
    }

    root->height = 1 + max(getAVLHeight(root->left), getAVLHeight(root->right));
    
    int balance = getBalance(root);
    if (balance > 1 && name < root->left->name) {
        return rotateRight(root);
    }
    if (balance < -1 && name > root->right->name) {
        return rotateLeft(root);
    }
    if (balance > 1 && name > root->left->name) {
        root->left = rotateLeft(root->left);
        return rotateRight(root);
    }
    if (balance < -1 && name < root->right->name) {
        root->right = rotateRight(root->right);
        return rotateLeft(root);
    }
    return root;
}

// Menampilkan kontak untuk AVL
void inorderTraversalAVL(AVLContactNode* root, int& counter) {
    if (root == nullptr) return;

    inorderTraversalAVL(root->left, counter);
    counter++;
    cout << "| " << setw(5) << right << counter << " | "
         << left << setw(25) << root->name << " | "
         << left << setw(20) << root->phoneNumber << " |\n";
    inorderTraversalAVL(root->right, counter);
}

void displayContact(AVLContactNode *root) {
    const int width = 60;

    if (root == nullptr) {
        cout << "\nDaftar kontak kosong.\n";
        return;
    }

    // Cetak header tabel
    cout << "\n";
    cout << "+----------------------------------------------------------+\n";
    cout << "| No    | Nama                      | Nomor Telepon        |\n";
    cout << "+----------------------------------------------------------+\n";

    // Counter untuk nomor kontak
    int counter = 0;

    // Traversal inorder untuk mencetak kontak
    inorderTraversalAVL(root, counter);

    cout << "+------------------------------------------------------------+\n";
}

// Fungsi untuk menghapus kontak di AVL
AVLContactNode* removeAVLContact(AVLContactNode* root, string name) {
    if (root == nullptr) {
        cout << "Kontak '" << name << "' tidak ditemukan.\n";
        return root;
    }
    if (name < root->name) {
        root->left = removeAVLContact(root->left, name);
    } else if (name > root->name) {
        root->right = removeAVLContact(root->right, name);
    } else {
        if (root->left == nullptr) {
            AVLContactNode* temp = root->right;
            delete root;
            return temp;
        } else if (root->right == nullptr) {
            AVLContactNode* temp = root->left;
            delete root;
            return temp;
        }
        AVLContactNode* temp = root->right;
        while (temp && temp->left != nullptr) {
            temp = temp->left;
        }
        root->name = temp->name;
        root->phoneNumber = temp->phoneNumber;
        root->right = removeAVLContact(root->right, temp->name);
    }
    
    if (root == nullptr) return root;

    root->height = 1 + max(getAVLHeight(root->left), getAVLHeight(root->right));
    int balance = getBalance(root);
    if (balance > 1 && getBalance(root->left) >= 0) {
        return rotateRight(root);
    }
    if (balance > 1 && getBalance(root->left) < 0) {
        root->left = rotateLeft(root->left);
        return rotateRight(root);
    }
    if (balance < -1 && getBalance(root->right) <= 0) {
        return rotateLeft(root);
    }
    if (balance < -1 && getBalance(root->right) > 0) {
        root->right = rotateRight(root->right);
        return rotateLeft(root);
    }
    return root;
}

// SEMUA FUNGSI BST

// Fungsi untuk membuat node BST
BSTContactNode* createBSTContactNode(string name, string phoneNumber)
{
    BSTContactNode* newBSTContactNode = new BSTContactNode;
    newBSTContactNode->name = name;
    newBSTContactNode->phoneNumber = phoneNumber;
    newBSTContactNode->left = nullptr;
    newBSTContactNode->right = nullptr;
    return newBSTContactNode;
}

// Fungsi untuk mencari kontak di BST
vector<pair<string, string>> findBSTContact(BSTContactNode* root, string name) {
    vector<pair<string, string>> results;
    
    if (root == nullptr) return results;
    
    if (name <= root->name && root->name <= name) {
        results.push_back({root->name, root->phoneNumber});
        // Rekursif ke kiri untuk mencari duplikat
        vector<pair<string, string>> leftResults = findBSTContact(root->left, name);
        results.insert(results.end(), leftResults.begin(), leftResults.end());
    }
    else if (name < root->name) {
        vector<pair<string, string>> leftResults = findBSTContact(root->left, name);
        results.insert(results.end(), leftResults.begin(), leftResults.end());
    }
    else {
        vector<pair<string, string>> rightResults = findBSTContact(root->right, name);
        results.insert(results.end(), rightResults.begin(), rightResults.end());
    }
    
    return results;
}

// Fungsi untuk menambahkan kontak di BST
BSTContactNode* insertBSTContactNode(BSTContactNode* root, string name, string phoneNumber) {
    if (root == nullptr) {
        return createBSTContactNode(name, phoneNumber);
    }

    if (name <= root->name) {  // Ubah < menjadi <=
        root->left = insertBSTContactNode(root->left, name, phoneNumber);
    } else {
        root->right = insertBSTContactNode(root->right, name, phoneNumber);
    }

    return root;
}

// menampilkan kontak untuk BST
void inorderTraversalBST(BSTContactNode* root, int& counter) {
    if (root == nullptr) return;

    inorderTraversalBST(root->left, counter);
    counter++;
    cout << "| " << setw(5) << right << counter << " | "
         << left << setw(25) << root->name << " | "
         << left << setw(20) << root->phoneNumber << " |\n";
    inorderTraversalBST(root->right, counter);
}

void displayContact(BSTContactNode *root) {
    const int width = 60;

    if (root == nullptr) {
        cout << "\nDaftar kontak kosong.\n";
        return;
    }

    // Cetak header tabel
    cout << "\n";
    cout << "+------------------------------------------------------------+\n";
    cout << "| No    | Nama                      | Nomor Telepon          |\n";
    cout << "+------------------------------------------------------------+\n";

    // Counter untuk nomor kontak
    int counter = 0;

    // Traversal inorder untuk mencetak kontak
    inorderTraversalBST(root, counter);

    cout << "+------------------------------------------------------------+\n";
}

// Fungsi untuk menghapus kontak di BST
BSTContactNode* removeBSTContact(BSTContactNode* root, string name)
{
    if (root == nullptr)
    {
        cout << "Kontak '" << name << "' tidak ditemukan.\n";
        return root;
    }

    if (name < root->name)
    {
        root->left = removeBSTContact(root->left, name);
    }
    else if (name > root->name)
    {
        root->right = removeBSTContact(root->right, name);
    }
    else
    {
        if (root->left == nullptr)
        {
            BSTContactNode* temp = root->right;
            delete root;
            return temp;
        }
        else if (root->right == nullptr)
        {
            BSTContactNode* temp = root->left;
            delete root;
            return temp;
        }

        BSTContactNode* temp = root->right;
        while (temp && temp->left != nullptr)
        {
            temp = temp->left;
        }

        root->name = temp->name;
        root->phoneNumber = temp->phoneNumber;
        root->right = removeBSTContact(root->right, temp->name);
    }

    return root;
}

// FUNGSI FILE HANDLING

// Fungsi untuk memuat kontak dari file untuk AVL
void loadDataAVL(AVLContactNode* &root, const string &filename)
{
    ifstream file(filename);
    if (!file.is_open())
    {
        cout << "File '" << filename << "' tidak ditemukan. Membuat file baru.\n";
        return;
    }

    string line;
    while (getline(file, line))
    {
        size_t delimiterPos = line.find(":");
        if (delimiterPos != string::npos)
        {
            string name = line.substr(0, delimiterPos);
            string phoneNumber = line.substr(delimiterPos + 2);
            root = insertAVLContact(root, name, phoneNumber);
        }
    }

    file.close();
    cout << "Data berhasil dimuat dari file '" << filename << "'.\n";
}

// Fungsi untuk memuat kontak dari file untuk BST
void loadDataBST(BSTContactNode* &root, const string &filename)
{
    ifstream file(filename);
    if (!file.is_open())
    {
        cout << "File '" << filename << "' tidak ditemukan. Membuat file baru.\n";
        return;
    }

    string line;
    while (getline(file, line))
    {
        size_t delimiterPos = line.find(":");
        if (delimiterPos != string::npos)
        {
            string name = line.substr(0, delimiterPos);
            string phoneNumber = line.substr(delimiterPos + 2); // +2 untuk melewati ": "
            root = insertBSTContactNode(root, name, phoneNumber);
        }
    }

    file.close();
    cout << "Data berhasil dimuat dari file '" << filename << "'.\n";
}

// Fungsi untuk mencatat kontak ke file untuk AVL
void writeToFile(AVLContactNode* root, ofstream &file)
{
    if (root != nullptr)
    {
        writeToFile(root->left, file);
        file << root->name << ": " << root->phoneNumber << endl;
        writeToFile(root->right, file);
    }
}

// Fungsi untuk mencatat kontak ke file untuk BST
void writeToFile(BSTContactNode* root, ofstream &file)
{
    if (root != nullptr)
    {
        writeToFile(root->left, file);
        file << root->name << ": " << root->phoneNumber << endl;
        writeToFile(root->right, file);
    }
}

// Fungsi untuk menyimpan/mengupdate kontak yang sudah ditulis menjadi file
void saveContacts(BSTContactNode *bstRoot, AVLContactNode *avlRoot, int treeChoice)
{
    ofstream file("contacts.txt");
    if (file.is_open())
    {
        if (treeChoice == 1)
        {
            writeToFile(avlRoot, file);
        }
        else
        {
            writeToFile(bstRoot, file);
        }
        file.close();
    }
    else
    {
        cout << "Gagal membuka file untuk menyimpan.\n";
    }
}

// FUNGSI INTERFACE

// Fungsi untuk membuat garis horizontal
void printLine(int width) {
    cout << "+";
    for(int i = 0; i < width; i++) cout << "-";
    cout << "+\n";
}

// Fungsi untuk membuat header tabel
void printTableHeader(int width) {
    printLine(width);
    cout << "|" << setfill(' ') << setw(width - 0) << left << "APLIKASI MANAJEMEN KONTAK" << "|\n";
    printLine(width);
}

// Fungsi untuk menapilkan hasil pencarian dalam bentuk tabel
void displaySearchResults(const vector<pair<string, string>>& results) {
    if (results.empty()) {
        cout << "\nKontak tidak ditemukan.\n";
        return;
    }

    const int width = 60;
    cout << "\n";
    printLine(width);
    cout << "| " << setw(5) << "No" << " | " 
         << setw(25) << left << "Nama" << " | "
         << setw(20) << left << "Nomor Telepon" << " |\n";
    printLine(width);

    for (size_t i = 0; i < results.size(); i++) {
        cout << "| " << setw(5) << right << i + 1 << " | "
             << setw(25) << left << results[i].first << " | "
             << setw(20) << left << results[i].second << " |\n";
    }
    printLine(width);
}

// Fungsi untuk menampilkan menu utama
void displayMainMenu() {
    system("cls");
    const int width = 60;
    printTableHeader(width);
    cout << "\n";
    cout << "|" << setfill(' ') << setw(width - 0) << left << "MENU UTAMA" << "|\n\n";
    cout << "   [1] Pencarian Kontak\n";
    cout << "   [2] Tambah Kontak Baru\n";
    cout << "   [3] Tampilkan Semua Kontak\n";
    cout << "   [4] Hapus Kontak\n";
    cout << "   [5] Kembali ke Pemilihan Jenis Pohon\n\n";
    printLine(width);
}

// Fungsi memilih tipe pohon
int selectTreeType() {
    system("cls");
    const int width = 60;
    printTableHeader(width);
    cout << "\n";
    cout << "|" << setfill(' ') << setw(width - 0) << left << "PILIH JENIS POHON" << "|\n\n";
    cout << "   [1] Pohon AVL\n";
    cout << "   [2] Pohon BST\n";
    cout << "   [3] Keluar\n\n";
    printLine(width);
    cout << "Masukkan pilihan Anda: ";
    int choice;
    cin >> choice;
    
    return choice;
}

// Fungsi utama
int main() {
    string name, phoneNumber;
    int choiceMenu;
    int treeChoice;

    do {
        treeChoice = selectTreeType();
        BSTContactNode *bstRoot = nullptr;
        AVLContactNode *avlRoot = nullptr;

        if (treeChoice == 1) {
            loadDataAVL(avlRoot, "contacts.txt");
        } else if (treeChoice == 2) {
            loadDataBST(bstRoot, "contacts.txt");
        } else if (treeChoice == 3) {
            system("cls");
            cout << "\nTerima kasih telah menggunakan aplikasi ini!\n";
            return 0;
        } else {
            cout << "\nPilihan tidak valid.\n";
            continue;
        }

        do {
            displayMainMenu();
            cout << "Masukkan pilihan Anda: ";
            cin >> choiceMenu;
            cin.ignore();

            switch (choiceMenu) {
            case 1: {
                system("cls");
                printTableHeader(60);
                cout << "\nPENCARIAN KONTAK\n";
                cout << "Masukkan nama kontak yang ingin dicari: ";
                getline(cin, name);
                
                if (treeChoice == 1) {
                    auto results = findAVLContact(avlRoot, name);
                    displaySearchResults(results);
                } else {
                    auto results = findBSTContact(bstRoot, name);
                    displaySearchResults(results);
                }
                cout << "\nTekan Enter untuk kembali ke menu utama...";
                cin.get();
                break;
            }
            
            case 2: {
                system("cls");
                printTableHeader(60);
                cout << "\nTAMBAH KONTAK BARU\n";
                cout << "Masukkan nama kontak: ";
                getline(cin, name);
                cout << "Masukkan nomor telepon: ";
                getline(cin, phoneNumber);

                if (treeChoice == 1) {
                    avlRoot = insertAVLContact(avlRoot, name, phoneNumber);
                    saveContacts(bstRoot, avlRoot, treeChoice);
                    cout << "\nKontak berhasil ditambahkan.\n";
                } else {
                    bstRoot = insertBSTContactNode(bstRoot, name, phoneNumber);
                    saveContacts(bstRoot, avlRoot, treeChoice);
                    cout << "\nKontak berhasil ditambahkan.\n";
                }
                cout << "\nTekan Enter untuk kembali ke menu utama...";
                cin.get();
                break;
            }
            
            case 3: {
                system("cls");
                printTableHeader(60);
                if (treeChoice == 1) {
                    cout << "\nDAFTAR KONTAK (AVL)\n";
                    displayContact(avlRoot);
                } else {
                    cout << "\nDAFTAR KONTAK (BST)\n";
                    displayContact(bstRoot);
                }
                cout << "\nTekan Enter untuk kembali ke menu utama...";
                cin.get();
                break;
            }
            
            case 4: {
                system("cls");
                printTableHeader(60);
                cout << "\nHAPUS KONTAK\n";
                cout << "Masukkan nama kontak yang ingin dihapus: ";
                getline(cin, name);
                
                if (treeChoice == 1) {
                    avlRoot = removeAVLContact(avlRoot, name);
                    saveContacts(bstRoot, avlRoot, treeChoice);
                    cout << "\nKontak berhasil dihapus.\n";
                } else {
                    bstRoot = removeBSTContact(bstRoot, name);
                    saveContacts(bstRoot, avlRoot, treeChoice);
                    cout << "\nKontak berhasil dihapus.\n";
                }
                cout << "\nTekan Enter untuk kembali ke menu utama...";
                cin.get();
                break;
            }
            
            case 5: {
                system("cls");
                cout << "\nKembali ke pemilihan jenis pohon...\n";
                break;
            }
            
            default: {
                system("cls");
                cout << "\nPilihan tidak valid!\n";
                cout << "\nTekan Enter untuk ke menu utama...";
                cin.get();
                break;
            }
        }

        } while (choiceMenu != 5);

    } while (treeChoice != 3);

    return 0;
}