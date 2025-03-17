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
    nome = nome.lower()
    return "valor" if nome == "valor_pago" else nome

def detectar_delimitador(arquivo, encoding):
    with open(arquivo, 'r', encoding=encoding, errors='replace') as f:
        sniffer = csv.Sniffer()
        primeira_linha = f.readline()
        return sniffer.sniff(primeira_linha).delimiter

def csv_para_sqlite_filtrado(csv_arquivo, banco_dados, tabela):
    encoding = detectar_codificacao(csv_arquivo)
    delimitador = detectar_delimitador(csv_arquivo, encoding)
    
    conexao = sqlite3.connect(banco_dados)
    cursor = conexao.cursor()
    
    with open(csv_arquivo, 'r', encoding=encoding, errors='replace') as arquivo:
        leitor = csv.reader(arquivo, delimiter=delimitador)
        colunas = next(leitor)
        colunas_limpas = [limpar_nome_coluna(col) for col in colunas]
        
        # Definir as colunas a serem removidas
        colunas_excluir = {
            "codigo_do_autor_da_emenda", "tipo_de_emenda", "codigo_municipio_ibge", 
            "codigo_uf_ibge", "codigo_funcao", "codigo_subfuncao", "codigo_programa", 
            "codigo_acao", "codigo_plano_orcamento",
            "valor_empenhado", "valor_liquidado", "valor_restos_a_pagar_inscritos", 
            "valor_restos_a_pagar_cancelados", "valor_restos_a_pagar_pagos"
        }
        
        # Índices das colunas a serem mantidas
        colunas_filtradas = [col if col != "valor_pago" else "valor" for col in colunas_limpas if col not in colunas_excluir]
        indices_filtrados = [i for i, col in enumerate(colunas_limpas) if col not in colunas_excluir]
        
        cursor.execute(f"DROP TABLE IF EXISTS {tabela}")
        cursor.execute(f"CREATE TABLE {tabela} ({', '.join([f'[{col}] TEXT' for col in colunas_filtradas])})")
        
        for linha in leitor:
            if len(linha) == len(colunas_limpas):
                dados_filtrados = [linha[i] for i in indices_filtrados]
                
                # Filtrar pelo intervalo de ano_da_emenda
                if "ano_da_emenda" in colunas_filtradas:
                    indice_ano = colunas_filtradas.index("ano_da_emenda")
                    try:
                        ano = int(dados_filtrados[indice_ano])
                        if 2020 <= ano <= 2024:
                            cursor.execute(f"INSERT INTO {tabela} VALUES ({', '.join(['?'] * len(dados_filtrados))})", dados_filtrados)
                    except ValueError:
                        continue  # Ignora valores inválidos para ano_da_emenda
                else:
                    cursor.execute(f"INSERT INTO {tabela} VALUES ({', '.join(['?'] * len(dados_filtrados))})", dados_filtrados)
    
    conexao.commit()
    conexao.close()

# Exemplo de uso
csv_para_sqlite_filtrado('dados.csv', 'dados.db', 'data')
