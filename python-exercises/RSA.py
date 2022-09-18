#!/usr/bin/env python
# coding: utf-8

# In[ ]:


def Erato(n):
    primes = []
    result = []
    iteration = 2
    for i in range (1, n+1):
        primes.append(i)
        
    #print(len(primes))
        
    while (iteration <= n**(1/2)):
        if (primes[iteration] != 0):
            for i in range (iteration*2, n, iteration):
                primes[i] = 0
        iteration += 1
        
    for i in range (2, n):
        if (primes[i] != 0):
            result.append(i)
            
    return result


P = Erato(2600000)
running = True
while running:
    i = int(input("i:  "))
    j = int(input("j: "))
    print("i:", P[i-1], " j:", P[j-1])
    print("------------------------------------------")
    choice = input("Next? (y/n): ")
    print("------------------------------------------")
    if choice == "n":
        running = False
    else:
        continue


# In[ ]:





# In[ ]:


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
        
    #print(r_next, R, Q, X, Y) 
    print("GCD:", R[-1], " x:", X[-2], " y:", Y[-2])

running = True
while running:
    a = int(input("a: "))
    b = int(input("b: "))
    Euclides(a, b)
    print("------------------------------------------")
    choice = input("Next? (y/n): ")
    print("------------------------------------------")
    if choice == "n":
        running = False
    else:
        continue


# In[ ]:





# In[2]:


def RSA(i,j,e):
    primes = Erato(2600000)
    p = primes[i-1]
    q = primes[j-1]
    n = p * q
    m = (p - 1) * (q - 1)
    d = Euclides(e, m)
    #print(p, q, n, m, d)
    
    if (d > 0):
        print("Public key: ", n, e)
        print("Private key: ", n, d)
        #print("The End!")
    else:
        while (d < 0):
            d += m
        print("Public key: ", n, e)
        print("Private key: ", n, d)
        #print("The End!")

def Erato(n):
    primes = []
    result = []
    iteration = 2
    for i in range (1, n+1):
        primes.append(i)
        
    #print(len(primes))
        
    while (iteration <= n**(1/2)):
        if (primes[iteration] != 0):
            for i in range (iteration*2, n, iteration):
                primes[i] = 0
        iteration += 1
        
    for i in range (2, n):
        if (primes[i] != 0):
            result.append(i)
            
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
        
    #print(r_next, R, Q, X, Y) 
    return X[-2]

running = True
while running:
    i = int(input("i: "))
    j = int(input("j: "))
    e = int(input("e: "))
    RSA(i, j, e)
    print("------------------------------------------")
    choice = input("Next? (y/n): ")
    print("------------------------------------------")
    if choice == "n":
        running = False
    else:
        continue


# In[ ]:




