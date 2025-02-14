#include <stdio.h>
#include <stdlib.h>
// buat struct node dengan tambahan typedef untuk mempermudah
typedef struct node
{
    int data;
    struct node *prev;
    struct node *next;
} node;
// fungsi membuat node baru
node *Node1(int data)
{
    node *newNode = (node *)malloc(sizeof(node));
    newNode->data = data;
    newNode->prev = NULL;
    newNode->next = NULL;
    return newNode;
}
// fungsi insert node baru di node tertentu
void insertAfter(node **head, node *prevNode, int newData)
{
    node *newNode = Node1(newData);
    if (prevNode == NULL)
    {
        // Jika prevNode adalah NULL, berarti kita perlu insert di awal
        newNode->next = *head;
        if (*head != NULL)
        {
            (*head)->prev = newNode;
        }
        *head = newNode;
    }
    else
    {
        // insert setelah prevNode
        newNode->prev = prevNode;
        newNode->next = prevNode->next;
        if (prevNode->next != NULL)
        {
            prevNode->next->prev = newNode;
        }
        prevNode->next = newNode;
    }
}
// Fungsi print double linked list
void linkedlist(node *head)
{
    while (head != NULL)
    {
        printf("%d <-> ", head->data);
        head = head->next;
    }
    printf("NULL\n");
}
int main()
{
    node *head = NULL;
    // Insert beberapa node
    insertAfter(&head, NULL, 1);
    insertAfter(&head, head, 2);
    insertAfter(&head, head->next, 3);
    insertAfter(&head, head->next->next, 4);
    // Print double linked list
    linkedlist(head);
}
