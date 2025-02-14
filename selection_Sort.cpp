#include <iostream>
using namespace std;

void selectionSort(int arr[], int n) {
    // i untuk tracking posisi current terkecil
    for (int i = 0; i < n-1; i++) {
        // Mencari nilai terkecil dalam array 
        int indeks_terkecil = i;
        
        // j untuk mencari nilai terkecil di sisa array 
        for (int j = i+1; j < n; j++) {
            // Jika menemukan nilai yang lebih kecil, update indeks_terkecil
            if (arr[j] < arr[indeks_terkecil]) {
                indeks_terkecil = j;
            }
        }
        
        // Tukar nilai terkecil yang ditemukan dengan elemen pertama
        if (indeks_terkecil != i) {
            int temp = arr[i];
            arr[i] = arr[indeks_terkecil];
            arr[indeks_terkecil] = temp;
        }
        
        // Tampilkan array setelah setiap iterasi
        for (int k = 0; k < n; k++) {
            cout << arr[k] << " ";
        }
        cout << endl;
    }
}

int main() {
    // Indeks dalam kondisi average
    int arr[] = {23, 78, 45, 8, 32, 56};
    int n = sizeof(arr)/sizeof(arr[0]);
    
    
    // Panggil fungsi selection sort
    selectionSort(arr, n);
    
    cout << endl;
    
    return 0;
}