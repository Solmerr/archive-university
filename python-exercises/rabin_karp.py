import time
import random

def Rabin_Karp(T, P, d, q):
    m = len(P)
    n = len(T)
    h = pow(d, m - 1) % q
    p = 0
    t = 0
    i = 0
    j = 0
    s = 0

    for i in range(0, m):
        p = (d * p + ord(P[i])) % q
        t = (d * t + ord(T[i])) % q

    for s in range(0, n - m + 1):
        if p == t:
            for j in range(0, m):
                if T[s + j] != P[j]:
                    break
            j += 1
            if j == m:
                print ('Pattern occurs with shift:', str(s))

        if s < n - m:
            t = (d * (t - ord(T[s]) * h) + ord(T[s + m])) % q


d = 100
text = input('Text: ')
pattern = input('Pattern: ')
q = 13
start = time.time()
Rabin_Karp(text, pattern, d, q)
end = time.time()
print(end - start)