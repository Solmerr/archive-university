#!/usr/bin/env python
# coding: utf-8

# In[ ]:


def power_modulo(a,b,c):
    #binary jako string, już odwrócony
    binary_rev = bin(b)[2:][::-1]
    #print("binary reversed: ", binary_rev)
    binary_length = len(str(binary_rev))
    #print("binary_length: ", binary_length)
    
    #tworzenie listy + jeżeli w zapisie binarnym na danym miejscu (i) stała 1 to oblicz a^(2^i) mod c
    listB = []
    for i in range(binary_length):
        if binary_rev[i] == '1':
            listB.append((a**(2**i))%c)
            #print((a**(2**i))%c)
    
    #mnożenie wszystkich reszt z a^(2^i) mod c
    sum = 1
    listB_length = len(listB)
    for i in range(listB_length):
        sum *= listB[i]
    #print(sum)
    
    result = sum%c
    print(a,"^",b,"mod",c," = ",result)

    
    
running = 1
while running == 1:
    a = int(input("a: "))
    b = int(input("b: "))
    c = int(input("c: "))
    power_modulo(a,b,c)
    choice = str(input("next? (y/n) "))
    if choice == 'y': print("----------------------")
    elif choice == 'n': running = 0
print("The End")


# In[ ]:


from collections import Counter

def fermat(a, listDivisor):
    #tworzenie listy + szukanie "d" które będzie nieparzyste
    listD = []
    for i in range (int(a/2)):
        k = 2**i
        check = (a/k)%2
        if check == 1:
            d = int(a/k)
            #dodanie do listy z dzielnikami 2 zgodne z iteracją (i)
            for j in range (i):
                listDivisor.append(2)
        elif check == 0:
            continue
    
    #x zaokrąglenie w dół, x2 float
    x = int(d**(1/2))
    x2 = (d**(1/2))
    
    #jeżeli zaokrąglony x == x2 -> dodaj x do listy z krotnością 2
    #UWAGA: listD to lista pomocnicza, w której mogą znajdować się liczby złożone (rekursja)
    if x == x2:
        listD.append(x)
        listD.append(x)
    #jeżeli zaokrąglony x != x2 -> x=x+1
    elif x != x2:
        x += 1
        loop2 = 1
        while (loop2 == 1) and (x < ((d+1)/2)):
            y = ((x**2-d)**(1/2))
            if (y**2 > 0) and (int(y) != y):
                x += 1
            elif (y**2 > 0) and (int(y) == y):
                listD.append(int(abs(x+y)))
                listD.append(int(abs(x-y)))
                loop2 = 0
    
    #jeżeli listD puste -> liczbę d nie można rozłożyć -> liczba pierwsza
    if len(listD) == 0:
        print(d, " jest liczbą pierwszą!")
        listD.append(d)
        listDivisor.append(d)
    #jeżeli listD posiada elementy -> sprawdzenie czy są one złożone czy pierwsze (rekursja)
    elif len(listD) != 0:
        for i in range (len(listD)):
            fermat_rec(listD[i], listDivisor)
            
    return listDivisor


#prawie identyczna funkcja (pomijana jest pierwsza pętla, która szuka "d" - tutaj d jest argumentem)
def fermat_rec(d, listDivisor):
    listD = []
    x = int(d**(1/2))
    x2 = (d**(1/2))
    
    if x == x2:
        listD.append(x)
        listD.append(x)
    elif x != x2:
        x += 1
        loop2 = 1
        while (loop2 == 1) and (x < ((d+1)/2)):
            y = ((x**2-d)**(1/2))
            if (y**2 > 0) and (int(y) != y):
                x += 1
            elif (y**2 > 0) and (int(y) == y):
                listD.append(int(abs(x+y)))
                listD.append(int(abs(x-y)))
                loop2 = 0
    
    if len(listD) == 0:
        print(d, " jest liczbą pierwszą!")
        listD.append(d)
        listDivisor.append(d)
    elif len(listD) != 0:
        for i in range (len(listD)):
            fermat_rec(listD[i], listDivisor)
    
    return listDivisor


#sortowanie listy z dzielnikami + liczenie unikalnych elementów + liczenie krotności
def write_results(a, listDivisor):
    listDivisor.sort()
    keys = Counter(listDivisor).keys()
    values = Counter(listDivisor).values()

    print("WYNIK")
    print("Dzielniki:",keys)
    print("Krotnosci:",values)



running = 1
while running == 1:
    listDivisor = []
    a = int(input("a: "))
    fermat(a, listDivisor)
    #print(listDivisor)
    write_results(a, listDivisor)
    choice = str(input("Next? (y/n) "))
    if choice == 'y': print("----------------------")
    elif choice == 'n': running = 0
