#!/usr/bin/env python
# coding: utf-8

# In[1]:


def JHA(m,p,q):
    # lista z ilością [samogłosek, spółgłosek, spacji]
    list_all = [0,0,0]
    Counter(list_all)
    #print(list_all)
    
    power = (7 * list_all[0]) - (3 * list_all[1]) + (list_all[2]**2)
    if power >= 0:
        #print(power, "nieujemna")
        result = Power_Modulo(q,power,p)
    elif power < 0:
        #print(power, "ujemna")
        q2 = Euclides(q,p)
        result = Power_Modulo(q2,power,p)
        
    print("h =",result)


def Counter(list_all):
    # parzyste
    n1= {'a','e','i','o','u','A','E','I','O','U'}

    # nieparzyste
    n2 = {'b','c','d','f','g','h','j','k','l','m','n','p','q','r','s','t','w','v','y','x','z','B','C','D','F','G','H','J','K','L','M','N','P','Q','R','S','T','W','V','Y','X','Z'}

    # spacje
    SP = {' '}
    
    file = open("tekst_dlugi.txt", "r")
    data = file.read()
    for i in range (0, len(data)):
        if data[i] in n1:
            list_all[0] += 1
        elif data[i] in n2:
            list_all[1] += 1
        elif data[i] in SP:
            list_all[2] += 1
        else:
            pass
        
    return list_all


def Power_Modulo(a,b,c):
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


def Euclides(a,b):
    # R, Q, X, Y - listy
    # i - iteracja
    i = 0
    R = [a,b]
    r_next = R[1]
    Q = [int(abs(R[i]/R[i+1]))]
    q_next = Q[0]
    #print(r_next, R[i], R[i+1])
    X = [1]
    x_next = 0
    Y = [-Q[0]]
    y_next = 0
    
    r_next = R[i] - R[i+1] * Q[i]
    R.append(r_next)
    #print(r_next, R[i], R[i+1], Q[i])
    i += 1
    q_next = int(abs(R[i]/R[i+1]))
    Q.append(q_next)
    x_next = -X[0] * Q[1]
    X.append(x_next)
    y_next = 1 - Y[0] * Q[1]
    Y.append(y_next)
    
    while r_next > 0:
        r_next = R[i] - R[i+1] * Q[i]
        if r_next == 0:
            break
        R.append(r_next)
        #print(r_next, R[i], R[i+1], Q[i])
        i += 1
        q_next = int(abs(R[i]/R[i+1]))
        Q.append(q_next)
        x_next = X[i-2] - X[i-1] * Q[i]
        X.append(x_next)
        y_next = Y[i-2] - Y[i-1] * Q[i]
        Y.append(y_next)
        
    return X[-2]


m = True
running = True
while running:
    p = int(input("p: "))
    q = int(input("q: "))
    JHA(m,p,q)
    choice = int(input("exit - 0"))
    if choice == 0:
        running = False


# In[ ]:




