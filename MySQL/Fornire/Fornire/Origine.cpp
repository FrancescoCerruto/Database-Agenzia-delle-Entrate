#include <iostream>
#include <fstream>
using namespace std;

int main()
{
	ofstream out;
	out.open("Fornire.txt");
	for (int i = 1; i <= 372; i++)
	{
		out << 1 << '\t' << i << '\t' << "Legale" << '\t' << 32 << endl;
		out << 2 << '\t' << i << '\t' << "Legale" << '\t' << 32 << endl;
		out << 3 << '\t' << i << '\t' << "Controlli" << '\t' << 48 << endl;
		out << 4 << '\t' << i << '\t' << "Territoriale" << '\t' << 96 << endl;
		out << 5 << '\t' << i << '\t' << "Controlli" << '\t' << 48 << endl;
		out << 6 << '\t' << i << '\t' << "Legale" << '\t' << 32 << endl;
	}
}