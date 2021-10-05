

CREATE DATABASE NeoKlubb;
CREATE TABLE IF NOT EXISTS Medlem(
MedlemID int NOT NULL AUTO_INCREMENT,
Fornavn varchar(99) NOT NULL,
Etternavn varchar(99) NOT NULL,
MobilNummer int NOT NULL,
Epost varchar(99) NOT NULL,
Fodselsdato date NOT NULL,
Kjonn varchar(99) NOT NULL,
RegistreringsDato TIMESTAMP NOT NULL,
PRIMARY KEY (MedlemID));

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
    AktivitetID int NOT NULL AUTO_INCREMENT,
    Aktivitet varchar(99) NOT NULL,
    Beskrivelse varchar(255) NOT NULL,
    StartDato DATE,
    SluttDato DATE,
    PRIMARY KEY (AktivitetID)
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