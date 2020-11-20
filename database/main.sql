PRAGMA FOREIGN_KEYS = ON;

CREATE TABLE Login(
    email               VARCHAR(50) NOT NULL,
    password            VARCHAR(50) NOT NULL,

    CONSTRAINT loginPK PRIMARY KEY (email)
);

CREATE TABLE User(
    email               VARCHAR(50) NOT NULL,
    name                VARCHAR(50) NOT NULL,
    phone_number        INTEGER NOT NULL,

    CONSTRAINT UserPK PRIMARY KEY (email),
    CONSTRAINT UserEmail FOREIGN KEY (email) REFERENCES Login ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT PhoneNumberUNIQUE UNIQUE (phone_number)
);

CREATE TABLE Shelter(
    email               VARCHAR(50) NOT NULL,
    name                VARCHAR(50) NOT NULL,
    phone_number        INTEGER NOT NULL,
    location            VARCHAR(50) NOT NULL,

    CONSTRAINT ShelterPK PRIMARY KEY (email),
    CONSTRAINT ShelterEmailFK FOREIGN KEY (email) REFERENCES Login ON DELETE RESTRICT ON UPDATE CASCADE
    CONSTRAINT PhoneNumberUNIQUE UNIQUE (phone_number)
);

CREATE TABLE Pet(
    id                  INTEGER,
    name                VARCHAR(30) DEFAULT 'To be attributed',
    species             VARCHAR(30),
    age                 VARCHAR(30) NOT NULL,
    color               VARCHAR(30) NOT NULL,
    location            VARCHAR(50) NOT NULL,
    user                VARCHAR(50) NOT NULL,
    adoptedBy           VARCHAR(50),

    CONSTRAINT PetPK PRIMARY KEY (id),
    CONSTRAINT PetUserFK FOREIGN KEY (user) REFERENCES User ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT PetAdoptedByFK FOREIGN KEY (adoptedBy) REFERENCES User ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Photo(
    pet_id              INTEGER,
    photo               VARCHAR(100),

    CONSTRAINT PhotoPK PRIMARY KEY (pet_id, photo),
    CONSTRAINT PhotoPetFK FOREIGN KEY (pet_id) REFERENCES Pet ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE AdoptionProposal(
    user                VARCHAR(50) NOT NULL,
    pet_id              INTEGER NOT NULL,
    state               INTEGER NOT NULL DEFAULT 0,

    CONSTRAINT AdoptionProposalPK PRIMARY KEY (user,pet_id),
    CONSTRAINT AdoptionProposalUserFK FOREIGN KEY (user) REFERENCES User ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT AdoptionProposalPetFK FOREIGN KEY (pet_id) REFERENCES Pet ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT AdoptionProposalPetState CHECK (state == 0 || state == -1 || state == 1)
);

CREATE TABLE Question(
    id                  INTEGER,
    user                VARCHAR(50) NOT NULL,
    pet_id              INTEGER NOT NULL,
    question            VARCHAR(100) NOT NULL,

    CONSTRAINT QuestionPK PRIMARY KEY (id),
    CONSTRAINT QuestionUser FOREIGN KEY (user) REFERENCES User ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT QuestionPetFK FOREIGN KEY (pet_id) REFERENCES Pet ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Favorite(
    user                VARCHAR(50) NOT NULL,
    pet_id              INTEGER NOT NULL,

    CONSTRAINT FavoritePK PRIMARY KEY (user, pet_id),
    CONSTRAINT FavoriteUserFK FOREIGN KEY (user) REFERENCES User ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FavoritePetFK FOREIGN KEY (pet_id) REFERENCES Pet ON DELETE CASCADE ON UPDATE CASCADE
);
