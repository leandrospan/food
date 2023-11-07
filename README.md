# food
Site institucional de reserva de comidas 
-- BANCO DE DADOS --
CREATE DATABASE banco1;

CREATE TABLE cliente (codcli INT PRIMARY KEY AUTO_INCREMENT, nome VARCHAR(250), email VARCHAR(250), celular VARCHAR(250), quantidade INT, prato VARCHAR(250), endereco VARCHAR(250));
