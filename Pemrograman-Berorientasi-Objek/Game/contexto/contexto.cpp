#include <iostream>
#include <vector>
#include <string>
#include <algorithm>
#include <ctime>
#include <cstdlib>

using namespace std;

class HangmanGame {
private:
    string word; // Kata yang harus ditebak
    string guessedWord; // Kata dengan huruf yang sudah ditebak
    vector<char> incorrectGuesses; // Huruf yang salah ditebak
    int maxAttempts; // Jumlah maksimal tebakan yang salah
    int attemptsLeft; // Sisa tebakan yang salah

public:
    HangmanGame(const vector<string>& wordList, int maxAttempts = 6) {
        // Memilih kata secara acak dari daftar kata
        srand(time(0)); // Inisialisasi seed untuk random
        int randomIndex = rand() % wordList.size(); // Memilih indeks acak
        word = wordList[randomIndex];
        
        guessedWord = string(word.length(), '_'); // Mengisi kata yang belum ditebak dengan '_'
        this->maxAttempts = maxAttempts;
        attemptsLeft = maxAttempts;
    }

    // Menampilkan status permainan saat ini
    void displayStatus() {
        cout << "Word: " << guessedWord << endl;
        cout << "Incorrect guesses: ";
        for (char ch : incorrectGuesses) {
            cout << ch << " ";
        }
        cout << endl;
        cout << "Attempts left: " << attemptsLeft << endl;
    }

    // Memeriksa apakah tebakan pemain benar atau salah
    bool makeGuess(char guess) {
        bool correct = false;
        
        // Periksa jika huruf sudah ditebak sebelumnya
        if (find(incorrectGuesses.begin(), incorrectGuesses.end(), guess) != incorrectGuesses.end() ||
            find(guessedWord.begin(), guessedWord.end(), guess) != guessedWord.end()) {
            cout << "You've already guessed that letter. Try a different one." << endl;
            return false;
        }

        // Periksa apakah tebakan ada dalam kata yang tersembunyi
        for (int i = 0; i < word.length(); ++i) {
            if (word[i] == guess) {
                guessedWord[i] = guess; // Mengungkapkan huruf yang benar
                correct = true;
            }
        }

        if (!correct) {
            incorrectGuesses.push_back(guess); // Menambah huruf salah ke daftar
            attemptsLeft--;
        }

        return correct;
    }

    // Memeriksa apakah permainan sudah berakhir
    bool isGameOver() {
        if (attemptsLeft <= 0) {
            cout << "Game Over! The word was: " << word << endl;
            return true;
        }

        if (guessedWord == word) {
            cout << "Congratulations! You've guessed the word: " << word << endl;
            return true;
        }

        return false;
    }

    // Menjalankan permainan
    void play() {
        char guess;
        while (!isGameOver()) {
            displayStatus();
            cout << "Enter a letter to guess: ";
            cin >> guess;
            guess = tolower(guess); // Pastikan huruf yang dimasukkan dalam bentuk kecil
            if (!makeGuess(guess)) {
                continue;
            }
        }
    }
};

int main() {
    cout << "Welcome to Hangman Game!" << endl;
    
    // Daftar kata yang akan dipilih secara acak
    vector<string> wordList = {"programming", "algorithm", "computer", "hangman", "cplusplus", "developer", "keyboard"};

    // Membuat game dengan daftar kata dan batasan maksimal tebakan
    HangmanGame game(wordList, 6);
    
    // Memulai permainan
    game.play();
    
    return 0;
}
