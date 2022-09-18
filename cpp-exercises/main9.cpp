#include <iostream>
#include <math.h>
#include <iomanip>

using namespace std;

double f(double x){
	return sin(x);
}

double fp(double x){
	return cos(x);
}

double fppp(double x){
	return -1.0*cos(x);
}

void Trapezoid(){
	double h,I,x;
	double PI=3.14159265358979323846;

	for(int N=4;N<=1024;N*=2){
		h=PI/(1.0*N);
		x=0.0;
		I=0.0;
		for(int i=0;i<=N;i++){
			if((i==0)||(i==N)){
				I=I+f(x)/2.0;
			}
			else {
				I=I+f(x);
			}
			x=x+h;
		}
		I=I*h;
		cout<<"Integral(Trapezoid, N= "<<N<<")= "<<setprecision(13)<<I<<endl;
	}
}

void Simpson(){
	double h,I,x;
	double PI=3.14159265358979323846;

	for(int N=4;N<=1024;N*=2){
		h=PI/(1.0*N);
		x=0.0;
		I=0.0;
		for(int i=0;i<=N;i++){
			if((i==0)||(i==N)){
				I=I+f(x);
			}
			else if(i%2==0){
				I=I+2.0*f(x);
			}
			else{
				I=I+4.0*f(x);
			}
			x=x+h;
		}
		I=I*h/3.0;
		cout<<"Integral(Simpson, N= "<<N<<")= "<<setprecision(13)<<I<<endl;
	}
}

void Boole(){
	double h,I,x;
	double PI=3.14159265358979323846;

	for(int N=4;N<=1024;N*=2){
		h=PI/(1.0*N);
		x=0.0;
		I=0.0;
		for(int i=0;i<=N;i++){
			if((i==0)||(i==N)){
				I=I+7.0*f(x);
			}
			else if(i%2!=0){
				I=I+32.0*f(x);
			}
			else if(i%4==0){
				I=I+14.0*f(x);
			}
			else{
				I=I+12.0*f(x);
			}
			x=x+h;
		}
		I=I*(2.0*h/45.0);
		cout<<"Integral(Boole, N= "<<N<<")= "<<setprecision(13)<<I<<endl;
	}
}

void EulerMacLaurin(){
	double PI=3.14159265358979323846;
	double h,I,x,x0=0.0,xN=PI;

	for(int N=4;N<=1024;N*=2){
		h=PI/(1.0*N);
		x=0.0;
		I=0.0;
		for(int i=0;i<=N;i++){
			if((i==0)||(i==N)){
				I=I+f(x)/2.0;
			}
			else {
				I=I+f(x);
			}
			x=x+h;
		}
		I=I*h;
		I=I+(h*h/12.0)*(fp(x0)-fp(xN))-(h*h*h*h/720.0)*(fppp(x0)-fppp(xN));
		cout<<"Integral(EulerMacLaurin, N= "<<N<<")= "<<setprecision(13)<<I<<endl;
	}
}


int main() {
	int choice,mMax;

	do{
		cout<<"Menu: (1)Trapezoid rule ; (2)Simpson rule ; (3)Boole rule ; (4)EulerMacLaurin rule"<<endl;
		cout<<"Menu: (5)Exit"<<endl;
		cin>>choice;
		switch(choice){
			case 1:
				Trapezoid();
				break;
			case 2:
				Simpson();
				break;
			case 3:
				Boole();
				break;
			case 4:
				EulerMacLaurin();
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
