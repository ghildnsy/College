#include <iostream>
using namespace std;

void insertionSort(int arr[], int n) {
    for (int i = 1; i < n; i++) {
        for (int j = i; j > 0; j--) {
            // Jika elemen sebelumnya lebih besar, geser
            if (arr[j] < arr[j-1]) {
                int temp = arr[j];
                arr[j] = arr[j-1];
                arr[j-1] = temp;
            }
        }
        
        // Tampilkan array setelah setiap iterasi
        for (int k = 0; k < n; k++) {
            cout << arr[k] << " ";
        }
        cout << endl;
    }
}

int main() {
    // Data dalam kondisi average
    int arr[] = {23, 78, 45, 8, 32, 56};
    int n = sizeof(arr)/sizeof(arr[0]);
    
    // Panggil fungsi insertion sort
    insertionSort(arr, n);
    
    cout << endl;
    
    return 0;
}

