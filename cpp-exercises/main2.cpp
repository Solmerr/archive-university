#include <cstdlib>
#include <iostream>
#include <math.h>
#include <iomanip>

using namespace std;

double f(double x){
	return (cos(x)-x);
	//return ((6435.0*pow(x,8)-12012.0*pow(x,6)+6930.0*pow(x,4)-1260.0*pow(x,2)+35.0)/128.0);
	//return (pow(x,3)-169.0);
}

double f_p(double x){
	return (-1.0*sin(x)-1);
	//return ((8.0*6435.0*pow(x,7)-6.0*12012.0*pow(x,5)+4.0*6930.0*pow(x,3)-2.0*1260.0*x)/128.0);
	//return (3.0*pow(x,2));
}

int main()
{
	double xNew,xOld,Tol,Error;
	int i;

	cout<<"Enter x0:"<<endl;
	cin>>xOld;
	cout<<"Enter Tolerance:"<<endl;
	cin>>Tol;

	//Newton-Raphson
	i=0;
	do{
		xNew=xOld-(f(xOld)/f_p(xOld));
		Error=fabs((xNew-xOld)/xNew);
		i++;
		cout<<"i= "<<i<<" x0= "<<setprecision(8)<<xNew<<endl;
		xOld=xNew;
	}while(Error>Tol);

	cout<<"Root found at: "<<setprecision(8)<<xNew<<endl;
	cout<<"Number of iterations: "<<i<<endl;

	system("pause");
	return 0;
}
