-- Supprime les tables si elles existent déjà
DROP TABLE IF EXISTS S_ABONNER;
DROP TABLE IF EXISTS UTILISATEUR;
DROP TABLE IF EXISTS NEWS;
DROP TABLE IF EXISTS CLUB;

-- ---------------------------------------------------------------------------
--       TABLE : CLUB
-- ---------------------------------------------------------------------------

CREATE TABLE CLUB
(
    ID_CLUB INT AUTO_INCREMENT NOT NULL,
    NOM_CLUB VARCHAR(128) NOT NULL,
    LIGUE_CLUB CHAR(2) NOT NULL,
    PRIMARY KEY (ID_CLUB)
);

-- ---------------------------------------------------------------------------
--       TABLE : UTILISATEUR
-- ---------------------------------------------------------------------------

CREATE TABLE UTILISATEUR
(
    ID_UTI INT AUTO_INCREMENT NOT NULL,
    ID_CLUB INT NOT NULL,
    NOM_UTI VARCHAR(30) NOT NULL,
    PRENOM_UTI VARCHAR(30) NOT NULL,
    SEXE_UTI VARCHAR(15) NOT NULL,
    PASSWORD_UTI VARCHAR(64) NOT NULL,
    DATE_INSCRIPTION DATE NULL,
    IMAGE_UTI TEXT NULL,
    MAIL_UTI TEXT NULL,
    PRIMARY KEY (ID_UTI),
    FOREIGN KEY (ID_CLUB) REFERENCES CLUB (ID_CLUB) ON DELETE CASCADE
);

-- ---------------------------------------------------------------------------
--       TABLE : NEWS
-- ---------------------------------------------------------------------------

CREATE TABLE NEWS
(
    ID_NEWS INT AUTO_INCREMENT NOT NULL,
    ID_CLUB INT NOT NULL,
    ARTICLE_NEWS VARCHAR(255) NULL,
    PRIMARY KEY (ID_NEWS),
    FOREIGN KEY (ID_CLUB) REFERENCES CLUB (ID_CLUB) ON DELETE CASCADE
);

-- ---------------------------------------------------------------------------
--       TABLE : S_ABONNER
-- ---------------------------------------------------------------------------

CREATE TABLE S_ABONNER
(
    ID_UTI INT NOT NULL,
    ID_CLUB INT NOT NULL,
    PRIMARY KEY (ID_UTI, ID_CLUB),
    FOREIGN KEY (ID_UTI) REFERENCES UTILISATEUR (ID_UTI) ON DELETE CASCADE,
    FOREIGN KEY (ID_CLUB) REFERENCES CLUB (ID_CLUB) ON DELETE CASCADE
);

-- ---------------------------------------------------------------------------
--                FIN DE GENERATION
-- ---------------------------------------------------------------------------
