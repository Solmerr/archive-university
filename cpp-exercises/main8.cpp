#include <iostream>
#include <math.h>
#include <iomanip>

using namespace std;

double f(double x){
	return (x*exp(x));
}

void fpForward(){
	double X[10],Y[10];
	double S1=0.0,S2=0.0,S3=0.0,S4=0.0;
	double h,fp,E,Exact;
	cout<<"Calculation of f'(2) with forward formula:"<<endl;

	Exact=exp(2.0)+2.0*exp(2.0);
	h=0.05;
	for(int i=0;i<10;i++){
		fp=(f(2.0+h)-f(2.0))/h;
		cout<<"h= "<<h<<" fp= "<<fp<<endl;
		E=fabs(fp-Exact);
		X[i]=log(h);
		Y[i]=log(E);
		h=h+0.05;
	}
	cout<<"Exact= "<<setprecision(12)<<Exact<<endl;
	for(int i=0;i<10;i++){
		S1=S1+X[i]*Y[i];
		S3=S3+X[i]*X[i];
		S4=S4+X[i];
		for(int j=0;j<10;j++){
			S2=S2+X[i]*Y[j];
		}
	}
	cout<<"Order of the error: "<<((10.0*S1-S2)/(10.0*S3-S4*S4))<<endl;
}

void fpCentral(){
	double X[10],Y[10];
	double S1=0.0,S2=0.0,S3=0.0,S4=0.0;
	double h,fp,E,Exact;
	cout<<"Calculation of f'(2) with central formula:"<<endl;

	Exact=exp(2.0)+2.0*exp(2.0);
	h=0.05;
	for(int i=0;i<10;i++){
		fp=(f(2.0+h)-f(2.0-h))/(2.0*h);
		cout<<"h= "<<h<<" fp= "<<fp<<endl;
		E=fabs(fp-Exact);
		X[i]=log(h);
		Y[i]=log(E);
		h=h+0.05;
	}
	cout<<"Exact= "<<setprecision(12)<<Exact<<endl;
	for(int i=0;i<10;i++){
		S1=S1+X[i]*Y[i];
		S3=S3+X[i]*X[i];
		S4=S4+X[i];
		for(int j=0;j<10;j++){
			S2=S2+X[i]*Y[j];
		}
	}
	cout<<"Order of the error: "<<((10.0*S1-S2)/(10.0*S3-S4*S4))<<endl;
}

void fppForward(){
	double X[10],Y[10];
	double S1=0.0,S2=0.0,S3=0.0,S4=0.0;
	double h,fpp,E,Exact;
	cout<<"Calculation of f''(2) with forward formula:"<<endl;

	Exact=4.0*exp(2.0);
	h=0.05;
	for(int i=0;i<10;i++){
		fpp=(f(2.0)-2.0*f(2.0+h)+f(2.0+2.0*h))/(h*h);
		cout<<"h= "<<h<<" fpp= "<<fpp<<endl;
		E=fabs(fpp-Exact);
		X[i]=log(h);
		Y[i]=log(E);
		h=h+0.05;
	}
	cout<<"Exact= "<<setprecision(12)<<Exact<<endl;
	for(int i=0;i<10;i++){
		S1=S1+X[i]*Y[i];
		S3=S3+X[i]*X[i];
		S4=S4+X[i];
		for(int j=0;j<10;j++){
			S2=S2+X[i]*Y[j];
		}
	}
	cout<<"Order of the error: "<<((10.0*S1-S2)/(10.0*S3-S4*S4))<<endl;
}

void fppCentral(){
	double X[10],Y[10];
	double S1=0.0,S2=0.0,S3=0.0,S4=0.0;
	double h,fpp,E,Exact;
	cout<<"Calculation of f''(2) with central formula:"<<endl;

	Exact=4.0*exp(2.0);
	h=0.05;
	for(int i=0;i<10;i++){
		fpp=(f(2.0+h)-2.0*f(2.0)+f(2.0-h))/(h*h);
		cout<<"h= "<<h<<" fpp= "<<fpp<<endl;
		E=fabs(fpp-Exact);
		X[i]=log(h);
		Y[i]=log(E);
		h=h+0.05;
	}
	cout<<"Exact= "<<setprecision(12)<<Exact<<endl;
	for(int i=0;i<10;i++){
		S1=S1+X[i]*Y[i];
		S3=S3+X[i]*X[i];
		S4=S4+X[i];
		for(int j=0;j<10;j++){
			S2=S2+X[i]*Y[j];
		}
	}
	cout<<"Order of the error: "<<((10.0*S1-S2)/(10.0*S3-S4*S4))<<endl;
}

int main() {
	double h;
	int choice,n;

	do{
		cout<<"Menu: (1)f'(x) with Forward ; (2)f'(x) with Central"<<endl;
		cout<<"Menu: (3)f''(x) with Forward ; (4)f''(x) with Central ; (5)Exit"<<endl;
		cin>>choice;
		switch(choice){
			case 1:
				fpForward();
				break;
			case 2:
				fpCentral();
				break;
			case 3:
				fppForward();
				break;
			case 4:
				fppCentral();
				break;
			case 5:
				cout<<"Exit"<<endl;
				break;
			default:
				cout<<"Wrong choice"<<endl;
				break;
		}
	}while(choice!=5);

	return 0;
}







