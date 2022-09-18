import math
import random
import statistics as stat

n = int(input("Ilość punktów: "))
points = []

for i in range (1, n+1):
	p = (random.randint(0, 100), random.randint(0, 100))
	points.append(p)

#print("Wszystkie punkty: ", points)

def znajdz_najblizsze(points, n):
	X, Y = list(zip(*points))
	#print("Współrzędne x kolejnych punktów: ", X)
	#print("Współrzędne y kolejnych punktów: ", Y)

	median = stat.median_high(X)
	XL = []
	XR = []
	YL = []
	YR = []

	if (n % 2) == 0:
		for i in range (0, n):
			if X[i] < median:
				XL.append(X[i])
				YL.append(Y[i])
			else:
				XR.append(X[i])
				YR.append(Y[i])

	if (n % 2) == 1:
		for i in range (0, n):
			if X[i] <= median:
				XL.append(X[i])
				YL.append(Y[i])
			else:
				XR.append(X[i])
				YR.append(Y[i])
	'''
	print(XL)
	print(YL)
	print(XR)
	print(YR)
	'''

	X_1 = 0
	Y_1 = 0
	X_2 = 0
	Y_2 = 0

	dist_min = 142
	for i in range (0, len(XL)):
		p1 = [XL[i], YL[i]]
		for j in range ((i + 1), len(XL)):
			p2 = [XL[j], YL[j]]
			dist = math.sqrt(pow((p1[0] - p2[0]), 2) + pow((p1[1] - p2[1]), 2))
			#print(dist)
			if dist < dist_min:
				dist_min = dist
				X_1 = p1[0]
				Y_1 = p1[1]
				X_2 = p2[0]
				Y_2 = p2[1]
	#print(dist_min)


	for i in range (0, len(XR)):
		p1 = [XR[i], YR[i]]
		for j in range ((i + 1), len(XR)):
			p2 = [XR[j], YR[j]]
			dist = math.sqrt(pow((p1[0] - p2[0]), 2) + pow((p1[1] - p2[1]), 2))
			#print(dist)
			if dist < dist_min:
				dist_min = dist
				X_1 = p1[0]
				Y_1 = p1[1]
				X_2 = p2[0]
				Y_2 = p2[1]
	#print(dist_min)

	XM = []
	YM = []
	for i in range (0, len(XL)):
		if XL[i] > (median - dist_min):
			XM.append(XL[i])
			YM.append(YL[i])
		else:
			pass

	for i in range (0, len(XR)):
		if XR[i] < (median + dist_min):
			XM.append(XR[i])
			YM.append(YR[i])
		else:
			pass

	for i in range (0, len(XM)):
		p1 = [XM[i], YM[i]]
		for j in range ((i + 1), len(XM)):
			p2 = [XM[j], YM[j]]
			dist = math.sqrt(pow((p1[0] - p2[0]), 2) + pow((p1[1] - p2[1]), 2))
			#print(dist)
			if dist < dist_min:
				dist_min = dist
				X_1 = p1[0]
				Y_1 = p1[1]
				X_2 = p2[0]
				Y_2 = p2[1]

	print("\nWYNIK")
	print("Najmniejsza odległość między punktami: ", dist_min)
	two_points = [(X_1, Y_1), (X_2, Y_2)]
	print("Punkty: ", two_points)


znajdz_najblizsze(points, n)
