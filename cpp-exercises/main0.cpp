#include <iostream>
#include <cmath>

using namespace std;

//f(x)=cos(x)-x

//f(xi)
double calc_value(double x) {
    double value = cos(x) - x;
    return value;
}

//f'(xi)
double derivative(double x) {
    double value = -sin(x) - 1;
    return value;
}
//--------------------------------------
double calc_next(double x, double fx, double fx1) {
    double value = x - (fx / fx1);
    return value;
}

// -------------------------------------
//P(x)
double px(double x) {
    double value = (6435*pow(x,8) - 12012*pow(x,6) + 6930*pow(x,4) - 1260*pow(x,2) + 35)/128;
    return value;
}


//P'(x)
double px1(double x) {
    double value = (6435*8*pow(x,7) - 12012*6*pow(x,5) + 6930*4*pow(x,3) - 1260*2*pow(x,1) + 35)/128;
    return value;
}
//---------------------------------------


double print_end(double x0, double x1) {
    double value = abs((x1-x0)/x1);
    cout << "End." << endl;
}
//----------------------------------------

int main()
{

    double x0 = 0.0;
    double x1 = 1.0;
    double fx = 0.0;
    double fx1 = 0.0;
    double tolerance = pow(10, -8);

    while (abs((x1-x0)/x1) >= tolerance) {
        x0 = x1;
        fx = calc_value(x1);
        fx1 = derivative(x1);
        x1 = calc_next(x1, fx, fx1);
        cout << x1 << endl;
    }
    print_end(x0, x1);
    cout << "\n\n";

    // --------------------------------------
    x0 = 0.0;
    x1 = 1.0;
    fx = 0.0;
    fx1 = 0.0;
    tolerance = pow(10, -8);

    while (x1 >= 0.5) {
        while (abs((x1-x0)/x1) >= tolerance) {
            x0 = x1;
            fx = px(x1);
            fx1 = px1(x1);
            x1 = calc_next(x1, fx, fx1);
        }
        x0 = 0.0;
        cout << x1 << endl;
        //nie petli sie
    }

    print_end(x0, x1);

    return 0;
}
