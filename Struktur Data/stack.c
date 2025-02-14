#include <stdio.h>
#include <stdlib.h>

#define MAX 40

// Struktur data untuk stack
typedef struct {
    int items[MAX]; // Array untuk menyimpan nomor lembaran soal
    int top;        // Menunjukkan indeks top stack
} Stack;

// Inisialisasi stack
void initStack(Stack *s) {
    s->top = -1; // Menandakan stack kosong
}

// Memeriksa apakah stack kosong
int isEmpty(Stack *s) {
    return s->top == -1;
}

// Memeriksa apakah stack penuh
int isFull(Stack *s) {
    return s->top == MAX - 1;
}

// Memeriksa apakah nomor lembaran soal sudah ada di stack
int exists(Stack *s, int lembaran) {
    for (int i = 0; i <= s->top; i++) {
        if (s->items[i] == lembaran) {
            return 1; // Ada duplikat
        }
    }
    return 0; // Tidak ada duplikat
}

// Menambahkan lembaran soal ke stack
void push(Stack *s, int lembaran) {
    if (!isFull(s)) {
        if (!exists(s, lembaran)) { // Cek apakah sudah ada
            s->top++;
            s->items[s->top] = lembaran;
            printf("Lembaran soal #%d telah ditambahkan.\n", lembaran);
        } else {
            printf("Lembaran soal #%d sudah ada, tidak dapat ditambahkan.\n", lembaran);
        }
    } else {
        printf("Stack penuh, tidak dapat menambahkan lembaran soal.\n");
    }
}

// Menghapus dan membagikan lembaran soal terakhir dari stack
int pop(Stack *s) {
    if (!isEmpty(s)) {
        return s->items[s->top--];
    } else {
        return -1; // Mengembalikan -1 jika tidak ada lembaran yang tersimpan
    }
}

// Menampilkan semua lembaran soal di stack
void displayStack(Stack *s) {
    if (isEmpty(s)) {
        printf("Tidak ada lembaran soal yang tersimpan.\n");
        return;
    }

    printf("Tumpukan lembaran soal:\n");
    for (int i = s->top; i >= 0; i--) {
        printf("Lembaran soal #%d\n", s->items[i]);
    }
}

// Menghitung jumlah lembaran soal
int countStack(Stack *s) {
    return s->top + 1; // Jumlah elemen dalam stack
}

int main() {
    Stack lembaranSoalStack;
    initStack(&lembaranSoalStack);

    int pilihan, lembaran, lanjut;

    do {
        printf("\nMenu:\n");
        printf("1. Tambah Lembaran Soal\n");
        printf("2. Bagikan Lembaran Soal\n");
        printf("4. Tampilkan Tumpukan Lembaran Soal\n");
        printf("5. Hitung Jumlah Lembaran Soal\n");
        printf("0. Exit Program\n");
        printf("Pilih opsi: ");
        scanf("%d", &pilihan);

        switch (pilihan) {
            case 1:
                do {
                    printf("Masukkan nomor lembaran soal: ");
                    scanf("%d", &lembaran);
                    push(&lembaranSoalStack, lembaran);

                    do {
                        printf("Apakah Anda ingin menambahkan lembaran soal lagi? (1: Lanjut, 0: Kembali ke menu utama): ");
                        scanf("%d", &lanjut);
                        if (lanjut != 1 && lanjut != 0) {
                            printf("Angka yang Anda masukkan tidak valid. Silakan masukkan 1 atau 0.\n");
                        }
                    } while (lanjut != 1 && lanjut != 0);

                } while (lanjut == 1);
                break;

            case 2:
                do {
                    int soal = pop(&lembaranSoalStack);
                    if (soal != -1) {
                        printf("Lembaran soal #%d telah dibagikan.\n", soal);
                    } else {
                        printf("Tidak ada lembaran soal yang tersisa.\n");
                    }

                    do {
                        printf("Apakah Anda ingin membagikan lembaran soal lagi? (1: Lanjut, 0: Kembali ke menu utama): ");
                        scanf("%d", &lanjut);
                        if (lanjut != 1 && lanjut != 0) {
                            printf("Angka yang Anda masukkan tidak valid. Silakan masukkan 1 atau 0.\n");
                        }
                    } while (lanjut != 1 && lanjut != 0);

                } while (lanjut == 1);
                break;

            case 4:
                displayStack(&lembaranSoalStack);
                do {
                    printf("Kembali ke menu utama? (1: Ya, 0: Exit Program): ");
                    scanf("%d", &lanjut);
                    if (lanjut != 1 && lanjut != 0) {
                        printf("Angka yang Anda masukkan tidak valid. Silakan masukkan 1 atau 0.\n");
                    }
                } while (lanjut != 1 && lanjut != 0);

                if (lanjut == 0) {
                    pilihan = 0; // Set pilihan untuk Exit Program
                }
                break;

            case 5:
                printf("Jumlah lembaran soal yang tersimpan: %d\n", countStack(&lembaranSoalStack));
                do {
                    printf("Kembali ke menu utama? (1: Ya, 0: Exit Program): ");
                    scanf("%d", &lanjut);
                    if (lanjut != 1 && lanjut != 0) {
                        printf("Angka yang Anda masukkan tidak valid. Silakan masukkan 1 atau 0.\n");
                    }
                } while (lanjut != 1 && lanjut != 0);

                if (lanjut == 0) {
                    pilihan = 0; // Set pilihan untuk Exit Program
                }
                break;

            case 0:
                printf("Exit Program dari program.\n");
                break;

            default:
                printf("Pilihan tidak valid, silakan coba lagi.\n");
        }
    } while (pilihan != 0);

    return 0;
}
