import struct
import math

def zamiana(list, p1, p2):   
  list[p1], list[p2] = list[p2], list[p1] 
  return list

dane = "45vv345y345v34c34c543y"
fragment = 2
ilepaczek = (math.ceil(len(dane)/fragment))

tablica = [ dane[i:i+fragment] for i in range(0, len(dane), fragment) ]

print(tablica)

tab = [None] * ilepaczek

iteracja = 0
dziala = True
while dziala:
  s = bytes(tablica[iteracja], 'utf-8')
  i = iteracja + 1
  paczka = struct.pack("II%ds" % (len(s)), i, len(s), s)
  print("Pakiet",i,": ",paczka)

  tab[iteracja] = paczka

  iteracja = iteracja + 1
  if iteracja >= ilepaczek:
    dziala = False

print("\n")
print(tab)

zamiana(tab, 0, 1)

print("\n")
print(tab)

wynik = [None] * ilepaczek

itr = 0
oblicz_wynik = True
while oblicz_wynik:
  temp = tab[itr]
  temp_ns = struct.unpack_from("II", temp, 0)
  numerpakietu = temp_ns[0]
  ilecharow = temp_ns[1]
  tempstring = ''
  for x in range (ilecharow):
    tempch = struct.unpack_from("s", temp, 8+x)
    tempstr = str(tempch)
    tempchar = tempstr[3] 
    tempstring = tempstring + tempchar

  wynik[numerpakietu-1] = tempstring
  itr = itr + 1
  if itr >= ilepaczek:
    oblicz_wynik = False

print("\nKoljność składania pakietów: ")
print(wynik)

print("\nWynik:")
for p in wynik:
  print(p, end="")
