CREATE DATABASE dbcinemas;

USE dbcinemas;

CREATE TABLE genre(
  id_genre INT AUTO_INCREMENT,
  description VARCHAR (300),
  id INT NOT NULL, /*id_movie*/

  CONSTRAINT pk_id_genre PRIMARY KEY (id_genre)
);

CREATE TABLE movies(
  id INT AUTO_INCREMENT,
  popularity INT,
  vote_count INT,
  video BIT,
  poster_path VARCHAR(100),
  adult BIT,
  backdrop_path VARCHAR(100),
  original_language VARCHAR(30),
  original_title VARCHAR(100),
  genre_ids VARCHAR(50),
  title VARCHAR(100),
  vote_average INT,
  overview VARCHAR(300),
  release_data DATE,

  CONSTRAINT pk_id_movie PRIMARY KEY (id)
);

/*funcion de teatro*/
CREATE TABLE performance(
  id_performance INT AUTO_INCREMENT,
  dia DATE,
  hora VARCHAR(30),

  CONSTRAINT pk_id_performance PRIMARY KEY (id_performance)
);

CREATE TABLE cinemas(
  id_cinema INT AUTO_INCREMENT,
  capacity INT,
  address VARCHAR(50),
  name VARCHAR(50),
  entry_value INT, /*valor de la entrada*/

  CONSTRAINT pk_id_cinema PRIMARY KEY (id_cinema)
);

/*entradas*/
CREATE TABLE tickets(
  id_ticket INT AUTO_INCREMENT,
  entry_number INT,  /*numero de entrada*/
  qr BIT,

  CONSTRAINT pk_id_ticket PRIMARY KEY (id_ticket)
);

/*compra*/
CREATE TABLE purchase(
  id_purchase INT AUTO_INCREMENT,
  number_ticket INT, /*cantidad de entradas*/
  discount INT, /*descuento*/
  date_purchase DATE, /*fecha compra*/
  total INT,

  CONSTRAINT id_purchase PRIMARY KEY (id_purchase)
);
