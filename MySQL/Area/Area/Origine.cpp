#include <iostream>
#include <fstream>
using namespace std;

int main()
{
	ofstream out;
	out.open("Aree.txt");	/////
	for (int i = 1; i <= 372; i++)
	{
		out << "insert into area (nome, id_sede) values (" << "Controlli," << < i << ");" << endl;
		out << "insert into area (nome, id_sede) values (" << "Legale," << < i << ");" << endl;
		out << "insert into area (nome, id_sede) values (" << "Territoriale," << < i << ");" << endl;
	}
}