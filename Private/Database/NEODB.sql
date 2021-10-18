CREATE DATABASE NeoKlubb;
CREATE TABLE IF NOT EXISTS Medlem(
<<<<<<< HEAD
MedlemID int NOT NULL AUTO_INCREMENT,
Fornavn varchar(99) NOT NULL,
Etternavn varchar(99) NOT NULL,
Telefon int NOT NULL,
Epost varchar(99) NOT NULL,
Fodselsdato date NOT NULL,
Kjonn varchar(99) NOT NULL,
RegistreringsDato TIMESTAMP NOT NULL,
Passord varchar(255) NOT NULL,
PRIMARY KEY (MedlemID));

=======
  MedlemID int NOT NULL AUTO_INCREMENT,
  Fornavn varchar(99) NOT NULL,
  Etternavn varchar(99) NOT NULL,
  MobilNummer int NOT NULL,
  Epost varchar(99) NOT NULL,
  Fodselsdato date NOT NULL,
  Kjonn varchar(99) NOT NULL,
  RegistreringsDato TIMESTAMP NOT NULL,
  Passord varchar(255) NOT NULL,
  PRIMARY KEY (MedlemID)
);
>>>>>>> 48e1ec2a3da811d1ddf6d457747ffc3dc79177d9
CREATE TABLE IF NOT EXISTS Kontigent(
  KontigentID int NOT NULL AUTO_INCREMENT,
  KontigentsStatus varchar(99) NOT NULL,
  MedlemID int,
  PRIMARY KEY (KontigentID),
  FOREIGN KEY (MedlemID) REFERENCES Medlem(MedlemID)
);
CREATE TABLE IF NOT EXISTS Interesser(
  InteresseID int NOT NULL AUTO_INCREMENT,
  Interesser varchar(99) NOT NULL,
  MedlemID int,
  PRIMARY KEY (InteresseID),
  FOREIGN KEY (MedlemID) REFERENCES Medlem(MedlemID)
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
<<<<<<< HEAD
    AktivitetID int NOT NULL AUTO_INCREMENT,
    Aktivitet varchar(99) NOT NULL,
    Beskrivelse varchar(255) NOT NULL,
    StartDato DATETIME NOT NULL,
    SluttDato DATETIME NOT NULL,
    PRIMARY KEY (AktivitetID)
=======
  AktivitetID int NOT NULL AUTO_INCREMENT,
  Aktivitet varchar(99) NOT NULL,
  Beskrivelse varchar(255) NOT NULL,
  StartDato DATE NOT NULL,
  SluttDato DATE NOT NULL,
  PRIMARY KEY (AktivitetID)
>>>>>>> 48e1ec2a3da811d1ddf6d457747ffc3dc79177d9
);
CREATE TABLE IF NOT EXISTS Kurs(
  MedlemID int,
  AktivitetID int,
  FOREIGN KEY (MedlemID) REFERENCES Medlem(MedlemID),
  FOREIGN KEY (AktivitetID) REFERENCES Aktivitet(AktivitetID)
);
CREATE TABLE IF NOT EXISTS Roller(
  RolleID int NOT NULL AUTO_INCREMENT,
  RolleNavn varchar(99) NOT NULL,
  MedlemID int,
  PRIMARY KEY (RolleID),
  FOREIGN KEY (MedlemID) REFERENCES Medlem(MedlemID)
);
CREATE TABLE IF NOT EXISTS Status(
  StatusID int NOT NULL AUTO_INCREMENT,
  Status varchar(99) NOT NULL,
  MedlemID int,
  PRIMARY KEY (StatusID),
  FOREIGN KEY (MedlemID) REFERENCES Medlem(MedlemID)
);