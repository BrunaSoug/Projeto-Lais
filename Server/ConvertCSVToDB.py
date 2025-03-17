import sqlite3
import csv
import chardet
import re
import unicodedata

def detectar_codificacao(arquivo):
    with open(arquivo, 'rb') as f:
        return chardet.detect(f.read())['encoding']

def limpar_nome_coluna(nome):
    nome = unicodedata.normalize("NFKD", nome).encode("ASCII", "ignore").decode("ASCII")
    nome = re.sub(r'[^a-zA-Z0-9_]', '_', nome).strip('_')
    return nome.lower()

def detectar_delimitador(arquivo, encoding):
    with open(arquivo, 'r', encoding=encoding, errors='replace') as f:
        sniffer = csv.Sniffer()
        primeira_linha = f.readline()
        return sniffer.sniff(primeira_linha).delimiter

def csv_para_sqlite(csv_arquivo, banco_dados, tabela):
    encoding = detectar_codificacao(csv_arquivo)
    delimitador = detectar_delimitador(csv_arquivo, encoding)
    
    conexao = sqlite3.connect(banco_dados)
    cursor = conexao.cursor()
    
    with open(csv_arquivo, 'r', encoding=encoding, errors='replace') as arquivo:
        leitor = csv.reader(arquivo, delimiter=delimitador)
        colunas = next(leitor)
        colunas = [limpar_nome_coluna(col) for col in colunas]
        
        cursor.execute(f"DROP TABLE IF EXISTS {tabela}")
        cursor.execute(f"CREATE TABLE {tabela} ({', '.join([f'[{col}] TEXT' for col in colunas])})")
        
        for linha in leitor:
            if len(linha) == len(colunas):
                cursor.execute(f"INSERT INTO {tabela} VALUES ({', '.join(['?'] * len(linha))})", linha)
    
    conexao.commit()
    conexao.close()

# Exemplo de uso
csv_para_sqlite('dados.csv', 'dados.db', 'data')
