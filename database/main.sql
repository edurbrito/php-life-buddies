PRAGMA FOREIGN_KEYS = ON;

CREATE TABLE Login (
    email               VARCHAR(50) NOT NULL,
    password            VARCHAR(50) NOT NULL,

    CONSTRAINT loginPK PRIMARY KEY (email),
    CONSTRAINT EmailUNIQUE UNIQUE (email)
);

CREATE TABLE Costumer(
    email               VARCHAR(50) NOT NULL,
    name                VARCHAR(50) NOT NULL,
    phone_number        INTEGER NOT NULL,

    CONSTRAINT CostumerPK PRIMARY KEY (email),
    CONSTRAINT CostumerEmail FOREIGN KEY (email) REFERENCES Login ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT PhoneNumberUNIQUE UNIQUE (phone_number)
);

CREATE TABLE Shelter(
    email               VARCHAR(50) NOT NULL,
    name                VARCHAR(50) NOT NULL,
    phone_number        INTEGER NOT NULL,
    location            INTEGER NOT NULL,
    rescued_pets        INTEGER NOT NULL,

    CONSTRAINT CostumerPK PRIMARY KEY (email),
    CONSTRAINT CostumerEmailFK FOREIGN KEY (email) REFERENCES Login ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT ShelterLocationFK FOREIGN KEY (location) REFERENCES Location ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT ShelterRescuedPetsFK FOREIGN KEY (rescued_pets) REFERENCES RescuedPets ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT PhoneNumberUNIQUE UNIQUE (phone_number)
);

CREATE TABLE AdoptionProposal(
    email               VARCHAR(50) NOT NULL,
    pet_id              INTEGER NOT NULL,

    CONSTRAINT AdoptionProposalPK PRIMARY KEY (email),
    CONSTRAINT AdoptionProposalEmailFK FOREIGN KEY (email) REFERENCES Login ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT PetFK FOREIGN KEY (pet_id) REFERENCES Pet ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Question(
    email               VARCHAR(50) NOT NULL,
    pet_id              INTEGER NOT NULL,
    question_text       VARCHAR(100) NOT NULL,

    CONSTRAINT AdoptionProposalPK PRIMARY KEY (email),
    CONSTRAINT AdoptionProposalEmail FOREIGN KEY (email) REFERENCES Login ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT PetFK FOREIGN KEY (pet_id) REFERENCES Pet ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Favorite(
    email               VARCHAR(50) NOT NULL,
    pet_id              INTEGER NOT NULL,

    CONSTRAINT AdoptionProposalPK PRIMARY KEY (email),
    CONSTRAINT AdoptionProposalEmailFK FOREIGN KEY (email) REFERENCES Login ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Location(
    id                  INTEGER,
    country             VARCHAR(30) NOT NULL,
    city                VARCHAR(30) NOT NULL,
    zipCode             INTEGER NOT NULL,

    CONSTRAINT LocationPK PRIMARY KEY (id)
);

CREATE TABLE Pet(
    id                  INTEGER,
    name                VARCHAR(30) DEFAULT 'To be attributed',
    species             VARCHAR(30),
    age                 INTEGER NOT NULL,
    color               VARCHAR(30) NOT NULL,
    location            INTEGER NOT NULL,
    rescued_pets_id     INTEGER NOT NULL,

    CONSTRAINT PetPK PRIMARY KEY (id),
    CONSTRAINT PetLocationFK FOREIGN KEY (location) REFERENCES Location ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Photo(
    pet_id              INTEGER,
    date                DATE NOT NULL,
    Photo               BLOB,

    CONSTRAINT PhotoPK PRIMARY KEY (pet_id),
    CONSTRAINT PhotoPetFK FOREIGN KEY (pet_id) REFERENCES Pet ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE RescuedPets(
    id                  INTEGER,
    shelter_id          DATE NOT NULL,

    CONSTRAINT RescuedPetsPK PRIMARY KEY (id),
    CONSTRAINT ShelterFK FOREIGN KEY (shelter_id) REFERENCES Shelter ON DELETE RESTRICT ON UPDATE CASCADE
);

INSERT INTO Login VALUES ('pdff2000@gmail.com','1234');