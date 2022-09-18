#BAND-DIAGONAL MATRIX ??
import numpy as np

def matrix():
    n = int(input("Wymiar macierzy kwadratowej: "))
    A = np.zeros((n, n))
    R = np.zeros(n)

    nd = int(input("Ile wektorów nad diagonalą: "))
    pd = int(input("Ile wektorów pod diagonalą: "))

    for i in range (0, n):
        for j in range (i-pd, i+nd+1):
            if j < 0:
                pass
            elif j > n-1:
                pass
            else:
                print("a", i+1, j+1)
                A[i][j] = int(input())

    print(A)

    for j in range (0, n):
        print("R", j + 1)
        R[j] = int(input())

    print("A")
    print(A)
    print("R:", R)

    L = np.zeros((n, n))
    U = np.zeros((n, n))

    for i in range(0, n):
        U[i][i] = 1

    #LOWER & UPPER
    for j in range(0, n):
        i = j
        while i < n:
            suma_wek = 0
            for k in range(0, j):
                suma_wek = suma_wek + L[i][k] * U[k][j]
            L[i][j] = A[i][j] - suma_wek
            i += 1

        i = j
        while i < n:
            suma_wek = 0
            for k in range(0, j):
                suma_wek = suma_wek + L[j][k] * U[k][i]
            U[j][i] = (A[j][i] - suma_wek) / L[j][j]
            i += 1

    print('Lower')
    print(L)
    print('Upper')
    print(U)

    '''
    AX = R
    A, R - dane
    X - szukane
    H - macierz pomocnicza
    LOWER * H = R
    UPPER * X = H
    '''

    H = np.zeros(n)
    X = np.zeros(n)

    #FORWARD SUBSTITUTION
    H[0] = R[0] / L[0][0]
    for m in range (1, n):
        suma = 0
        for i in range (0, m):
            suma += L[m][i] * H[i]
        H[m] = (R[m] - suma) / L[m][m]

    print("H:", H)

    #BACK SUBSTITUTION
    X[n-1] = H[n-1]
    for m in range (n-2, -1, -1):
        suma = 0
        for i in range (m, n):
            suma += U[m][i] * X[i]
        X[m] = (H[m] - suma) / U[m][m]

    print("X:", X)

matrix()

