CREATE TABLE Pracownicy
(
  ID integer not null CONSTRAINT PracownicyID PRIMARY KEY,
  DEL integer default 0 not null,
  DC TIMESTAMP,
  DD TIMESTAMP,
  PC INTEGER,
  PD INTEGER,
  Nazwisko varchar(50) COLLATE PXW_PLK,
  Logowanie varchar(50) COLLATE PXW_PLK,
  Haslo CHAR(60),
  Funkcja INTEGER
);

CREATE TABLE GrupyBakterii
(
  ID integer not null CONSTRAINT GrupyBakteriiID PRIMARY KEY,
  DEL integer default 0 not null,
  DC TIMESTAMP,
  DD TIMESTAMP,
  PC INTEGER,
  PD INTEGER,
  Symbol char(7) COLLATE PXW_PLK,
  Nazwa varchar(50) COLLATE PXW_PLK,
  MechanizmOpornosciowy smallint,
  Opis varchar(500) COLLATE PXW_PLK
);

CREATE TABLE BakterieWGrupach
(
  ID integer not null CONSTRAINT BakterieWGrupachID PRIMARY KEY,
  DEL integer default 0 not null,
  DC TIMESTAMP,
  DD TIMESTAMP,
  PC INTEGER,
  PD INTEGER,
  Bakteria INTEGER NOT NULL CONSTRAINT BakterieWGrupachBakteria REFERENCES UzywaneBakterie (ID),
  Grupa INTEGER NOT NULL CONSTRAINT BakterieWGrupachGrupa REFERENCES GrupyBakterii (ID),
  CONSTRAINT BakterieWGrupachUnique UNIQUE (Bakteria, Grupa, DEL)
);