#include <iostream>
#include <conio.h>
#include <windows.h>
#include <deque>
#include <cstdlib>
#include <ctime>

using namespace std;

const int WIDTH = 20;  // Lebar arena permainan
const int HEIGHT = 10; // Tinggi arena permainan

// Struktur untuk menyimpan posisi (x, y)
struct Position {
    int x, y;
};

// Enum untuk arah gerakan ular
enum Direction { UP, DOWN, LEFT, RIGHT };

// Kelas untuk permainan Snake
class SnakeGame {
public:
    int score;
    bool gameOver;
    Direction dir;
    Position food;
    deque<Position> snakeBody;  // Menggunakan deque untuk menyimpan tubuh ular
    SnakeGame() {
        score = 0;
        gameOver = false;
        dir = RIGHT;
        snakeBody.push_front({ WIDTH / 2, HEIGHT / 2 });  // Mulai di tengah arena
        generateFood();
    }

    // Menggambar arena dan ular
    void draw() {
        system("CLS");  // Clear screen (untuk Windows)
        
        // Menggambar arena tanpa dinding
        for (int y = 0; y < HEIGHT; y++) {
            for (int x = 0; x < WIDTH; x++) {
                if (x == food.x && y == food.y) cout << "F ";  // Makanan
                else {
                    bool snakePart = false;
                    for (auto segment : snakeBody) {
                        if (segment.x == x && segment.y == y) {
                            cout << "O ";  // Ular
                            snakePart = true;
                            break;
                        }
                    }
                    if (!snakePart) cout << ". ";  // Titik kosong
                }
            }
            cout << endl;
        }

        cout << "Skor: " << score << endl;
    }

    // Mengambil input dari pengguna
    void input() {
        if (_kbhit()) {
            char current = _getch();  // Ambil input
            if (current == 'w' && dir != DOWN) dir = UP;
            if (current == 's' && dir != UP) dir = DOWN;
            if (current == 'a' && dir != RIGHT) dir = LEFT;
            if (current == 'd' && dir != LEFT) dir = RIGHT;
        }
    }

    // Menggerakkan ular
    void logic() {
        Position newHead = snakeBody.front();

        // Pergerakan ular
        if (dir == UP) newHead.y--;
        if (dir == DOWN) newHead.y++;
        if (dir == LEFT) newHead.x--;
        if (dir == RIGHT) newHead.x++;

        // Ular akan keluar dari sisi dan muncul di sisi sebaliknya
        if (newHead.x < 0) newHead.x = WIDTH - 1;  // Muncul di sisi kanan
        if (newHead.x >= WIDTH) newHead.x = 0;     // Muncul di sisi kiri
        if (newHead.y < 0) newHead.y = HEIGHT - 1; // Muncul di sisi bawah
        if (newHead.y >= HEIGHT) newHead.y = 0;    // Muncul di sisi atas

        // Jika ular menabrak tubuh sendiri
        for (auto segment : snakeBody) {
            if (segment.x == newHead.x && segment.y == newHead.y) {
                gameOver = true;  // Menabrak tubuh sendiri
            }
        }

        // Menambahkan posisi kepala baru
        snakeBody.push_front(newHead);

        // Jika ular makan makanan
        if (newHead.x == food.x && newHead.y == food.y) {
            score += 10;
            generateFood();  // Hasilkan makanan baru
        } else {
            snakeBody.pop_back();  // Hapus ekor ular
        }
    }

    // Menghasilkan makanan di posisi acak
    void generateFood() {
        food.x = rand() % WIDTH;
        food.y = rand() % HEIGHT;
    }

    // Menjalankan permainan
    void run() {
        while (!gameOver) {
            draw();
            input();
            logic();
            Sleep(100);  // Waktu delay antara gerakan
        }
        cout << "Game Over! Skor akhir: " << score << endl;
    }
};

int main() {
    srand(time(0));  // Inisialisasi seed untuk random makanan
    SnakeGame game;
    game.run();
    return 0;
}


/*

Changelog

  - Menghapus dinding
  - Ketika keluar arena ular akan kembali muncul di sebrang arena seperti looping
  
*/