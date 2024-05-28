/*CRIAÇÃO DA BASE DE DADOS*/

CREATE DATABASE dbOutdoor;
USE dbOutdoor;

/*CRIAÇÃO DA TABELAS E AS RELAÇÕES*/

CREATE TABLE provincias(
idProvincia int primary key auto_increment,
nomeProv VARCHAR(20)
);

CREATE TABLE municipios(
idMunicipio int primary key auto_increment,
nomeMun VARCHAR(20),
fk_provincia int,
FOREIGN KEY (fk_provincia) REFERENCES provincias(idProvincia)
);


CREATE TABLE comunas(
idComuna int primary key auto_increment,
nomeCom VARCHAR(20),
fk_municipio int,
FOREIGN KEY (fk_municipio) REFERENCES municipios(idMunicipio)
);

CREATE TABLE paises (
idPaises int primary key auto_increment,
nomePaises VARCHAR (20)
);

CREATE TABLE  usuarios (
idUsuario int primary key auto_increment,
tipo ENUM ('cliente','admin','gestor'),
username VARCHAR (40) not null UNIQUE,
passe VARCHAR (255) not null,
estado ENUM('ativo', 'inativo'),
email VARCHAR(45) UNIQUE
); 

/*ALTER TABLE usuarios ADD email VARCHAR(45) UNIQUE;
ALTER TABLE usuario  ADD estado ENUM('ativo', 'inativo');*/

/* INSERÇÃO DO ADMINISTRADOR DA PÁGINA*/
INSERT INTO usuarios (tipo, username, passe, estado) VALUES ('admin', 'admin','madrid','ativo');
UPDATE usuarios SET email = 'candidojoao12@gmail.com' WHERE username = 'admin';

CREATE TABLE clientes(
idCliente int primary key auto_increment,
nome VARCHAR (45) not null, 
tipo ENUM ('particular', 'empresa') not null,
atividade VARCHAR (45),
provincia VARCHAR(20) not null,
municipio VARCHAR(20) not null,
comuna VARCHAR(20), 
nacionalidade int,
FOREIGN KEY (nacionalidade) REFERENCES paises(idPaises),
morada VARCHAR(255) not null,
email VARCHAR (45) not null UNIQUE,
telefone VARCHAR (12) not null,
username VARCHAR (40) not null UNIQUE,
passe VARCHAR(255) not null,
estado ENUM ('ativo','inativo'),
fk_usuarioC int,
FOREIGN KEY (fk_usuarioC) REFERENCES usuarios(idUsuario) 
); 	
	
CREATE TABLE gestores(
idGestor int primary key auto_increment,
nome VARCHAR (45) not null, 
provincia VARCHAR(20) not null,
municipio VARCHAR(20) not null,
comuna VARCHAR(20), 
morada VARCHAR(255) not null,
email VARCHAR (45) not null UNIQUE,
telefone VARCHAR (12) not null,
username VARCHAR (40) not null UNIQUE,
passe VARCHAR(255) not null,
estado ENUM ('ativo','inativo'),
fk_usuarioG int,
FOREIGN KEY (fk_usuarioG) REFERENCES usuarios(idUsuario) ,
contSolic int
); 	

SELECT a.dataI, a.dataF, a.pagamento,
(SELECT g.nome FROM gestores g WHERE g.idGestor = a.fk_gestor) AS nome_gestor,
(SELECT o.tipo FROM outdoors o WHERE o.idOutdoor = a.fk_outdoor) AS tipo,
(SELECT o.provincia FROM outdoors o WHERE o.idOutdoor = a.fk_outdoor) AS provincia,
(SELECT o.municipio FROM outdoors o WHERE o.idOutdoor = a.fk_outdoor) AS municipio,
(SELECT o.comuna FROM outdoors o WHERE o.idOutdoor = a.fk_outdoor) AS comuna
FROM alugueres a
WHERE a.fk_cliente = 2;



SELECT idUsuario FROM usuarios WHERE tipo='gestor' ORDER BY idUsuario DESC LIMIT 1;
SELECT estado FROM gestores WHERE fk_usuarioG = 4 and estado = 'inativo';

