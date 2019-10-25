CREATE DATABASE dbcinemas;

USE dbcinemas;

CREATE TABLE genres(
  id_genre INT,
  description VARCHAR (300),
  id INT NOT NULL, /*id_movie*/

  CONSTRAINT pk_id_genre PRIMARY KEY (id_genre)
);

CREATE TABLE movies(
  id INT,
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

CREATE TABLE movies_x_genres(
	id_movies_x_genre INT,
  id_movie INT,
  id_genre INT,

  CONSTRAINT pk_id_movies_x_genre PRIMARY KEY (id_movies_x_genre),
  CONSTRAINT fk_id_movie_movie_x_genre FOREIGN KEY (id_movie) REFERENCES movies(id),
  CONSTRAINT fk_id_genre_movie_x_genre FOREIGN KEY (id_genre) REFERENCES genres(id_genre)
);


/*cartelera*/
CREATE TABLE billboard(
  id_billboard INT AUTO_INCREMENT,
  dia DATE,
  hora VARCHAR(30),
  id_movie int,

  CONSTRAINT pk_id_performance PRIMARY KEY (id_billboard),
  constraint fk_id_movie foreign key (id_movie) references movies (id)
);

CREATE TABLE cinemas(
  id_cinema INT AUTO_INCREMENT,
  name VARCHAR(50),
  capacity INT,
  addres VARCHAR(50),
  value INT, /*valor de la entrada*/

  CONSTRAINT pk_id_cinema PRIMARY KEY (id_cinema)
);

/*funcion de cine*/
CREATE TABLE showings(
  id_showing INT AUTO_INCREMENT,
  dia DATE,
  hora VARCHAR(30),
  id_cinema INT,
  id_movie INT,

  CONSTRAINT pk_id_showing PRIMARY KEY (id_showing),
  CONSTRAINT fk_id_performance_cinema FOREIGN KEY (id_cinema) REFERENCES cinemas(id_cinema),
  CONSTRAINT fk_id_performance_movie FOREIGN KEY (id_movie) REFERENCES movies(id_movie)
);

/*compra*/
CREATE TABLE buyouts(
  id_buyout INT AUTO_INCREMENT,
  quan INT, /*cantidad de entradas*/
  disc INT, /*descuento*/
  date_buyout DATE, /*fecha compra*/
  total INT,
  id_user INT,

  CONSTRAINT id_buyout PRIMARY KEY (id_buyout),
  CONSTRAINT id_buyout_user FOREIGN KEY (id_user) REFERENCES users(id_user)
);

/*entradas*/
CREATE TABLE tickets(
  id_ticket INT AUTO_INCREMENT,
  entry_number INT,  /*numero de entrada*/
  qr BIT,
  id_showing INT,
  id_buyout INT,

  CONSTRAINT pk_id_ticket PRIMARY KEY (id_ticket),
  CONSTRAINT fk_id_ticket_showing FOREIGN KEY (id_showing) REFERENCES showings(id_showing),
  CONSTRAINT fk_id_ticket_boyout FOREIGN KEY (id_buyout) REFERENCES bouyouts(id_buyout)
);

CREATE TABLE rols(
  id_rol INT AUTO_INCREMENT,
  description VARCHAR(20),

  CONSTRAINT pk_id_rol PRIMARY KEY (id_rol)
);

CREATE TABLE users(
  id_user INT AUTO_INCREMENT,
  mail VARCHAR(50),
  pass VARCHAR(40),
  name VARCHAR(80),
  lastname VARCHAR(80),
  dni INT,
  id_rol INT,

  CONSTRAINT pk_id_user PRIMARY KEY (id_user),
  CONSTRAINT fk_id_user_rol FOREIGN KEY (id_rol) REFERENCES rols(id_rol),
  CONSTRAINT uniq_dni UNIQUE (dni)
);

CREATE TABLE credit_accounts(
  id_credit_account INT AUTO_INCREMENT,
  business VARCHAR(50),

  CONSTRAINT pk_id_credit_card PRIMARY KEY(id_credit_account)
);

CREATE TABLE pay_credit_cards(
  id_credit_card INT AUTO_INCREMENT,
  code_authorization VARCHAR(100), /*se especifica en las pautas del tp: solicitará la autorización del pago a la corresp*/
  pay_date DATE,
  total_pay_cc INT, /*cc = credit card*/
  id_buyout INT,
  id_credit_account INT,

  CONSTRAINT pk_id_credit_card PRIMARY KEY (id_credit_card),
  CONSTRAINT fk_id_pay_credit_card_buyout FOREIGN KEY (id_buyout) REFERENCES buyouts(id_buyout),
  CONSTRAINT fk_id_pay_credit_card_id_credit_account FOREIGN KEY (id_credit_account) REFERENCES credit_accounts(id_credit_account)
);