print("The End")


# In[ ]:


from collections import Counter

def lucas(n, q):
    n2 = n - 1
    listDivisor = []
    listX = []
    
    #fermat wylicza dzielniki
    fermat(n2, listDivisor)
    #print(listDivisor)
    listDivUnique = [listDivisor[0]]
    
    #zapisanie do listy tylko unikalnych dzielników
    for i in range (len(listDivisor)):
        if listDivisor[i] in listDivUnique:
            continue
        elif listDivisor[i] not in listDivUnique:
            listDivUnique.append(listDivisor[i])
    
    #power_modulo wylicza resztę, listX = lista z resztami
    x = power_modulo(q, n2, n)
    listX.append(x)
    print(q,"^",n2,"mod",n," = ",x)
    
    #liczenie reszt dla wszystkich unikalnych dzielników + zapisywanie do listX
    for i in range (len(listDivUnique)):
        x = power_modulo(q, int(n2/listDivUnique[i]), n)
        listX.append(x)
        print("Dzielnik",listDivUnique[i],"=\t",x,"\t\t",q,"^",int(n2/listDivUnique[i]),"mod",n,"=",x)
    
    #kopia pomocnicza + usunięcie z kopii pierwszego elementu (który może się równać 1)
    listX_2 = listX.copy()
    listX_2.pop(0)
    #liczenie ile razy powtarza się w pozostałych resztach 1
    count_ones = listX_2.count(1)
    #jeżeli pierwszy element z listX == 1 i w listX_2 nie ma żadnej 1 -> liczba pierwsza
    if (listX[0] == 1) and (count_ones == 0):
        print("Liczba",n,"jest pierwsza!")
    #jeżeli pierwszy element z listX != 1 lub w listX_2 znajduje się przynajmniej jedna 1 -> test nie rozstrzyga
    elif (listX[0] != 1) or (count_ones != 0):
        print("Test nie rozstrzyga czy liczba",n,"jest pierwsza.")


def power_modulo(a,b,c):
    binary_rev = bin(b)[2:][::-1]
    binary_length = len(str(binary_rev))
    
    listB = []
    for i in range(binary_length):
        if binary_rev[i] == '1':
            listB.append((a**(2**i))%c)
    sum = 1
    listB_length = len(listB)
    for i in range(listB_length):
        sum *= listB[i]
    
    result = sum%c
    return result
    

def fermat(a, listDivisor):
    listD = []
    for i in range (int(a/2)):
        k = 2**i
        check = (a/k)%2
        if check == 1:
            d = int(a/k)
            for j in range (i):
                listDivisor.append(2)
        elif check == 0:
            continue
    
    x = int(d**(1/2))
    x2 = (d**(1/2))
    
    if x == x2:
        listD.append(x)
        listD.append(x)
    elif x != x2:
        x += 1
        loop2 = 1
        while (loop2 == 1) and (x < ((d+1)/2)):
            y = ((x**2-d)**(1/2))
            if (y**2 > 0) and (int(y) != y):
                x += 1
            elif (y**2 > 0) and (int(y) == y):
                listD.append(int(abs(x+y)))
                listD.append(int(abs(x-y)))
                loop2 = 0
    
    if len(listD) == 0:
        listD.append(d)
        listDivisor.append(d)
    elif len(listD) != 0:
        for i in range (len(listD)):
            fermat_rec(listD[i], listDivisor)
            
    return listDivisor


def fermat_rec(d, listDivisor):
    listD = []
    x = int(d**(1/2))
    x2 = (d**(1/2))
    
    if x == x2:
        listD.append(x)
        listD.append(x)
    elif x != x2:
        x += 1
        loop2 = 1
        while (loop2 == 1) and (x < ((d+1)/2)):
            y = ((x**2-d)**(1/2))
            if (y**2 > 0) and (int(y) != y):
                x += 1
            elif (y**2 > 0) and (int(y) == y):
                listD.append(int(abs(x+y)))
                listD.append(int(abs(x-y)))
                loop2 = 0
    
    if len(listD) == 0:
        listD.append(d)
        listDivisor.append(d)
    elif len(listD) != 0:
        for i in range (len(listD)):
            fermat_rec(listD[i], listDivisor)
    
    return listDivisor



running = 1
while running == 1:
    n = int(input("n: "))
    q = int(input("q: "))
    lucas(n,q)
    choice = str(input("Next? (y/n) "))
    if choice == 'y': print("----------------------")
    elif choice == 'n': running = 0
print("The End")


# In[ ]:




