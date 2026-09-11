DROP DATABASE = apaga 
DROP DATABASE IF EXISTS "nome do banco de dados" = 
CREAT DATABASE= para criar um banco de dados 



CREAÇÃO DE TABELA COMUN :

CREATE TABLE produtos(
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    estoque INTEGER NOT NULL  
);

FILTRO DE COLUNAS 
```sql
SELECT nome,preco FROM PRODUTOS;
```

```SQL
SELECT COUNT(*) FROM produtos; 

```
limitação de produtos:
SELECT * FROM produtos LIMIT 5;

MOSTRA A CATEGORIA DOS PRODUTOS 




SELECT nome,preco FROM produtos WHERE categoria = 'NOME DO PRODUTO'; : Filtro por categotia

SELECT nome,preco FROM produtos WHERE preco <= 500; : Filtro de valores 
                             ^
  SELECT nome,preco FROM produtos WHERE preco >= 500 AND preco <= 1000;




    SELECT nome,preco FROM produtos ORDER BY preco; : orden de preços 

para renomear a tabela:
