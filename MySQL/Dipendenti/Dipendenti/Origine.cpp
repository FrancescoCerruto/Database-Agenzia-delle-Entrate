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
	out.open("D:/Documenti/Università/CdL Informatica/Secondo anno/Primo semestre/Database/Esame/Progetto/Data import/Dipendete.sql");
	in.open("D:/Documenti/Università/CdL Informatica/Secondo anno/Primo semestre/Database/Esame/Progetto/Data import/Dipendente.txt");
	if (in.is_open())
	{
		for (int i = 0; i < 6696; i++)
		{
			getline(in, line);
			outline += '"';
			c_tab = 0;
			for (int j = 0; j < line.length(); j++)
			{
				if (line[j] == '\t')
				{
					c_tab++;
					if (c_tab < 9)
					{
						outline += '"';
						outline += ',';
						outline += '"';
					}
					else
					{

						if (c_tab == 9 || c_tab == 13)
						{
							outline += '"';
							outline += ',';
						}
						else
						{
							if (c_tab == 10 || c_tab == 11)
							{
								outline += ',';
							}
							else
							{
								outline += ',';
								outline += '"';
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