CREATE DATABASE 'localhost:c:\\xampp\\db\\icd-10.fdb' user 'sysdba' password 'masterkey' DEFAULT CHARACTER SET WIN1250; 

CREATE TABLE KodyRozpoznan (
  ID INTEGER DEFAULT 0 NOT NULL CONSTRAINT KodyRozpoznanID PRIMARY KEY,
  Symbol VARCHAR(20) NOT NULL COLLATE PXW_PLK,
  Nazwa VARCHAR(500) NOT NULL COLLATE PXW_PLK,
  Poziom INTEGER,
  MoznaWybrac SMALLINT DEFAULT 0,
  CONSTRAINT KodyRozpoznanSymbolUnique UNIQUE (Symbol)
);

CREATE GENERATOR GenSlowniki;