CREATE TABLE outdoors(
idOutdoor int primary key auto_increment,
tipo ENUM ('Painel Luminoso', 'Painel Não Luminoso','Faixadas','Placas Indicativas','Lampoles') not null,
provincia VARCHAR(20) not null,
municipio VARCHAR(20) not null,
comuna VARCHAR(20), 
preco FLOAT not null,
estado ENUM ('disponivel','aguardando','validando','ocupado')
); 	


CREATE TABLE pedidos(
idPedidos int primary key auto_increment,
dataI date not null,
dataF date not null,
pagamento float not null, 
fk_outdoor int, 
FOREIGN KEY (fk_outdoor) REFERENCES outdoors(idOutdoor),
fk_cliente int, 
FOREIGN KEY (fk_cliente) REFERENCES clientes(idCliente),
fk_gestor int,
FOREIGN KEY (fk_gestor) REFERENCES gestores(idGestor),
numeroPedidos int DEFAULT 0,
imagem VARCHAR(255),
comprovativo VARCHAR(255)
);

SELECT MAX(numeroPedidos) numpedidos FROM pedidos WHERE fk_cliente = 2;

CREATE TABLE aluguer(
fk_cliente int,
numeroPedidos int,
FOREIGN KEY (fk_cliente) REFERENCES clientes(idCliente),
PRIMARY KEY (fk_cliente, numeroPedidos)
);


/*INSERÇÃO DAS PROVÍNCIAS, MUNÍCIPIOS E COMUNAS*/
INSERT INTO provincias (nomeProv) VALUES
('Bengo'),
('Benguela'),
('Bié'),
('Cabinda'),
('Cuando Cubango'),
('Cuanza Norte'),
('Cuanza Sul'),
('Cunene'),
('Huambo'),
('Huíla'),
('Luanda'),
('Lunda Norte'),
('Lunda Sul'),
('Malanje'),
('Moxico'),
('Namibe'),
('Uíge'),
('Zaire');

-- Municípios da província do Bengo
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Ambriz', 1),
('Bula Atumba', 1),
('Dande', 1),
('Demba Chio', 1),
('Nambuangongo', 1),
('Pango Aluquém', 1),
('Quibaxe', 1),
('Quicama', 1),
('Caxito', 1);

-- Municípios da província de Benguela
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Baía Farta', 2),
('Balombo', 2),
('Benguela', 2),
('Bocoio', 2),
('Caimbambo', 2),
('Catumbela', 2),
('Chongoroi', 2),
('Cubal', 2),
('Ganda', 2),
('Lobito', 2);

-- Municípios da província do Bié
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Andulo', 3),
('Camacupa', 3),
('Catabola', 3),
('Chinguar', 3),
('Chitembo', 3),
('Cuemba', 3),
('Cunhinga', 3),
('Cuito', 3),
('Cunje', 3),
('Nharea', 3);

-- Municípios da província de Cabinda
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Belize', 4),
('Buco-Zau', 4),
('Cabinda', 4),
('Cacongo', 4),
('Caio Litoral', 4),
('Necuto', 4),
('Landana', 4),
('Talatona', 4),
('Lândana', 4),
('Miconje', 4);

-- Municípios da província do Cuando Cubango
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Calai', 5),
('Cuangar', 5),
('Cuchi', 5),
('Cuito Cuanavale', 5),
('Dirico', 5),
('Longa', 5),
('Mavinga', 5),
('Menongue', 5),
('Nancova', 5),
('Rivungo', 5);

-- Municípios da província do Cuanza Norte
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Ambaca', 6),
('Banga', 6),
('Bolongongo', 6),
('Cambambe', 6),
('Dondo', 6),
('Golungo Alto', 6),
('Lucala', 6),
('Quiculungo', 6),
('Samba Caju', 6),
('Uíge', 6);

-- Municípios da província do Cuanza Sul
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Amboim', 7),
('Cassongue', 7),
('Cela', 7),
('Conda', 7),
('Ebo', 7),
('Libolo', 7),
('Mussende', 7),
('Porto Amboim', 7),
('Quibala', 7),
('Sumbe', 7);

-- Municípios da província do Cunene
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Cahama', 8),
('Cuanhama', 8),
('Curoca', 8),
('Cuvelai', 8),
('Namacunde', 8),
('Ombadja', 8),
('Ondjiva', 8),
('Otchinjau', 8),
('Xangongo', 8),
('Chitado', 8);

