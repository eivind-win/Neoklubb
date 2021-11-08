CREATE DATABASE NeoKlubb;
CREATE TABLE IF NOT EXISTS Medlem(
  MedlemID int NOT NULL AUTO_INCREMENT,
  Fornavn varchar(99) NOT NULL,
  Etternavn varchar(99) NOT NULL,
  Telefon int NOT NULL,
  Epost varchar(99) NOT NULL,
  Fodselsdato date NOT NULL,
  Kjonn varchar(99) NOT NULL,
  RegistreringsDato TIMESTAMP NOT NULL,
  Passord varchar(255) NOT NULL,
  PRIMARY KEY (MedlemID)
);
CREATE TABLE IF NOT EXISTS Kontigent(
  KontigentsStatus varchar(99) NOT NULL,
  MedlemID int,
  FOREIGN KEY (MedlemID) REFERENCES Medlem(MedlemID)
);
CREATE TABLE IF NOT EXISTS Interesser(
  InteresseID int NOT NULL AUTO_INCREMENT,
  Interesser varchar(99) NOT NULL,
  PRIMARY KEY (InteresseID)
);
CREATE TABLE IF NOT EXISTS MineInteresser(
  MedlemID int NOT NULL,
  InteresseID int NOT NULL,
  FOREIGN KEY (MEDLEMID) REFERENCES Medlem(MedlemID),
  FOREIGN KEY (InteresseID) REFERENCES Interesser(InteresseID)
);

CREATE TABLE IF NOT EXISTS Roller(
  RolleID int NOT NULL AUTO_INCREMENT,
  Rolle varchar(99) NOT NULL,
  PRIMARY KEY (RolleID)
);

CREATE TABLE IF NOT EXISTS MineRoller(
MedlemID int NOT NULL,
RolleID int NOT NULL,
  FOREIGN KEY (MEDLEMID) REFERENCES Medlem(MedlemID),
  FOREIGN KEY (RolleID) REFERENCES Roller(RolleID)

);

CREATE TABLE IF NOT EXISTS Adresse(
  AdresseID int NOT NULL AUTO_INCREMENT,
  Gateadresse varchar(99) NOT NULL,
  Postnummer int NOT NULL,
  Poststed varchar(99) NOT NULL,
  MedlemID int,
  PRIMARY KEY (AdresseID),
  FOREIGN KEY (MedlemID) REFERENCES Medlem(MedlemID)
);
CREATE TABLE IF NOT EXISTS Aktivitet(
  AktivitetID int NOT NULL AUTO_INCREMENT,
  Aktivitet varchar(99) NOT NULL,
  Beskrivelse varchar(255) NOT NULL,
  StartDato DATE NOT NULL,
  SluttDato DATE NOT NULL,
  PRIMARY KEY (AktivitetID)
);
CREATE TABLE IF NOT EXISTS Kurs(
  MedlemID int,
  AktivitetID int,
  FOREIGN KEY (MedlemID) REFERENCES Medlem(MedlemID),
  FOREIGN KEY (AktivitetID) REFERENCES Aktivitet(AktivitetID)
);
CREATE TABLE IF NOT EXISTS Status(
  Status varchar(99) NOT NULL,
  MedlemID int,
  FOREIGN KEY (MedlemID) REFERENCES Medlem(MedlemID)
);