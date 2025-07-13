#include <iostream>
#include <vector>
#include <ctime>
#include <cstdlib>
#include <algorithm>  // Menambahkan header untuk std::shuffle
#include <random>     // Menambahkan header untuk random engine
#include <chrono>     // Untuk penundaan waktu
#include <thread>     // Untuk fungsi sleep_for
#include <conio.h>    // Untuk menggunakan _kbhit() dan _getch()

using namespace std;

// Kelas induk Card
class Card {
public:
    virtual char getValue() const = 0; // Fungsi virtual murni untuk mendapatkan nilai kartu
    bool isRevealed;

    // Constructor
    Card() : isRevealed(false) {}

    // Destructor
    virtual ~Card() {}

    // Fungsi untuk mengungkapkan kartu
    void reveal() {
        isRevealed = true;
    }

    // Fungsi untuk menyembunyikan kartu
    void hide() {
        isRevealed = false;
    }

    // Fungsi untuk mengecek kecocokan antara dua kartu
    bool isMatched(const Card& other) const {
        return getValue() == other.getValue();
    }

    // Fungsi untuk menampilkan kartu
    virtual void display(bool isCursor = false) const = 0;  // Fungsi virtual murni agar tiap turunan bisa mendefinisikan tampilannya
};

// Kelas untuk kartu dengan nilai berupa huruf
class AlphabetCard : public Card {
public:
    char value;

    // Constructor
    AlphabetCard(char val) : value(val) {}

    // Mendapatkan nilai kartu
    char getValue() const override {
        return value;
    }

    // Menampilkan kartu
    void display(bool isCursor = false) const override {
        if (isCursor) {
            cout << ">";
        } else {
            cout << "*";
        }

        if (isRevealed)
            cout << value << " ";
        else
            cout << "* ";
    }
};

// Kelas untuk kartu dengan nilai berupa angka
class NumberCard : public Card {
public:
    int value;

    // Constructor
    NumberCard(int val) : value(val) {}

    // Mendapatkan nilai kartu
    char getValue() const override {
        return '0' + value;  // Mengkonversi angka menjadi karakter
    }

    // Menampilkan kartu
    void display(bool isCursor = false) const override {
        if (isCursor) {
            cout << ">";
        } else {
            cout << "*";
        }

        if (isRevealed)
            cout << value << " ";
        else
            cout << "* ";
    }
};

// Kelas Board
class Board {
private:
    Card** cards;  // Menggunakan pointer untuk array 2D dari kartu
    int size;
    int cursorPos;

public:
    // Constructor
    Board(int rows, int cols) {
        size = rows * cols;
        cursorPos = 0;  // Memulai posisi kursor di 0 (kartu pertama)

        // Alokasi dinamis untuk array kartu
        cards = new Card*[size];
        
        vector<Card*> values(size / 2);

        // Mengisi array dengan pasangan kartu
        for (int i = 0; i < values.size(); ++i) {
            // Misalnya, kita membuat kartu A, B, C... untuk Alphabet
            values[i] = new AlphabetCard('A' + i);  // Kartu A, B, C, ...
        }

        // Menggandakan kartu untuk pasangan
        values.insert(values.end(), values.begin(), values.end());

        // Mengacak kartu menggunakan std::shuffle
        random_device rd;  // untuk mendapatkan seed random
        default_random_engine g(rd());  // menggunakan random engine
        shuffle(values.begin(), values.end(), g);  // mengacak vektor

        // Membuat kartu berdasarkan nilai yang sudah diacak
        for (int i = 0; i < size; ++i) {
            cards[i] = values[i];  // Menggunakan array kartu yang sudah diacak
        }
    }

    // Destructor
    ~Board() {
        // Dealokasi memori untuk kartu-kartu
        for (int i = 0; i < size; ++i) {
            delete cards[i];  // Menghapus setiap objek Card
        }
        delete[] cards;  // Menghapus array kartu itu sendiri
    }

    void displayBoard(int moves) {
        cout << "Moves: " << moves << endl;  // Menampilkan jumlah moves di bagian atas
        for (int i = 0; i < size; i++) {
            // Menampilkan kartu dengan indikator kursor di depan kartu yang dipilih
            if (i == cursorPos)
                cards[i]->display(true);  // Menandai posisi kursor
            else
                cards[i]->display(false); // Menampilkan kartu tanpa kursor

            if ((i + 1) % 5 == 0) {  // Setiap 5 kartu tampil di baris baru
                cout << endl;
            }
        }
    }

