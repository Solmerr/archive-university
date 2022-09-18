#include <iostream>

using namespace std;

double f(double x)
{
	return (1.0/(1.0+x*x));
}

int main() {
	int n=11;
	double xj[n],a[n],b[n],c[n],r[n],pjPP[n],pj[n],Beta[n],Rho[n];
	double x,h,p,xR;

	//Initial values
	h=1.0;

	//Initial values for pj and xj
	xj[0]=-5.0;
	for(int j=0;j<n;j++)
	{
		if(j>0) xj[j]=xj[j-1]+h;
		pj[j]=f(xj[j]);
	}

	//Initial values for r
	r[0]=0.0;
	r[n-1]=0.0;
	for(int j=1;j<(n-1);j++)
	{
		r[j]=(6.0/h)*(pj[j+1]-2.0*pj[j]+pj[j-1]);
	}

	//Initial values for a,b,c
	a[0]=0.0; //not used
	a[1]=0.0;
	a[n-1]=0.0;
	for(int j=2;j<(n-1);j++)
	{
		a[j]=h;
	}

	b[0]=1.0;
	b[n-1]=1.0;
	for(int j=1;j<(n-1);j++)
	{
		b[j]=4.0*h;
	}

	c[0]=0.0;
	c[n-2]=0.0;
	c[n-1]=0.0; //not used
	for(int j=1;j<(n-2);j++)
	{
		c[j]=h;
	}

	//Gaussian Elimination
	Beta[0]=b[0];
	Rho[0]=r[0];
	for(int j=1;j<n;j++)
	{
		Beta[j]=b[j]-(a[j]/Beta[j-1])*c[j-1];
		Rho[j]=r[j]-(a[j]/Beta[j-1])*Rho[j-1];
	}
	pjPP[n-1]=Rho[n-1]/Beta[n-1];
	for(int j=2;j<=n;j++)
	{
		pjPP[n-j]=(Rho[n-j]-c[n-j]*pjPP[n-j+1])/Beta[n-j];
	}

	//Print pjPP
	for(int j=0;j<n;j++)
	{
		cout<<"p"<<j+1<<"PP= "<<pjPP[j]<<endl;
	}

	//Calculation of the polynomial p
	x=-5.0;
	xR=xj[1]; //initial interval xj[0] xj[1]
	int j=0;
	do
	{
		if(x>xR) //jump to next interval
		{
			j++;
			xR=xj[j+1];
		}
		p=pj[j]+((pj[j+1]-pj[j])/h-(h*pjPP[j+1])/6.0-(h*pjPP[j])/3.0)*(x-xj[j]);
		p=p+(pjPP[j]/2.0)*(x-xj[j])*(x-xj[j])+((pjPP[j+1]-pjPP[j])/(6.0*h))*(x-xj[j])*(x-xj[j])*(x-xj[j]);

		cout<<x<<"  "<<p<<"  "<<f(x)<<endl;
		x=x+0.1;
	}while(x<5.0001);

	return 0;
}