-- Municípios da província do Huambo
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Bailundo', 9),
('Caála', 9),
('Catchiungo', 9),
('Chicala-Cholohanga', 9),
('Chinjenje', 9),
('Huambo', 9),
('Londuimbali', 9),
('Longonjo', 9),
('Mungo', 9),
('Tchicala-Tcholohanga', 9);

-- Municípios da província da Huíla
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Caconda', 10),
('Cacula', 10),
('Caluquembe', 10),
('Chiange', 10),
('Chibia', 10),
('Chicomba', 10),
('Chipindo', 10),
('Humpata', 10),
('Jamba', 10),
('Lubango', 10);

-- Municípios da província de Luanda
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Belas', 11),
('Cacuaco', 11),
('Cazenga', 11),
('Icolo e Bengo', 11),
('Luanda', 11),
('Quiçama', 11),
('Quilamba Quiaxi', 11),
('Quissama', 11),
('Talatona', 11),
('Viana', 11);

-- Municípios da província da Lunda Norte
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Cambulo', 12),
('Capenda Camulemba', 12),
('Caungula', 12),
('Chitato', 12),
('Cuango', 12),
('Cuílo', 12),
('Lucapa', 12),
('Xá-Muteba', 12),
('Lóvua', 12),
('Lubalo', 12);

-- Municípios da província da Lunda Sul
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Cacolo', 13),
('Dala', 13),
('Muconda', 13),
('Saurimo', 13),
('Cacungula', 13),
('Cateco-Cangola', 13),
('Lumege-Cameia', 13),
('Cambulo', 13),
('Luachimo', 13),
('Luó', 13);

-- Municípios da província de Malanje
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Cacuso', 14),
('Calandula', 14),
('Cambundi-Catembo', 14),
('Cangandala', 14),
('Caombo', 14),
('Cuaba Nzogo', 14),
('Cuando', 14),
('Kahombo', 14),
('Malanje', 14),
('Massango', 14);

-- Municípios da província do Moxico
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Alto Zambeze', 15),
('Bundas', 15),
('Camanongue', 15),
('Léua', 15),
('Luacano', 15),
('Luau', 15),
('Luchazes', 15),
('Lunda', 15),
('Moxico', 15),
('Luena', 15);

-- Municípios da província do Namibe
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Bibala', 16),
('Camucuio', 16),
('Moçâmedes', 16),
('Tômbwa', 16),
('Virei', 16),
('Vire', 16),
('Praia Amélia', 16),
('Praia do Tômbua', 16),
('Praia do Saco', 16),
('Praia do Curoca', 16);

-- Municípios da província do Uíge
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Ambuila', 17),
('Bembe', 17),
('Buengas', 17),
('Bungo', 17),
('Damba', 17),
('Milunga', 17),
('Mucaba', 17),
('Negage', 17),
('Puri', 17),
('Uíge', 17);

-- Municípios da província do Zaire
INSERT INTO municipios (nomeMun, fk_provincia) VALUES
('Cuimba', 18),
('Mbanza Congo', 18),
('Noqui', 18),
('Nzeto', 18),
('Soyo', 18),
('Tomboco', 18),
('Quiimba', 18),
('Quinzau', 18),
('Mpala', 18),
('Nzeto', 18);

-- Comunas da província do Bengo
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Ambriz', 1),
('Bengo', 1),
('Dange-Quitexe', 1),
('Kicabo', 1),
('Massabi', 1),
('Bula Atumba', 2),
('Caxito', 2),
('Gombe', 2),
('Kissomeira', 2),
('Quibaxe', 2),
('Barra do Dande', 3),
('Kicabo', 3),
('Mabubas', 3),
('Muxaluando', 3),
('Quixico', 3);

-- Comunas da província de Benguela
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Baía Farta', 4),
('Benguela', 4),
('Caimbambo', 4),
('Catumbela', 4),
('Ganda', 4),
('Balombo', 5),
('Baúnde', 5),
('Bocoio', 5),
('Cunhinga', 5),
('Maca', 5),
('Benguela', 6),
('Caála', 6),
('Calohanga', 6),
('Cavaco', 6),
('Chingongo', 6);

