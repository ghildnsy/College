#include <stdio.h>
int faktorial(int x)
{
    // kondisi terminal
    if (x == 1)
        return x;
    // fase balik
    else
        return x * faktorial(x - 1);
}
// main function
int main()
{
    int N;
    printf("Masukkan N = ");
    scanf("%d", &N);
    printf("Hasil %d! = %d\n", N, faktorial(N));
    return 0;
}
-
