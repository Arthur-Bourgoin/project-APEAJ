CREATE TABLE Training(
    idTraining INT AUTO_INCREMENT,
    wording VARCHAR(100),
    description TEXT,
    qualifLevel VARCHAR(50),
    PRIMARY KEY(idTraining)
) ENGINE = InnoDB;

CREATE TABLE Session(
    idSession INT AUTO_INCREMENT,
    wording VARCHAR(50) NOT NULL,
    theme VARCHAR(50),
    description TEXT,
    timeBegin DATETIME,
    timeEnd DATETIME,
    idTraining INT NOT NULL,
    PRIMARY KEY(idSession),
    FOREIGN KEY(idTraining) REFERENCES Training(idTraining)
) ENGINE = InnoDB;

CREATE TABLE Users(
    idUser INT AUTO_INCREMENT,
    login VARCHAR(50),
    lastName VARCHAR(50),
    firstName VARCHAR(50),
    picture VARCHAR(50),
    typePwd TINYINT,
    pwd VARCHAR(50),
    role VARCHAR(50),
    idTraining INT,
    PRIMARY KEY(idUser),
    FOREIGN KEY(idTraining) REFERENCES Training(idTraining)
) ENGINE = InnoDB;

CREATE TABLE ElementForm(
    idElementForm VARCHAR(50),
    type VARCHAR(50),
    defaultLabel VARCHAR(50),
    defaultPicto VARCHAR(100),
    PRIMARY KEY(idElementForm)
) ENGINE = InnoDB;

CREATE TABLE Form(
    idEducator INT,
    idStudent INT NOT NULL,
    numero INT,
    finish BOOLEAN,
    creationDate DATETIME,
    educatorNote TINYINT,
    studentNote TINYINT,
    bgColor VARCHAR(50),
    studentLastName VARCHAR(50),
    studentFirstName VARCHAR(50),
    applicantName VARCHAR(50),
    applicationDate DATE,
    location VARCHAR(50),
    description TEXT,
    urgencyDegree VARCHAR(50),
    interventionDate DATE,
    interventionDuration CHAR(5),
    interventionValidation BOOLEAN,
    maintenanceType TINYINT,
    interventionNature TINYINT,
    workDone TEXT,
    workNotDone TEXT,
    newIntervention BOOLEAN,
    idSession INT,
    PRIMARY KEY(idStudent, numero),
    FOREIGN KEY(idStudent) REFERENCES Users(idUser),
    FOREIGN KEY(idEducator) REFERENCES Users(idUser),
    FOREIGN KEY(idSession) REFERENCES Session(idSession)
) ENGINE = InnoDB;

CREATE TABLE CommentForm(
    idCommentForm INT AUTO_INCREMENT,
    wording VARCHAR(50),
    text TEXT,
    audio VARCHAR(50) ,
    admin BOOLEAN,
    lastModif DATETIME,
    idAuthor INT NOT NULL,
    numero INT NOT NULL,
    idStudent INT NOT NULL,
    PRIMARY KEY(idCommentForm),
    FOREIGN KEY(idStudent, numero) REFERENCES Form(idStudent, numero),
    FOREIGN KEY(idAuthor) REFERENCES Users(idUser)
) ENGINE = InnoDB;

CREATE TABLE Picture(
    idPicture INT AUTO_INCREMENT,
    path VARCHAR(50),
    title VARCHAR(50),
    idAuthor INT NOT NULL,
    idStudent INT NOT NULL,
    numero INT NOT NULL,
    PRIMARY KEY(idPicture),
    FOREIGN KEY(idAuthor) REFERENCES Users(idUser),
    FOREIGN KEY(idStudent, numero) REFERENCES Form(idStudent, numero)
) ENGINE = InnoDB;

CREATE TABLE Pictogram(
    idPictogram INT AUTO_INCREMENT,
    title VARCHAR(50),
    type VARCHAR(50),
    path VARCHAR(100),
    PRIMARY KEY(idPictogram)
) ENGINE = InnoDB;

CREATE TABLE Material(
    idMaterial INT AUTO_INCREMENT,
    wording VARCHAR(150) ,
    description TEXT,
    type TEXT,
    picture VARCHAR(100) ,
    PRIMARY KEY(idMaterial)
) ENGINE = InnoDB;

CREATE TABLE Display(
    idElementForm VARCHAR(50) ,
    idStudent INT,
    numero INT,
    level TINYINT,
    label VARCHAR(50) ,
    picto VARCHAR(100) ,
    active BOOLEAN,
    bold BOOLEAN,
    italic BOOLEAN,
    fontFamily VARCHAR(50) ,
    fontColor VARCHAR(50) ,
    fontSize TINYINT,
    bgColor VARCHAR(50) ,
    textToSpeechBool BOOLEAN,
    textToSpeechText TEXT,
    PRIMARY KEY(idElementForm, idStudent, numero),
    FOREIGN KEY(idElementForm) REFERENCES ElementForm(idElementForm),
    FOREIGN KEY(idStudent, numero) REFERENCES Form(idStudent, numero)
) ENGINE = InnoDB;

CREATE TABLE Used(
    idStudent INT,
    numero INT,
    idMaterial INT,
    PRIMARY KEY(idStudent, numero, idMaterial),
    FOREIGN KEY(idStudent, numero) REFERENCES Form(idStudent, numero),
    FOREIGN KEY(idMaterial) REFERENCES Material(idMaterial)
) ENGINE = InnoDB;

CREATE TABLE CommentStudent(
   idStudent INT,
   idEducator INT,
   text TEXT,
   lastModif DATETIME,
   PRIMARY KEY(idStudent, idEducator),
   FOREIGN KEY(idStudent) REFERENCES Users(idUser),
   FOREIGN KEY(idEducator) REFERENCES Users(idUser)
) ENGINE = InnoDB;

