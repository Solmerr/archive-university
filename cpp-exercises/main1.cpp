#include <iostream>
#include <math.h>
#include <iomanip>

using namespace std;

double f(double x){
	return cos(x)-x;
}

int main() {
	int i;
	double xL,xR,xM;
	double Error,Tol;

	cout<<"Enter xL:"<<endl;
	cin>>xL;
	cout<<"Enter xR:"<<endl;
	cin>>xR;
	cout<<"Enter Tol:"<<endl;
	cin>>Tol;

	//Check that root is in the interval
	if(f(xL)*f(xR)>0.0){
		cout<<"Root not in the given interval!"<<endl;
		system("pause");
		return 0;
	}

	i=0;
	do{
		xM=(xR+xL)/2.0;
		if((f(xL)*f(xM))>0.0){
			xL=xM;
		}
		else{
			xR=xM;
		}
		Error=fabs((xR-xL)/xM);
		i++;
	}while(Error>Tol);

	cout<<"Root found at: "<<setprecision(8)<<xM<<endl;
	cout<<"Number of iterations: "<<i<<endl;

	return 0;
}
