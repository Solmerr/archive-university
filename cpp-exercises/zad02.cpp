#include <iostream>
#include <bitset>
#include <sstream>
#include <vector>
#include <algorithm>
#include <string>
#include <bits/stdc++.h>

using namespace std;

// Packet structure
struct Packet {
    uint32_t number_;
    uint32_t size_;
};

// Convert to string
template <class T> string to_string(T obj) {
    stringstream ss;
    ss << obj;
    return ss.str();
}


int main()
{
    // Data to pack and send
    string data_ = "123uvu1ctcff779gh";

    // Initialize packet
    Packet p;

    // Initialize block for data transfer
    vector<string> vec;

    // Size of the data part
    unsigned int p_size = 5;
    unsigned int iteration = 1;

    // Allocate memory block for the part of the data
    for (unsigned long int i = 0; i < data_.size(); i += p_size) {
        void* mal = malloc(sizeof(Packet) + p_size);
        Packet* p = (Packet*)mal;

        p->number_ = iteration;
        p->size_ = p_size;

        // Check if any part of the data exceeds initial size of the data part (p_size)
        // if yes -> change the size
        if (data_.size() - i < p_size) {
            p_size = data_.size() - i;
            p->size_ = data_.size() - i;
        }

        // "Send" packets to vector
        vec.push_back("");
        stringstream ss;
        ss << p->number_;
        ss << p->size_;
        vec.back() += ss.str();
        for(unsigned int j = 0; j < p->size_; j++) {
            vec.back().push_back(data_[i + j]);
        }
        iteration++;
    }

    // Print the result structure
    cout << "\t\t Number   Size     Data" << endl;

    for (int i = 0; i < vec.size(); i++) {
        cout << vec[i] << "\t";
        string s = vec[i];
        cout << "Packet" << i + 1 << ": ";
        for (size_t j = 0; j < s.size(); ++j) {
            cout << bitset<8>(s.c_str()[j]) << " ";
        }
        cout << endl;
    }

    // Swapping 1st and 2nd packet
    swap(vec[0], vec[1]);

    // Piece together result (remove number of packet and size of the packet)
    string result = "";
    int iter = 1;
    while(iter!=vec.size()+1) {
        for (int i = 0; i < vec.size(); i++) {
            string s = vec[i];
            string sp = to_string(s[0]);
            string si = to_string(iter);
            if(sp==si) {
                s.erase(0,2);
                result.append(s);
                iter++;
            }
        }
    }

    // Result
    cout << "\nResult: " << result << endl;

    return 0;
}