-- Comunas da província do Bié
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Andulo', 7),
('Camacupa', 7),
('Catabola', 7),
('Chinguar', 7),
('Chitembo', 7),
('Cuemba', 7),
('Cunhinga', 7),
('Cuito', 7),
('Cunje', 7),
('Nharea', 7),
('Calucinga', 8),
('Cangandala', 8),
('Cunhinga', 8),
('Cunje', 8),
('Gamba', 8);

-- Comunas da província de Cabinda
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Belize', 9),
('Buco-Zau', 9),
('Cabinda', 9),
('Cacongo', 9),
('Caio Litoral', 9),
('Necuto', 9),
('Landana', 9),
('Talatona', 9),
('Lândana', 9),
('Miconje', 9),
('Beira-Alta', 10),
('Miconje', 10),
('Necuto', 10),
('Caio Litoral', 10),
('Buco-Zau', 10);

-- Comunas da província do Cuando Cubango
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Calai', 11),
('Cuangar', 11),
('Cuchi', 11),
('Cuito Cuanavale', 11),
('Dirico', 11),
('Longa', 11),
('Mavinga', 11),
('Menongue', 11),
('Nancova', 11),
('Rivungo', 11),
('Alto Chicapa', 12),
('Caiundo', 12),
('Cuito Cuanavale', 12),
('Cunjamba', 12),
('Cutato', 12);

-- Comunas da província do Cuanza Norte
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Ambaca', 13),
('Banga', 13),
('Bolongongo', 13),
('Cambambe', 13),
('Dondo', 13),
('Golungo Alto', 13),
('Lucala', 13),
('Quiculungo', 13),
('Samba Caju', 13),
('Uíge', 13),
('Camame', 14),
('Kiwaba Nzoji', 14),
('Maquela do Zombo', 14),
('Negage', 14),
('Puri', 14);

-- Comunas da província do Cuanza Sul
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Amboim', 15),
('Cassongue', 15),
('Cela', 15),
('Conda', 15),
('Ebo', 15),
('Libolo', 15),
('Mussende', 15),
('Porto Amboim', 15),
('Quibala', 15),
('Sumbe', 15),
('Babaera', 16),
('Cacongo', 16),
('Dumbi', 16),
('Ebo', 16),
('Hembe', 16);

-- Comunas da província do Cunene
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Cahama', 17),
('Cuanhama', 17),
('Curoca', 17),
('Cuvelai', 17),
('Namacunde', 17),
('Ombadja', 17),
('Ondjiva', 17),
('Otchinjau', 17),
('Xangongo', 17),
('Chitado', 17),
('Chiedi', 18),
('Cuaname', 18),
('Cuangar', 18),
('Jamba Cueio', 18),
('Luvuei', 18);

-- Comunas da província do Huambo
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Bailundo', 19),
('Caála', 19),
('Catchiungo', 19),
('Chicala-Cholohanga', 19),
('Chinjenje', 19),
('Huambo', 19),
('Londuimbali', 19),
('Longonjo', 19),
('Mungo', 19),
('Tchicala-Tcholohanga', 19),
('Bailundo', 20),
('Chipipa', 20),
('Chiumbo', 20),
('Ecunha', 20),
('Huambo', 20);

-- Comunas da província da Huíla
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Caconda', 21),
('Cacula', 21),
('Caluquembe', 21),
('Chiange', 21),
('Chibia', 21),
('Chicomba', 21),
('Chipindo', 21),
('Humpata', 21),
('Jamba', 21),
('Lubango', 21),
('Caluquembe', 22),
('Cuvango', 22),
('Humpata', 22),
('Jamba', 22),
('Chipindo', 22);

-- Comunas da província de Luanda
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Belas', 23),
('Cacuaco', 23),
('Cazenga', 23),
('Icolo e Bengo', 23),
('Luanda', 23),
('Quiçama', 23),
('Quilamba Quiaxi', 23),
('Quissama', 23),
('Talatona', 23),
('Viana', 23),
('Cabiri', 24),
('Calumbo', 24),
('Camama', 24),
('Kicuxi', 24),
('Munenga', 24);

-- Comunas da província da Lunda Norte
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Cambulo', 25),
('Capenda Camulemba', 25),
('Caungula', 25),
('Chitato', 25),
('Cuango', 25),
('Cuílo', 25),
('Lucapa', 25),
('Xá-Muteba', 25),
('Lóvua', 25),
('Lubalo', 25),
('Capenda Camulemba', 26),
('Cassanje', 26),
('Cuango', 26),
('Lucapa', 26),
('Xá-Muteba', 26);

