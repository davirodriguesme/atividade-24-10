create database db_industria
use db_industria


CREATE TABLE pecas
 (
  pec_numero int primary key auto_increment not null,
  pec_cor varchar(45),
  pec_peso int
  );
  
 CREATE TABLE depositos
 (
  dep_numero int primary key auto_increment not null,
  dep_endereço varchar(45),
  fk_pec_numero int,
  FOREIGN KEY (fk_pec_numero) REFERENCES pecas(pec_numero)
  );
  
 CREATE TABLE itens
 (
  ite_numero int primary key auto_increment not null,
  ite_dia date,
  ite_inicio int
  );
  
  CREATE TABLE departamento
 (
  der_numero int primary key auto_increment not null,
  setor varchar(3),
  fk_fun_numero int,
  FOREIGN KEY (fk_fun_numero) REFERENCES funcionarios(fun_numero)
  );
  
  CREATE TABLE funcionarios
 (
 fun_numero int primary key auto_increment not null,
 fun_salario float,
 fun_telefone varchar(20),
 fk_for_numero int,
 FOREIGN KEY (fk_for_numero) REFERENCES fornecedor(for_numero)
 );
 
 CREATE TABLE fornecedor
 (
 for_numero int primary key auto_increment not null,
 for_endereco varchar(45)
 );
 
 CREATE TABLE projeto
 (
 pro_numero int primary key auto_increment not null,
 pro_orçameto float,
 fk_for_numero int,
 fk_pec_numero int,
 fk_fun_numero int,
 fk_ite_numero int,
 FOREIGN KEY (fk_ite_numero) REFERENCES itens(ite_numero),
 FOREIGN KEY (fk_for_numero) REFERENCES fornecedor(for_numero),
 FOREIGN KEY (fk_fun_numero) REFERENCES funcionarios(fun_numero),
 FOREIGN KEY (fk_pec_numero) REFERENCES pecas(pec_numero)
 );
 
 
INSERT INTO pecas (pec_cor, pec_peso)
VALUES 
('Vermelho', 150),
('Azul', 200),
('Verde', 250);

INSERT INTO fornecedor (for_endereco)
VALUES 
('Rua A, 123'),
('Rua B, 456'),
('Rua C, 789');

INSERT INTO funcionarios (fun_salario, fun_telefone, fk_for_numero)
VALUES 
(3000.00, '1111-1111', 1),
(3500.00, '2222-2222', 2),
(4000.00, '3333-3333', 3);

INSERT INTO depositos (dep_endereço, fk_pec_numero)
VALUES 
('Rua X, 100', 1),
('Rua Y, 200', 2),
('Rua Z, 300', 3);

INSERT INTO itens (ite_dia, ite_inicio)
VALUES 
('2024-10-22', 8),
('2024-10-23', 9),
('2024-10-24', 10);

INSERT INTO departamento (setor, fk_fun_numero)
VALUES 
('IT', 1),
('HR', 2),
('ENG', 3);

INSERT INTO projeto (pro_orçameto, fk_for_numero, fk_pec_numero, fk_fun_numero, fk_ite_numero)
VALUES 
(10000.00, 1, 1, 1, 1),
(20000.00, 2, 2, 2, 2),
(30000.00, 3, 3, 3, 3);


alter table funcionarios 
add fun_nome varchar(60)

select *
from funcionarios
 
 