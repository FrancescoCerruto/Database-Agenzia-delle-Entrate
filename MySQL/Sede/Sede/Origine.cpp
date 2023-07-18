#include <iostream>
#include <fstream>
#include <string>
using namespace std;

int main()
{
	ofstream out;
	ifstream in;
	string line;
	string outline;
	int c_tab;
	out.open("D:/Documenti/Università/CdL Informatica/Secondo anno/Primo semestre/Database/Esame/Progetto/Data import/Sede.sql");
	in.open("D:/Documenti/Università/CdL Informatica/Secondo anno/Primo semestre/Database/Esame/Progetto/Data import/Sede.txt");
	if (in.is_open())
	{
		for (int i = 0; i < 372; i++)
		{
			getline(in, line);
			c_tab = 0;
			for (int j = 0; j < line.length(); j++)
			{
				if (line[j] == '\t')
				{
					c_tab++;
					if (c_tab == 1)
					{
						outline += ',';
						outline += '"';
					}
					else
					{
						if (i < 266)
						{
							outline += '"';
							outline += ',';
							outline += '"';
						}
						else
						{
							if (c_tab < 3)
							{
								outline += '"';
								outline += ',';
								outline += '"';
							}
							else
							{
								outline += '"';
								outline += ',';
							}
						}
					}
				}
				else
				{
					outline += line[j];
					if (i < 266 && j == line.length()-1)
					{
						outline += '"';
					}
				}
			}
			out << "insert into sede values(" << outline << ");" << endl;
			outline = "";
		}
	}
}