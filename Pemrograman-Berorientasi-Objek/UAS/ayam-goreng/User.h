#ifndef USER_H
#define USER_H
#include <string>
using namespace std;

// ==== DEKLARASI USER CLASS ====
// class user ini merupakan class dasar untuk semua jenis user
class User{
protected:
    int idUser;
    string username;
    string password;
    string role; // admin, kasir, pelanggan

public:
    // ==== CONSTRUKTOR USER ====
    User(int id, string uname, string pwd, string r);
    virtual ~User();

    // ==== METHODE USER ====
    virtual void displayInfo();
    bool login(string uname, string pwd);
    string getRole();

    // ==== GETTER USER ====
    int getId() const { return idUser; }
    string getUsername() const { return username; }
    string getPassword() const { return password; }
};

#endif