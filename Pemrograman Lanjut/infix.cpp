#include <iostream>
#include <string>
#include <cmath>
using namespace std;

// Struktur untuk Node dalam LinkedList
struct Node {
    char data;
    Node* next;
    
    Node(char value) {
        data = value;
        next = nullptr;
    }
};

// Class Stack menggunakan LinkedList
class Stack {
private:
    Node* top;
    
public:
    Stack() {
        top = nullptr;
    }
    
    // Fungsi untuk menambah elemen (push)
    void push(char x) {
        Node* newNode = new Node(x);
        newNode->next = top;
        top = newNode;
        cout << "Push: " << x << endl;
    }
    
    // Fungsi untuk mengambil elemen (pop)
    char pop() {
        if (!isEmpty()) {
            Node* temp = top;
            char value = temp->data;
            top = top->next;
            delete temp;
            cout << "Pop: " << value << endl;
            return value;
        }
        return '$';
    }
    
    // Fungsi untuk melihat elemen teratas
    char peek() {
        if (!isEmpty())
            return top->data;
        return '$';
    }
    
    // Fungsi untuk mengecek apakah stack kosong
    bool isEmpty() {
        return top == nullptr;
    }
    
    // Fungsi untuk menampilkan isi stack
    void displayStack() {
        cout << "Stack: ";
        Node* current = top;
        while (current != nullptr) {
            cout << current->data << " ";
            current = current->next;
        }
        cout << endl;
    }
    
    // Destructor untuk membersihkan memori
    ~Stack() {
        while (top != nullptr) {
            Node* temp = top;
            top = top->next;
            delete temp;
        }
    }
};

// Fungsi untuk mengecek prioritas operator
int precedence(char op) {
    if(op == '^')
        return 3;
    if(op == '*' || op == '/')
        return 2;
    if(op == '+' || op == '-')
        return 1;
    return -1;
}

// Fungsi untuk mengkonversi infix ke postfix
string infixToPostfix(string infix) {
    Stack st;
    string postfix;
    
    cout << "\n=== Konversi Infix ke Postfix ===" << endl;
    cout << "Infix: " << infix << endl;
    
    for(int i = 0; i < infix.length(); i++) {
        char c = infix[i];
        
        cout << "\nMemproses karakter: " << c << endl;
        
        // Jika karakter adalah operand
        if((c >= '0' && c <= '9') || (c >= 'a' && c <= 'z') || (c >= 'A' && c <= 'Z')) {
            postfix += c;
            cout << "Tambah ke output: " << c << endl;
        }
        
        // Jika karakter adalah kurung buka
        else if(c == '(') {
            st.push(c);
        }
        
        // Jika karakter adalah kurung tutup
        else if(c == ')') {
            while(!st.isEmpty() && st.peek() != '(') {
                postfix += st.pop();
            }
            if(!st.isEmpty())
                st.pop();  // Buang kurung buka
        }
        
        // Jika karakter adalah operator
        else {
            while(!st.isEmpty() && precedence(c) <= precedence(st.peek())) {
                postfix += st.pop();
            }
            st.push(c);
        }
        
        st.displayStack();
        cout << "Postfix saat ini: " << postfix << endl;
    }
    
    // Pop semua operator yang tersisa
    while(!st.isEmpty()) {
        if(st.peek() != '(')
            postfix += st.pop();
        else
            st.pop();
    }
    
    cout << "\nHasil Postfix: " << postfix << endl;
    return postfix;
}

// Struktur untuk Node dalam Stack evaluasi
struct NodeEval {
    double data;
    NodeEval* next;
    
    NodeEval(double value) {
        data = value;
        next = nullptr;
    }
};

// Class Stack untuk evaluasi menggunakan LinkedList
class StackEval {
private:
    NodeEval* top;
    
public:
    StackEval() {
        top = nullptr;
    }
    
    void push(double x) {
        NodeEval* newNode = new NodeEval(x);
        newNode->next = top;
        top = newNode;
        cout << "Push: " << x << endl;
    }
    
    double pop() {
        if (!isEmpty()) {
            NodeEval* temp = top;
            double value = temp->data;
            top = top->next;
            delete temp;
            cout << "Pop: " << value << endl;
            return value;
        }
        return 0;
    }
    
    double peek() {
        if (!isEmpty())
            return top->data;
        return 0;
    }
    
    bool isEmpty() {
        return top == nullptr;
    }
    
    ~StackEval() {
        while (top != nullptr) {
            NodeEval* temp = top;
            top = top->next;
            delete temp;
        }
    }
};

// Fungsi untuk mengevaluasi ekspresi postfix
double evaluatePostfix(string postfix) {
    StackEval st;
    
    cout << "\n=== Evaluasi Postfix ===" << endl;
    cout << "Postfix: " << postfix << endl;
    
    for(int i = 0; i < postfix.length(); i++) {
        char c = postfix[i];
        
        cout << "\nMemproses karakter: " << c << endl;
        
        // Jika karakter adalah angka
        if(c >= '0' && c <= '9') {
            st.push(c - '0');
        }
        
        // Jika karakter adalah operator
        else {
            double val2 = st.pop();
            double val1 = st.pop();
            
            cout << "Operasi: " << val1 << " " << c << " " << val2 << endl;
            
            switch(c) {
                case '+': st.push(val1 + val2); break;
                case '-': st.push(val1 - val2); break;
                case '*': st.push(val1 * val2); break;
                case '/': st.push(val1 / val2); break;
                case '^': st.push(pow(val1, val2)); break;
            }
            
            cout << "Hasil: " << st.peek() << endl;
        }
    }
    
    return st.peek();
}

int main() {
    string infix;
    char lanjut;
    
    do {
        cout << "\n=== Program Konversi Infix ke Postfix dan Evaluasi ===" << endl;
        cout << "Masukkan ekspresi infix (gunakan angka 0-9): ";
        cin >> infix;
        
        try {
            string postfix = infixToPostfix(infix);
            double hasil = evaluatePostfix(postfix);
            
            cout << "\nRingkasan:" << endl;
            cout << "Infix   : " << infix << endl;
            cout << "Postfix : " << postfix << endl;
            cout << "Hasil   : " << hasil << endl;
        }
        catch(const exception& e) {
            cout << "Error: " << e.what() << endl;
        }
        
        cout << "\nIngin mencoba lagi? (y/n): ";
        cin >> lanjut;
        
    } while(lanjut == 'y' || lanjut == 'Y');
    
    return 0;
}
