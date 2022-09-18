#include <iostream>
#include <cmath>
#include <iomanip>

using namespace std;

//f(x)
double calc_fx(double x) {
    double value = cos(x) - x;
    return value;
}

//x0
double calc_x0(double xl, double xr, double f_xr, double f_xl) {
    double value = (xl*f_xr-xr*f_xl)/(f_xr-f_xl);
    return value;
}

int main()
{
    double xl = 0;
    double xr = 1;
    double tol = pow(10,-8);
    double x0 = 0;
    int iteration = 0;

    bool loop = true;
    while (loop) {
        double f_xl = calc_fx(xl);
        double f_xr = calc_fx(xr);
        double x1 = calc_x0(xl, xr, f_xr, f_xl);
        iteration = iteration + 1;
        cout << setprecision(10) << iteration << "\t" << x1 << endl;

        double error = abs((x1-x0)/x1);
        if (error<=tol) loop = false;

        if (calc_fx(xl)*calc_fx(x0)<0) {
            xr = x1;
        }
        else {
            xl = x1;
        }
        x0 = x1;
    }
    return 0;
}
