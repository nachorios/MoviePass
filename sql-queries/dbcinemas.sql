drop database if exists dbcinemas;
CREATE DATABASE dbcinemas;

USE dbcinemas;

CREATE TABLE genres
(
  id_genre INT,
  description VARCHAR (300),
  /*id INT NOT NULL,*/
  /*id_movie*/
  /*aca no va el id de movie porque lo tiene movies_x_genres ya que es una relacion de n a m*/

  CONSTRAINT pk_id_genre PRIMARY KEY (id_genre)
);

CREATE TABLE movies
(
  id_movie INT,
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
  runtime int,

  CONSTRAINT pk_id_movie PRIMARY KEY (id_movie)
);

CREATE TABLE movies_x_genres
(
  id_movies_x_genre INT,
  id_movie INT,
  id_genre INT,

  CONSTRAINT pk_id_movies_x_genre PRIMARY KEY (id_movies_x_genre),
  CONSTRAINT fk_id_movie_movie_x_genre FOREIGN KEY (id_movie) REFERENCES movies(id_movie),
  CONSTRAINT fk_id_genre_movie_x_genre FOREIGN KEY (id_genre) REFERENCES genres(id_genre)
);


CREATE TABLE cinemas
(
  id_cinema INT
  AUTO_INCREMENT,
  name VARCHAR
  (50),
  address VARCHAR
  (50),

  CONSTRAINT pk_id_cinema PRIMARY KEY
  (id_cinema),
  CONSTRAINT uniq_name UNIQUE
  (name),
  CONSTRAINT uniq_address UNIQUE
  (address)
);

  create table saloon
  (
    id_saloon int
    auto_increment,
    name varchar
    (50),
    capacity INT,
    entry_value INT, /*valor de la entrada*/
    id_cinema INT,

    constraint pk_id_saloon primary key
    (id_saloon),
    constraint fk_id_cinema foreign key
    (id_cinema) references cinemas
    (id_cinema) ON
    DELETE CASCADE
);
    /*cartelera*/
    CREATE TABLE billboard
    (
      id_billboard INT
      AUTO_INCREMENT,
  id_movie int,
  id_cinema int,

  CONSTRAINT pk_id_billboard PRIMARY KEY
      (id_billboard)
  -- CONSTRAINT fk_id_movies foreign key (id_movie) references movies (id_movie),
  -- CONSTRAINT fk_id_cinema foreign key (id_cinema) references cinemas (id_cinema)
);

      create table functions
      (
        id_function int
        auto_increment,
    id_billboard int not null,
    id_saloon int,
    date int,
    duration int,
    capacity int,
    CONSTRAINT pk_id_function PRIMARY KEY
        (id_function),
    CONSTRAINT pk_id_saloon FOREIGN KEY
        (id_saloon) references saloon
        (id_saloon) ON
        DELETE CASCADE,
    CONSTRAINT fk_id_billboard FOREIGN KEY
        (id_billboard) references billboard
        (id_billboard) ON
        DELETE CASCADE
);

        CREATE TABLE rols
        (
          id_rol INT
          AUTO_INCREMENT,
  rolDescription VARCHAR
          (20),
  rol int,

  CONSTRAINT pk_id_rol PRIMARY KEY
          (id_rol)
);

          CREATE TABLE users
          (
            mail VARCHAR(50),
            pass VARCHAR(40),
            name VARCHAR(80),
            lastname VARCHAR(80),
            dni INT,
            id_rol INT,

            CONSTRAINT pk_id_user PRIMARY KEY (mail),
            CONSTRAINT uniq_dni UNIQUE (dni)
          );

          /*compra*/
          CREATE TABLE buyouts
          (
            id_buyout INT
            AUTO_INCREMENT,
  quan INT, /*cantidad de entradas*/
  total INT,
  mail VARCHAR
            (50),
  id_movie int,
  id_cinema INT,
  id_function int,
  date varchar
            (20),
  credit_number bigint,
  

  CONSTRAINT idbuyout PRIMARY KEY
            (id_buyout)
);



            /*entradas*/
            CREATE TABLE tickets
            (
              id_ticket INT
              AUTO_INCREMENT,
  entry_number INT,  /*numero de entrada*/
  qr BIT,
  /*id_showing INT,*/
  id_buyout INT,

  CONSTRAINT pk_id_ticket PRIMARY KEY
              (id_ticket),
  /*CONSTRAINT fk_id_ticket_showing FOREIGN KEY (id_showing) REFERENCES showings(id_showing),*/
  CONSTRAINT fk_id_ticket_boyout FOREIGN KEY
              (id_buyout) REFERENCES buyouts
              (id_buyout)
);

              CREATE TABLE credit_accounts
              (
                id_credit_account INT
                AUTO_INCREMENT,
  business VARCHAR
                (50),

  CONSTRAINT pk_id_credit_card PRIMARY KEY
                (id_credit_account)
);

                CREATE TABLE pay_credit_cards
                (
                  id_credit_card INT
                  AUTO_INCREMENT,
  code_authorization VARCHAR
                  (100), /*se especifica en las pautas del tp: solicitará la autorización del pago a la corresp*/
  pay_date DATE,
  total_pay_cc INT, /*cc = credit card*/
  id_buyout INT,
  id_credit_account INT,

  CONSTRAINT pk_id_credit_card PRIMARY KEY
                  (id_credit_card),
  CONSTRAINT fk_id_pay_credit_card_buyout FOREIGN KEY
                  (id_buyout) REFERENCES buyouts
                  (id_buyout),
  CONSTRAINT fk_id_pay_credit_card_id_credit_account FOREIGN KEY
                  (id_credit_account) REFERENCES credit_accounts
                  (id_credit_account)
);