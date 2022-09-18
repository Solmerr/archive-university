/*
    Zadanie 1
    Suma Modulo
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


//   M O D U L O   -------------------------------------------

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

// Convert binary string into vector
vector<char> to_vector_modulo(string result) {
    vector<char> vec(result.size());
    for (int i = 0; i < result.size(); i++) {
        vec[i] = result[i];
    }
    return vec;
}

// Count sum of the string
int count_sum(string file_string) {
    int sum = 0;
    for (int i = 0; i < file_string.size(); i++) {
        sum += (int)file_string[i];
    }
    return sum;
}

// Count modulo
int count_modulo(vector<char> vec) {
    int modulo = 0;
    for (int i = 0; i < vec.size(); i++) {
        if (vec[i]=='1') {
            modulo += pow(2,i%8);
        }
    }
    return modulo;
}

//   ---------------------------------------------------------





int main()
{
    cout << "----- MODULO -----" << endl;
    // read file as string -> convert into binary
    string file_string = read_into_string("test.txt");
    string result = to_binary_string(file_string);

    // count sum of the string
    int sum = count_sum(file_string);

    // count modulo before interruption
    int modulo_1 = sum%255;

    // convert modulo into binary & add to string
    bitset<8> bm (modulo_1);
    result += bm.to_string();

    // convert string into vector
    vector<char> vec_binary = to_vector_modulo(result);

    // interrupt transmission & set percent of errors \/ \/ \/ \/ \/ \/ \/ \/
    vec_binary = add_errors(vec_binary, 30.0);

    // extract file and modulo result
    vector<char> vec_file(vec_binary.size()-8);
    vector<char> vec_modulo(8);

    // vector file & reverse it
    for (int i = 0; i < vec_binary.size()-8; i++) {
        vec_file[i] = vec_binary[i];
    }
    reverse(vec_file.begin(), vec_file.end());

    // vector modulo & reverse it
    for (int i = vec_binary.size()-8; i < vec_binary.size(); i++) {
        vec_modulo[i-vec_file.size()] = vec_binary[i];
    }
    reverse(vec_modulo.begin(), vec_modulo.end());

    // modulo from file & errors
    int modulo_2 = count_modulo(vec_file);
    modulo_2 = modulo_2%255;

    // modulo from modulo & errors
    int modulo_3 = count_modulo(vec_modulo);
    modulo_3 = modulo_3%255;

    // print modulos
    cout << "modulos: " << modulo_1 << " " << modulo_2 << " " << modulo_3 << endl;

    // compare modulos
    if (modulo_1 == modulo_2 && modulo_2 == modulo_3) {
        cout << "transmission correct" << endl;
    } else {
        cout << "transmission error" << endl;
    }

    return 0;
}
