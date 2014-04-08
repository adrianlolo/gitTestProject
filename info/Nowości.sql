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

CREATE TABLE Bakterie (
  ID INTEGER DEFAULT 0 NOT NULL CONSTRAINT BakterieID PRIMARY KEY,
  Symbol VARCHAR(20) NOT NULL COLLATE PXW_PLK,
  Nazwa VARCHAR(500) NOT NULL COLLATE PXW_PLK,
  Poziom INTEGER,
  MoznaWybrac SMALLINT DEFAULT 0,
  CONSTRAINT BakterieSymbolUnique UNIQUE (Symbol)
);

CREATE TABLE KodyRozpoznan (
  ID INTEGER DEFAULT 0 NOT NULL CONSTRAINT KodyRozpoznanID PRIMARY KEY,
  Symbol VARCHAR(20) NOT NULL COLLATE PXW_PLK,
  Nazwa VARCHAR(500) NOT NULL COLLATE PXW_PLK,
  Poziom INTEGER,
  MoznaWybrac SMALLINT DEFAULT 0,
  CONSTRAINT KodyRozpoznanSymbolUnique UNIQUE (Symbol)
);

CREATE TABLE KodyProcedur (
  ID INTEGER DEFAULT 0 NOT NULL CONSTRAINT KodyProcedurID PRIMARY KEY,
  Symbol VARCHAR(20) NOT NULL COLLATE PXW_PLK,
  Nazwa VARCHAR(500) NOT NULL COLLATE PXW_PLK,
  Poziom INTEGER,
  MoznaWybrac SMALLINT DEFAULT 0,
  CONSTRAINT KodyProcedurSymbolUnique UNIQUE (Symbol)
);