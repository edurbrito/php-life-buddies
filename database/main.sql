PRAGMA foreign_keys = ON;

CREATE TABLE LoginData(
    email               VARCHAR(50) NOT NULL,
    password            VARCHAR(50) NOT NULL,

    CONSTRAINT loginPK PRIMARY KEY (email)
);

CREATE TABLE User(
    email               VARCHAR(50) NOT NULL,
    name                VARCHAR(50) NOT NULL,
    phone_number        INTEGER NOT NULL,

    CONSTRAINT UserPK PRIMARY KEY (email),
    CONSTRAINT UserEmail FOREIGN KEY (email) REFERENCES LoginData ON DELETE CASCADE ON UPDATE CASCADE,
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
    CONSTRAINT PetUserFK FOREIGN KEY (user) REFERENCES User ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT PetAdoptedByFK FOREIGN KEY (adoptedBy) REFERENCES User ON DELETE SET NULL ON UPDATE CASCADE
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
    CONSTRAINT AdoptionProposalPetState FOREIGN KEY (state) REFERENCES AdoptState ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE AdoptState (
    id                  INTEGER,
    string              VARCHAR(50) NOT NULL,

    CONSTRAINT AdoptStatePK PRIMARY KEY (id)
);

INSERT INTO AdoptState VALUES(-1, "Not Accepted");
INSERT INTO AdoptState VALUES(0, "Waiting for Decision");
INSERT INTO AdoptState VALUES(1, "Accepted");

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

CREATE TABLE UserNotification(
    user                VARCHAR(50) NOT NULL,
    string              INTEGER NOT NULL,
    notifier            VARCHAR(50) DEFAULT NULL,
    pet_id              INTEGER DEFAULT NULL,

    CONSTRAINT UserNotificationPK PRIMARY KEY (user, string),
    CONSTRAINT UserNotificationFK FOREIGN KEY (user) REFERENCES User ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT UserNotificationNotifierFK FOREIGN KEY (notifier) REFERENCES User ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT UserNotificationPetFK FOREIGN KEY (pet_id) REFERENCES Pet ON DELETE CASCADE ON UPDATE CASCADE
);