-- Comunas da província da Lunda Sul
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Cacolo', 27),
('Dala', 27),
('Muconda', 27),
('Saurimo', 27),
('Cacungula', 27),
('Cateco-Cangola', 27),
('Lumege-Cameia', 27),
('Cambulo', 27),
('Luachimo', 27),
('Luó', 27),
('Dala', 28),
('Luengue-Luiana', 28),
('Muxeque', 28),
('Nancova', 28),
('Saurimo', 28);

-- Comunas da província de Malanje
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Cacuso', 29),
('Calandula', 29),
('Cambundi-Catembo', 29),
('Cangandala', 29),
('Caombo', 29),
('Cassanje', 29),
('Massango', 29),
('Milando', 29),
('Quimbamba', 29),
('Quiuaba Nzoji', 29),
('Calumbo', 30),
('Catepa', 30),
('Cunda-Dia-Baze', 30),
('Kalandula', 30),
('Malanje', 30);

-- Comunas da província do Moxico
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Alto Zambeze', 31),
('Bundas', 31),
('Camanongue', 31),
('Léua', 31),
('Luacano', 31),
('Luau', 31),
('Luchazes', 31),
('Lunda', 31),
('Moxico', 31),
('Luena', 31),
('Alto Zambeze', 32),
('Bundas', 32),
('Camanongue', 32),
('Léua', 32),
('Luacano', 32);

-- Comunas da província do Namibe
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Bibala', 33),
('Camucuio', 33),
('Moçâmedes', 33),
('Tômbwa', 33),
('Virei', 33),
('Vire', 33),
('Praia Amélia', 33),
('Praia do Tômbua', 33),
('Praia do Saco', 33),
('Praia do Curoca', 33),
('Bentiaba', 34),
('Namibe', 34),
('Saco-Mar', 34),
('Tômbwa', 34),
('Virei', 34);

-- Comunas da província do Uíge
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Ambuila', 35),
('Bembe', 35),
('Buengas', 35),
('Bungo', 35),
('Damba', 35),	
('Milunga', 35),
('Mucaba', 35),
('Negage', 35),
('Puri', 35),
('Uíge', 35),
('Alto Cauale', 36),
('Bembe', 36),
('Buengas', 36),
('Bungo', 36),
('Damba', 36);

-- Comunas da província do Zaire
INSERT INTO comunas (nomeCom, fk_municipio) VALUES
('Cuimba', 37),
('M''banza Congo', 37),
('Noqui', 37),
('Nzeto', 37),
('Soyo', 37),
('Tomboco', 37),
('Quiimba', 37),
('Quinzau', 37),
('Mpala', 37),
('N''zeto', 37),
('Buela', 38),
('Cuimba', 38),
('M''banza Congo', 38),
('Noqui', 38),
('Santo António do Zaire', 38);

-- Países da África
INSERT INTO paises (nomePaises) VALUES
('África do Sul'),
('Angola'),
('Argélia'),
('Benin'),
('Botswana'),
('Burquina Faso'),
('Burundi'),
('Cabo Verde'),
('Camarões'),
('Chade'),
('Comores'),
('Congo'),
('Costa do Marfim'),
('Djibuti'),
('Egito'),
('Eritreia'),
('Eswatini'),
('Etiópia'),
('Gabão'),
('Gâmbia'),
('Gana'),
('Guiné'),
('Guiné-Bissau'),
('Guiné Equatorial'),
('Lesoto'),
('Libéria'),
('Líbia'),
('Madagáscar'),
('Maláui'),
('Mali'),
('Marrocos'),
('Maurícia'),
('Mauritânia'),
('Moçambique'),
('Namíbia'),
('Níger'),
('Nigéria'),
('Quénia'),
('República Centro-Africana'),
('República Democrática do Congo'),
('Ruanda'),
('São Tomé e Príncipe'),
('Senegal'),
('Seicheles'),
('Serra Leoa'),
('Somália'),
('Sudão'),
('Sudão do Sul'),
('Tanzânia'),
('Togo'),
('Tunísia'),
('Uganda'),
('Zâmbia'),
('Zimbábue');


