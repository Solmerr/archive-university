#!/usr/bin/env python
# coding: utf-8

# In[15]:


def ElGamal(n,r,k,j,t):
    # a - klucz publiczny; c1,c2 - szyfrogram
    a = Power_Modulo(r,k,n)
    c1 = Power_Modulo(r,j,n)
    c2 = (t*a**j)%n
    print("klucz publiczny:",n,r,a)
    print("szyfrogram:",c1,c2)
    
    
def Erato(n):
    primes = []
    result = []
    
    for i in range (1, n+1):
        primes.append(i)
        
    iteration = 2
    while (iteration <= n**(1/2)):
        if (primes[iteration] != 0):
            for i in range (iteration*2, n, iteration):
                primes[i] = 0
        iteration += 1
        
    for i in range (2, n):
        if (primes[i] != 0):
            result.append(i)
            
    return result


def PrimitiveRoot(n,r):
    listDivisor = []
    n2 = n - 1
    AllPrimes(n2,listDivisor)
    m = len(listDivisor)
    for i in range(m):
        power = int(n2/listDivisor[i-1])
        left = Power_Modulo(r,power,n)
        if (left == 1):
            result = False
            return result
    
    result = True
    return result


def AllPrimes(n,listDivisor):
    for i in range (2, n):
        while (n % i == 0):
            listDivisor.append(i)
            n = n / i
            

def Power_Modulo(a,b,c):
    binary_rev = bin(b)[2:][::-1]
    binary_length = len(str(binary_rev))
    
    listB = []
    for i in range(binary_length):
        if binary_rev[i] == '1':
            listB.append((a**(2**i)) % c)
    sum = 1
    listB_length = len(listB)
    for i in range(listB_length):
        sum *= listB[i]
    
    result = sum % c
    return result

    
running = True
while running:
    print("------------------------------------")
    choice = input("Next? (y/n): ")
    print("------------------------------------")
    if choice == "y":
        correct = True
        n = int(input("n: "))
        r = int(input("r: "))
        k = int(input("k: "))
        j = int(input("j: "))
        t = int(input("t: ")) 

        # sprawdzenie czy n jest liczbą pierwszą
        p = Erato(50000)
        if n not in p:
            print(n,"nie jest liczbą pierwszą")
            correct = False
        
        # sprawdzenie czy r jest pierwiastkiem pierwotnym n część 1
        # r nie może się równać n (jeżeli r=n -> NWD nie będzie równy 1)
        if r == n:
            print(r,"nie jest pierwiastkiem pierwotnym",n)
            correct = False
            
        # sprawdzenie czy r jest pierwiastkiem pierwotnym n część 2
        if PrimitiveRoot(n,r) == False:
            print(r,"nie jest pierwiastkiem pierwotnym",n)
            correct = False
        
        # jeżeli n jest liczbą pierwszą i r jest pierwiastkiem pierwotnym n to obliczamy klucz publiczny i szyfrogram
        if correct:
            ElGamal(n,r,k,j,t)
        
    if choice == "n":
        running = False
        
print("The End")


# 