    bool checkMatch(int index1, int index2) {
        return cards[index1]->isMatched(*cards[index2]);
    }

    void revealCard(int index) {
        cards[index]->reveal();
    }

    void hideCard(int index) {
        cards[index]->hide();
    }

    bool allCardsRevealed() {
        for (int i = 0; i < size; i++) {
            if (!cards[i]->isRevealed) {
                return false;
            }
        }
        return true;
    }

    int getSize() const {
        return size;
    }

    void moveCursorUp() {
        if (cursorPos >= 5) cursorPos -= 5; // Jika sudah di baris pertama, tidak bisa naik lagi
    }

    void moveCursorDown() {
        if (cursorPos < size - 5) cursorPos += 5; // Jika sudah di baris terakhir, tidak bisa turun lagi
    }

    void moveCursorLeft() {
        if (cursorPos % 5 != 0) cursorPos -= 1; // Jika sudah di kolom pertama, tidak bisa ke kiri lagi
    }

    void moveCursorRight() {
        if (cursorPos % 5 != 4) cursorPos += 1; // Jika sudah di kolom terakhir, tidak bisa ke kanan lagi
    }

    bool isValidChoice() const {
        return !cards[cursorPos]->isRevealed;
    }

    int getCursorPos() const {
        return cursorPos;
    }
};

// Fungsi untuk menjalankan permainan
void playGame() {
    int rows = 4, cols = 5; // Papan 4x5
    Board board(rows, cols);
    int firstChoice, secondChoice;
    int moves = 0;
    bool cardFlipped = false;
    int firstCardPos = -1;

    while (!board.allCardsRevealed()) {
        system("cls");  // Bersihkan layar sebelum menampilkan board terbaru
        board.displayBoard(moves);  // Tampilkan board dengan jumlah moves yang selalu terlihat

        // Cek jika pemain menekan tombol untuk navigasi atau memilih kartu
        if (_kbhit()) {
            char ch = _getch();  // Mengambil input dari user

            // Pilihan kontrol dengan WASD
            if (ch == 'w' || ch == 'W') {
                board.moveCursorUp(); // Pindah ke atas
            }
            if (ch == 's' || ch == 'S') {
                board.moveCursorDown(); // Pindah ke bawah
            }
            if (ch == 'a' || ch == 'A') {
                board.moveCursorLeft(); // Pindah ke kiri
            }
            if (ch == 'd' || ch == 'D') {
                board.moveCursorRight(); // Pindah ke kanan
            }
            // Menekan Enter untuk memilih kartu
            if (ch == '\r' || ch == '\n') {
                if (!cardFlipped) {
                    firstCardPos = board.getCursorPos();

                    // Cek apakah kartu pertama sudah dibuka
                    if (board.isValidChoice()) {
                        board.revealCard(firstCardPos);
                        cardFlipped = true; // Kartu pertama dibuka
                    }
                } else {
                    secondChoice = board.getCursorPos();

                    // Cek apakah kartu kedua sudah dibuka
                    if (board.isValidChoice()) {
                        board.revealCard(secondChoice);

                        system("cls");  // Bersihkan layar setelah kartu kedua dibuka
                        board.displayBoard(moves);  // Menampilkan board setelah pilihan kedua

                        if (board.checkMatch(firstCardPos, secondChoice)) {
                            cout << "Match found!" << endl;
                        } else {
                            cout << "No match. Try again!" << endl;
                            board.hideCard(firstCardPos);
                            board.hideCard(secondChoice);
                        }

                        moves++;  // Menambahkan perhitungan moves setiap kali pemain mengambil dua kartu
                        cardFlipped = false; // Reset status kartu yang sudah dibuka
                        cout << "Moves: " << moves << endl << endl;

                        this_thread::sleep_for(chrono::seconds(1)); // Menunggu 1 detik sebelum layar dibersihkan
                    }
                }
            }
        }
    }

    cout << "Congratulations! You've matched all the cards in " << moves << " moves!" << endl;
}

int main() {
    cout << "Welcome to the Memory Game!" << endl;
    playGame();
    return 0;
}
