/*
    Zadanie 1
    Parity Bit
    Michal Jablonowski
*/

#include <iostream>
#include <fstream>
#include <string>
#include <bitset>
#include <iomanip>
#include <vector>
#include <bitset>
#include <random>
#include <sstream>
#include <math.h>
#include <algorithm>

using namespace std;


//   P A R I T Y   B I T   -----------------------------------

// Open file & read file
string read_into_string(string file_name) {
    ifstream ifs(file_name);
    string file_string;

    if(ifs) {
        ostringstream oss;
        oss << ifs.rdbuf();
        file_string = oss.str();
    }

    return file_string;
}

// Print vector
void print_vector(vector<char> vec) {
    for (int i = 0; i < vec.size(); i++) {
        cout << vec[i];
    }
}

// Errors / Interrupt
vector<char> add_errors (vector<char> vec, float error_percent) {
    float f1 = error_percent;
    float f2 = f1/100;
    int errors = int(f2*vec.size());
    int error_index = 0;
    cout << errors << " errors" << endl;
    for (int k = 0; k < errors; k++) {
        error_index = rand() % vec.size();
        if (vec[error_index]=='0') {
            vec[error_index] = '1';
        }
        else if (vec[error_index]=='1') {
            vec[error_index] = '0';
        }
    }
    return vec;
}

// Convert to string
template <class T>
string to_string(T obj)
{
    stringstream ss;
    ss << obj;
    return ss.str();
}

// Convert string into binary string
string to_binary_string(string str) {
    string binary_str = "";
    for (char& ch : str) {
        binary_str += bitset<8>(ch).to_string();
    }
    return binary_str;
}

// Convert binary string into vector with '0' at the end
vector<char> to_vector(string result) {
    vector<char> vec(result.size());
    for (int i = 0; i < result.size(); i++) {
        vec[i] = result[i];
    }
    // add temporary result
    vec.push_back('0');
    return vec;
}

// Calculate parity bit
char calc_parity_bit(vector<char> vec) {
    char parity_bit = '0';
    for (int i = 0; i < vec.size()-1; i++) {
        if (vec[i]=='1' && parity_bit=='1') {
            parity_bit='0';
        }
        else if (vec[i]=='1' && parity_bit=='0') {
            parity_bit='1';
        }
    }
    return parity_bit;
}

// Add result from calculating parity bit to vector
vector<char> add_parity_bit(vector<char> vec, char parity_bit) {
    vec.back() = parity_bit;
    return vec;
}

// Check parity bits
void check_parity_bits (char parity_bit, char parity_bit_2) {
    if (parity_bit_2==parity_bit) {
        cout << "transmission correct" << endl;
    }
    else if (parity_bit_2!=parity_bit) {
        cout << "transmission error" << endl;
    }
}

// -----------------------------------------------------------





int main()
{
    cout << "----- PARITY BIT -----" << endl;
    // read file as string -> convert into binary -> write to vector
    string file_string = read_into_string("test.txt");
    string result = to_binary_string(file_string);
    vector<char> vec = to_vector(result);

    // calculate parity bit
    char parity_bit = calc_parity_bit(vec);

    // set last element to parity bit
    vec.back() = parity_bit;

    // interrupt transmission & set percent of errors \/ \/ \/ \/ \/ \/ \/ \/
    vec = add_errors(vec, 20.0);

    // calculate parity bit after interruption
    char parity_bit_2 = calc_parity_bit(vec);
    cout << "parity bits: " << parity_bit << " " << parity_bit_2 << endl;

    // look for errors in transmission
    check_parity_bits(parity_bit, parity_bit_2);

    return 0;
}
