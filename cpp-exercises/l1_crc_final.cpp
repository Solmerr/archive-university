/*
    Zadanie 1
    CRC
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


//   C R C   -------------------------------------------------

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

// Errors / Interrupt with repetition
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

// Errors / Interrupt without repetition
vector<char> add_errors_2 (vector<char> vec, float error_percent) {
    float f1 = error_percent;
    float f2 = f1/100;
    int errors = int(f2*vec.size());
    int error_index = 0;
    vector<int> vec_index;
    cout << errors << " errors" << endl;
    for (int k = 0; k < errors; k++) {
        error_index = rand() % vec.size();
        if (count(vec_index.begin(), vec_index.end(), error_index)) {
            k--;
        } else {
            vec_index.push_back(error_index);
            if (vec[error_index]=='0') {
                vec[error_index] = '1';
            }
            else if (vec[error_index]=='1') {
                vec[error_index] = '0';
            }
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
vector<char> to_vector(string result) {
    vector<char> vec(result.size());
    for (int i = 0; i < result.size(); i++) {
        vec[i] = result[i];
    }
    return vec;
}

// XOR
vector<char> crc_xor (vector<char> vec_crc, vector<char> divisor) {
    for (int i = 0; i <= vec_crc.size()-divisor.size(); i++) {
        if (vec_crc[i]=='1') {
            for (int j = i; j < i + divisor.size(); j++) {
                if (vec_crc[j] == divisor[j-i]) {
                    vec_crc[j] = '0';
                } else {
                    vec_crc[j] = '1';
                }
            }
        }
    }
    return vec_crc;
}

//   ---------------------------------------------------------





int main()
{
    cout << "----- CRC -----" << endl;
    string file_string_crc = read_into_string("test_.txt");
    string result_crc = to_binary_string(file_string_crc);
    vector<char> vec_crc = to_vector(result_crc);
    vector<char> vec_crc_2 = vec_crc;

    // DIVISOR \/ \/ \/ \/ \/ \/ \/ \/ \/ \/ \/ \/ \/ \/ \/ \/ \/ \/ \/ \/
    vector<char> divisor = {'1','0','1','1','0','0','1','1'};

    // add set of '0' at the end of the vector
    for (int i = 0; i < divisor.size()-1; i++) {
        vec_crc_2.push_back('0');
    }

    // xor
    vec_crc_2 = crc_xor(vec_crc_2, divisor);

    // extract checksum before transmission
    vector<char> checksum_1 = {};
    for (int i = vec_crc_2.size()-divisor.size()+1; i < vec_crc_2.size(); i++) {
        checksum_1.push_back(vec_crc_2[i]);
    }

    // add checksum to the vector
    for (int i = 0; i < checksum_1.size(); i++) {
        vec_crc.push_back(checksum_1[i]);
    }

    // interrupt transmission & set percent of errors \/ \/ \/ \/ \/ \/ \/ \/
    vec_crc = add_errors_2(vec_crc, 0.1);

    // xor
    vec_crc = crc_xor(vec_crc, divisor);

    // extract checksum after transmission
    vector<char> checksum_2 = {};
    for (int i = vec_crc.size()-divisor.size()+1; i < vec_crc.size(); i++) {
        checksum_2.push_back(vec_crc[i]);
    }

    // print checksums
    cout << "checksums: ";
    print_vector(checksum_1);
    cout << " ";
    print_vector(checksum_2);
    cout << endl;

    // check checksum after transmission
    bool is_error = false;
    for (int i = 0; i < checksum_2.size(); i++) {
        if (checksum_2[i] == '1') {
            is_error = true;
        }
    }

    // print result
    if (is_error) {
        cout << "transmission error" << endl;
    } else {
        cout << "transmission correct" << endl;
    }

    return 0;
}
