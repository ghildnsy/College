#include <iostream>
using namespace std;

void bubbleSort(int arr[], int n) {
    // Loop untuk mengakses setiap elemen array
    for(int i = 0; i < n-1; i++) {
        
        // Loop untuk membandingkan elemen array
        for(int j = 0; j < n-1-i; j++) {
            // Bandingkan dua elemen bersebelahan
            if(arr[j] > arr[j+1]) {
                // Jika elemen saat ini lebih besar, tukar dengan elemen berikutnya
                int temp = arr[j];
                arr[j] = arr[j+1];
                arr[j+1] = temp;
            }
        }
        
        // Tampilkan array setelah setiap iterasi
        cout << "Iterasi " << i+1 << ": ";
        for(int k = 0; k < n; k++) {
            cout << arr[k] << " ";
        }
        cout << endl;
    }
}

int main() {
    // Inisialisasi array tidak terurut
    int arr[] = {64, 34, 25, 12, 22, 11, 90};
    int n = 7;  // Ukuran array
    
    cout << "Array sebelum diurutkan: ";
    for(int i = 0; i < n; i++) {
        cout << arr[i] << " ";
    }
    cout << endl << endl;
    
    // Panggil fungsi bubbleSort
    bubbleSort(arr, n);
    
    cout << "\nArray setelah diurutkan: ";
    for(int i = 0; i < n; i++) {
        cout << arr[i] << " ";
    }
    cout << endl;
    
    return 0;
}