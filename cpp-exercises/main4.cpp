#include <iostream>
#include <math.h>
#include <iomanip>

using namespace std;

double f(double x)
{
	return cos(x)-x;
}

int main() {
	double xNew,xOld,xOlder,xR,xL;
	double Tol,Error;
	int i;

	Tol=0.00000001;

	cout<<"False-Position:"<<endl;
	cout<<"Enter xL:"<<endl;
	cin>>xL;
	cout<<"Enter xR:"<<endl;
	cin>>xR;

	xOld=xL; //Used to calculate first Error
	i=0;
	do
	{
		xNew=(xL*f(xR)-xR*f(xL))/(f(xR)-f(xL));
		i++;
		cout<<"i= "<<i<<" xNew= "<<setprecision(8)<<xNew<<" xL= "<<xL<<" xR= "<<xR<<endl;
		if((f(xL)*f(xNew))<0.0)
		{
			xR=xNew;
		}
		else
		{
			xL=xNew;
		}
		Error=fabs((xNew-xOld)/xNew);
		xOld=xNew;
	}while(Error>Tol);

	cout<<"Root found at: "<<setprecision(8)<<xNew<<endl;
	cout<<"Iterations: "<<i<<endl;


	cout<<endl<<"Secant:"<<endl;
	cout<<"Enter x_i-1:"<<endl;
	cin>>xOlder;
	cout<<"Enter xi:"<<endl;
	cin>>xOld;

	i=0;
	do
	{
		xNew=(xOlder*f(xOld)-xOld*f(xOlder))/(f(xOld)-f(xOlder));
		i++;
		Error=fabs((xNew-xOld)/xNew);
		xOlder=xOld;
		xOld=xNew;
		cout<<"i= "<<i<<" xNew= "<<setprecision(8)<<xNew<<endl;
	}while(Error>Tol);

	cout<<"Root found at: "<<setprecision(8)<<xNew<<endl;
	cout<<"Iterations: "<<i<<endl;

	return 0;
}
