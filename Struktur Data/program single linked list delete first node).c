#include <stdio.h>
#include <stdlib.h>

// Definisi struktur Node
struct Node
{
    int data;
    struct Node *next;
};

// Fungsi untuk menghapus elemen di awal linked list
void deleteAtBeginning(struct Node **head)
{
    if (*head == NULL)
    {
        printf("List kosong, tidak ada yang bisa dihapus.\n");
        return;
    }

    struct Node *temp = *head; // Simpan node yang akan dihapus
    *head = (*head)->next;     // Pindahkan head ke node berikutnya
    free(temp);                // Hapus node lama dari memori
}

// Fungsi untuk mencetak elemen-elemen dalam linked list
void printList(struct Node *node)
{
    while (node != NULL)
    {
        printf("%d -> ", node->data);
        node = node->next;
    }
    printf("NULL\n");
}

int main()
{
    // Deklarasi dan inisialisasi node-node yang sudah ada
    struct Node *head = NULL;
    struct Node *second = NULL;
    struct Node *third = NULL;

    // Alokasi memori untuk 3 node
    head = (struct Node *)malloc(sizeof(struct Node));
    second = (struct Node *)malloc(sizeof(struct Node));
    third = (struct Node *)malloc(sizeof(struct Node));

    // Isi data dan hubungkan node-node
    head->data = 10;
    head->next = second;

    second->data = 20;
    second->next = third;

    third->data = 30;
    third->next = NULL;

    // Cetak linked list sebelum penghapusan
    printf("Linked list sebelum penghapusan: ");
    printList(head);

    // Hapus elemen di awal linked list
    deleteAtBeginning(&head);

    // Cetak linked list setelah penghapusan
    printf("Linked list setelah penghapusan: ");
    printList(head);

    return 0;
}
