CREATE TABLE IF NOT EXISTS jogos (
    id INT NOT NULL GENERATED ALWAYS AS IDENTITY,
    titulo VARCHAR(150) NOT NULL,
    plataforma VARCHAR(50) NOT NULL,
    genero VARCHAR(80) NOT NULL,
    desenvolvedora VARCHAR(120) NOT NULL,
    ano_lancamento INT NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    estoque INT NOT NULL,
    PRIMARY KEY (id)
);


