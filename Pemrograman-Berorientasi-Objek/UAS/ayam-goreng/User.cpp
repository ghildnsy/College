#include "User.h"
#include <iostream>
using namespace std;

// ==== CONSTRUKTOR USER ====
User::User(int id, string uname, string pwd, string r)
    : idUser(id), username (uname), password(pwd), role(r){}

// ==== AUTENTIKASI USER ====
bool User::login(string uname, string pwd){
    return (username == uname && password == pwd);
} 

// ==== DISPLAY INFO USER ====
void User::displayInfo(){
    cout << "ID: " << idUser << "\nUsername: " << username << "\nRole" << role << endl;
}

// ==== GETTER ROLE USER ====  
string User::getRole(){
    return role;
}

// ==== DESTRUCTOR USER ====
User::~User(){}