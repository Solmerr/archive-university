import math
import random
import statistics as stat
import time

n = int(input("Ilość punktów: "))
points = []

for i in range (1, n+1):
	p = (random.randint(0, 100), random.randint(0, 100))
	points.append(p)

#print("Wszystkie punkty: ", points)

def brute_force(points, n):
	X, Y = list(zip(*points))
	#print("Współrzędne x kolejnych punktów: ", X)
	#print("Współrzędne y kolejnych punktów: ", Y)

	X_1 = 0
	Y_1 = 0
	X_2 = 0
	Y_2 = 0

	dist_min = 142
	for i in range (0, n-1):
		p1 = (X[i], Y[i])
		for j in range (i+1, n-1):
			p2 = (X[j], Y[j])
			dist = math.sqrt(pow((p1[0] - p2[0]), 2) + pow((p1[1] - p2[1]), 2))
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


start = time.time()
brute_force(points, n)
end = time.time()
print(end - start)