#include <iostream>
#include <vector>
#include <conio.h>
#include <windows.h>

using namespace std;

const int WIDTH = 7, HEIGHT = 10;

// ===============================
// == 1. CLASS & OBJECT EXAMPLE ==
// ===============================

class Player {  // <-- CLASS
public:
    int x, y;

    Player(int startX, int startY) : x(startX), y(startY) {}  // <-- CONSTRUCTOR

    void move(char direction) {
        if (direction == 'a' && x > 1) x--;
        if (direction == 'd' && x < WIDTH - 2) x++;
    }
};

// ===============================
// == Base CLASS for Inheritance ==
// ===============================

class Food {  // <-- BASE CLASS (untuk inheritance)
public:
    int x, y;

    Food(int startX, int startY) : x(startX), y(startY) {}  // <-- CONSTRUCTOR
    virtual ~Food() {}  // <-- DESTRUCTOR (virtual untuk inheritance)

    virtual void fall() {
        y++;
    }

    virtual char getSymbol() = 0;  // <-- Pure virtual method (akan dioverride)
    virtual bool isGood() = 0;
};

// ===============================
// == INHERITANCE - GOODFOOD     ==
// ===============================

class GoodFood : public Food {  // <-- CHILD CLASS dari Food
public:
    GoodFood(int startX, int startY) : Food(startX, startY) {}  // <-- CONSTRUCTOR (dari class turunan)

    char getSymbol() override {
        return 'o';
    }

    bool isGood() override {
        return true;
    }
};

// ===============================
// == INHERITANCE - BADFOOD      ==
// ===============================

class BadFood : public Food {  // <-- CHILD CLASS dari Food
public:
    BadFood(int startX, int startY) : Food(startX, startY) {}  // <-- CONSTRUCTOR

    char getSymbol() override {
        return '*';
    }

    bool isGood() override {
        return false;
    }
};

// ===============================
// == MAIN GAME CLASS            ==
// ===============================

class Game {  // <-- CLASS
private:
    Player player;  // <-- OBJECT dari CLASS Player
    vector<Food*> foods;  // <-- OBJECT-OBJECT dari CLASS turunan Food
    int score;
    bool gameOver;
    int frame;

public:
    Game() : player(WIDTH / 2, HEIGHT - 1), score(0), gameOver(false), frame(0) {}  // <-- CONSTRUCTOR

    ~Game() {  // <-- DESTRUCTOR
        for (auto f : foods) delete f;
    }

    void generateFood() {
        if (frame % 5 == 0) {
            int type = rand() % 2;
            int xPos = rand() % (WIDTH - 2) + 1;

            // ===============================
            // == OBJECT CREATED DYNAMICALLY ==
            // ===============================
            if (type == 0)
                foods.push_back(new GoodFood(xPos, 1));  // <-- OBJECT dari subclass GoodFood
            else
                foods.push_back(new BadFood(xPos, 1));  // <-- OBJECT dari subclass BadFood
        }
    }

    void update() {
        for (auto& f : foods) {
            f->fall();
            if (f->y == player.y && f->x == player.x) {
                if (f->isGood()) {
                    score++;
                    f->y = HEIGHT + 1;
                } else {
                    gameOver = true;
                }
            }
        }

        if (!foods.empty() && foods.front()->y > HEIGHT) {
            delete foods.front();  // <-- MANUAL DESTRUCTOR CALL (karena pakai new)
            foods.erase(foods.begin());
        }
    }

    void draw() {
        system("cls");

        for (int i = 0; i < HEIGHT; i++) {
            for (int j = 0; j < WIDTH; j++) {
                if (i == player.y && j == player.x) {
                    cout << "U";
                } else {
                    bool printed = false;
                    for (auto& f : foods) {
                        if (i == f->y && j == f->x) {
                            cout << f->getSymbol();
                            printed = true;
                            break;
                        }
                    }
                    if (!printed) cout << " ";
                }
            }
            cout << endl;
        }
        cout << "Score: " << score << endl;
        cout << "A/D to move. Catch 'o', avoid '*'.\n";
    }

    void handleInput() {
        if (_kbhit()) {
            char input = _getch();
            player.move(input);
        }
    }

    void run() {
        while (!gameOver) {
            generateFood();
            update();
            draw();
            handleInput();
            Sleep(150);
            frame++;
        }

        cout << "\nGame Over! Final Score: " << score << endl;
    }
};

// ===============================
// == MAIN FUNCTION              ==
// ===============================

int main() {
    srand(time(NULL));
    Game game;  // <-- OBJECT dari CLASS Game
    game.run();
    return 0;
}