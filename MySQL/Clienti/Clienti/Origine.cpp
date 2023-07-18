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
	out.open("D:/Documenti/Università/CdL Informatica/Secondo anno/Primo semestre/Database/Esame/Progetto/Data import/Cliente.sql");
	in.open("D:/Documenti/Università/CdL Informatica/Secondo anno/Primo semestre/Database/Esame/Progetto/Data import/Cliente.txt");
	if (in.is_open())
	{
		for (int i = 0; i < 3000; i++)
		{
			getline(in, line);
			outline += '"';
			c_tab = 0;
			for (int j = 0; j < line.length(); j++)
			{
				if (line[j] == '\t')
				{
					c_tab++;
					if (i < 750)
					{
						if (c_tab < 10)
						{
							outline += '"';
							outline += ',';
							outline += '"';
						}
						else
						{

							if (c_tab == 10)
							{
								outline += '"';
								outline += ',';
							}
							else
							{
								outline += ',';
							}
						}
					}
					else
					{
						if (c_tab < 9)
						{
							outline += '"';
							outline += ',';
							outline += '"';
						}
						else
						{

							if (c_tab == 9)
							{
								outline += '"';
								outline += ',';
							}
							else
							{
								outline += ',';
							}
						}
					}
				}
				else
				{
					outline += line[j];
				}
			}
			out << "insert into utente (nome,cognome,codice_fiscale,data_nascita,indirizzo_residenza,comune,provincia,password,tipo,delegante,n_stanza,id_sede_area,nome_area,id_servizio) values(" << outline << ");" << endl;
			outline = "";
		}
	}
}