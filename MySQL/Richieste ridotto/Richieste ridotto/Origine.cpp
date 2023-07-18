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
	out.open("D:/Documenti/Università/CdL Informatica/Secondo anno/Primo semestre/Database/Esame/Progetto/Data import/Richiesta ridotto.sql");
	in.open("D:/Documenti/Università/CdL Informatica/Secondo anno/Primo semestre/Database/Esame/Progetto/Data import/Richiesta ridotto.txt");
	if (in.is_open())
	{
		for (int i = 0; i < 3000; i++)
		{
			getline(in, line);
			c_tab = 0;
			if (i < 1000 || i>1999)
			{
				for (int j = 0; j < line.length(); j++)
				{
					if (line[j] == '\t')
					{
						c_tab++;
						if (c_tab == 1 || c_tab == 11)
						{
							outline += ',';
							outline += '"';
						}
						else
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
							}
						}

					}
					else
					{
						outline += line[j];
					}
				}
			}
			else
			{
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
							outline += '"';
							outline += ',';
							outline += '"';
						}

					}
					else
					{
						outline += line[j];
					}
				}
			}
			outline += '"';
			out << "insert into richiesta (data_ricezione,tipo_cliente,nome,cognome,codice_fiscale,indirizzo_residenza,comune,provincia,regione_sede,provincia_sede,comune_sede,servizio_richiesto) values(" << outline << ");" << endl;
			outline = "";
		}
	}
}