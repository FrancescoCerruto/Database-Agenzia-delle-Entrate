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
	out.open("D:/Documenti/Università/CdL Informatica/Secondo anno/Primo semestre/Database/Esame/Progetto/Data import/Richiesta.sql");
	in.open("D:/Documenti/Università/CdL Informatica/Secondo anno/Primo semestre/Database/Esame/Progetto/Richiesta.txt");
	if (in.is_open())
	{
		for (int i = 0; i < 3000; i++)
		{
			getline(in, line);
			outline += line[0];
			outline += line[1];
			outline += line[2];
			outline += line[3];
			outline += line[4];
			outline += line[5];
			outline += line[6];
			outline += line[7];
			outline += line[8];
			outline += line[9];
			outline += line[10];
			outline += line[11];
			outline += line[12];
			outline += line[13];
			outline += ',';
			outline += '"';
			c_tab = 1;
			outline += line[15];
			outline += line[16];
			outline += line[17];
			outline += line[18];
			outline += '"';
			outline += ',';
			outline += '"';
			c_tab = 2;
			for (int j = 20; j < line.length(); j++)
			{
				if (line[j] == '\t')
				{
					c_tab++;
					if (c_tab < 9 || c_tab == 11)
					{
						outline += '"';
						outline += ',';
						outline += '"';
					}
					else
					{
						if (c_tab == 9 || c_tab == 12)
						{
							outline += '"';
							outline += ',';
						}
						else
						{
							if (c_tab == 10 || c_tab == 14)
							{
								outline += ',';
								outline += '"';
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
			outline += '"';
			out << "insert into richiesta (data_ricezione,id_cliente,tipo_cliente,nome,cognome,codice_fiscale,indirizzo_residenza,comune,provincia,id_sede,regione_sede,provincia_sede,comune_sede,id_servizio,servizio_richiesto) values(" << outline << ");" << endl;
			outline = "";
		}
	}
}