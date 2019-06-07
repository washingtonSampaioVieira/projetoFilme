CREATE DATABASE bd_locadora_w;

CREATE TABLE tbl_contato(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(100) NOT NULL,
	telefone VARCHAR(20),
	celular VARCHAR(20) NOT NULL, 
	email VARCHAR(200) NOT NULL,
	home_page VARCHAR(100),
	link_facebook VARCHAR(300),
	profissao VARCHAR(100) NOT NULL,
	sexo VARCHAR(1) NOT NULL,
	sugestoes_criticas VARCHAR(500),
	perguntas VARCHAR(500)
);