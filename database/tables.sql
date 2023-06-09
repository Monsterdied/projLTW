DROP TABLE IF EXISTS USERS;
CREATE TABLE USERS(
    IDUSER INT NOT NULL,
    NAME TEXT NOT NULL,
    EMAIL TEXT NOT NULL,
    USERNAME TEXT NOT NULL,
    PASSWORD TEXT NOT NULL,
    TYPE TEXT NOT NULL,
    BIO TEXT ,
    PROFILE_PICK TEXT,
    CONSTRAINT USERS_PK PRIMARY KEY (IDUSER)
);

DROP TABLE IF EXISTS TAGS;
CREATE TABLE TAGS(
    IDTAG INT NOT NULL,
    HASTAG_NAME TEXT NOT NULL,
    CONSTRAINT TAG_PK PRIMARY KEY (IDTAG)
);

DROP TABLE IF EXISTS STATUS;
CREATE TABLE STATUS(
    IDSTATUS INT NOT NULL,
    STATUS TEXT NOT NULL,
    CONSTRAINT STATUS_PK PRIMARY KEY (IDSTATUS)
);

DROP TABLE IF EXISTS DEPARTEMENTS;
CREATE TABLE DEPARTEMENTS(
    IDDEPARTEMENT INT NOT NULL,
    DEPARTEMENTS TEXT NOT NULL,
    SINOPSE TEXT,
    CONSTRAINT DEPARTEMENTS_PK PRIMARY KEY (IDDEPARTEMENT)
);

DROP TABLE IF EXISTS TICKETS;
CREATE TABLE TICKETS(
    IDTICKET INT NOT NULL,
    PUBLISHED_TIME INT NOT NULL,
    CONTENT TEXT NOT NULL,

    IDSTATUS INT NOT NULL,
    IDCLIENT INT NOT NULL,
    IDAGENT INT NOT NULL,
    IDDEPARTEMENT INT NOT NULL,
    IDFAQ INT ,
    CONSTRAINT TICKET_PK PRIMARY KEY (IDTICKET),
    CONSTRAINT TICKET_STATUS_FK1 FOREIGN KEY(IDSTATUS) REFERENCES STATUS(IDSTATUS) ON UPDATE CASCADE ON DELETE CASCADE ,
    CONSTRAINT TICKET_CLIENT_FK2 FOREIGN KEY(IDCLIENT) REFERENCES USERS(IDUSER) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT TICKET_AGENT_FK3 FOREIGN KEY(IDAGENT) REFERENCES USERS(IDUSER) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT TICKET_DEPARTEMENT_FK4 FOREIGN KEY(IDDEPARTEMENT) REFERENCES DEPARTEMENTS(IDDEPARTEMENT) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT TICKET_FAQ_FK5 FOREIGN KEY(IDFAQ) REFERENCES FAQS(IDFAQ) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS LOGS;
CREATE TABLE LOGS(
    IDLOG INT NOT NULL,
    LOG_ACTION TEXT NOT NULL,
    DATE INT NOT NULL,
    IDTICKET INT NOT NULL ,
    CONSTRAINT LOG_PK PRIMARY KEY (IDLOG),
    CONSTRAINT LOG_TICKET_FK1 FOREIGN KEY(IDTICKET) REFERENCES TICKETS(IDTICKET) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS MESSAGES;
CREATE TABLE MESSAGES(
    IDMESSAGE INT NOT NULL,

    PUBLISHED_TIME INT NOT NULL,
    CONTENT TEXT NOT NULL,

    IDUSER INT NOT NULL ,
    IDTICKET INT NOT NULL ,
    CONSTRAINT MESSAGES_PK PRIMARY KEY (IDMESSAGE),
    CONSTRAINT MESSAGE_USER_FK1 FOREIGN KEY(IDUSER) REFERENCES USERS(IDUSER) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT MESSAGE_TICKET_FK2 FOREIGN KEY(IDTICKET) REFERENCES TICKETS(IDTICKET) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS FAQS;
CREATE TABLE FAQS(
    IDFAQ INT NOT NULL,

    QUESTION TEXT NOT NULL,
    ANSWER TEXT NOT NULL,

    IDTICKET NOT NULL,
    IDAGENT NOT NULL,
    CONSTRAINT IDFAQ_PK PRIMARY KEY (IDFAQ),
    CONSTRAINT FAQ_AGENT_FK1 FOREIGN KEY(IDAGENT) REFERENCES USERS(IDUSER) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT FAQ_TICKET_FK2 FOREIGN KEY(IDTICKET) REFERENCES TICKETS(IDTICKET) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS TAG_TICKET;
CREATE TABLE TAG_TICKET(
    IDTAG INT NOT NULL,
    IDTICKET INT NOT NULL,
    CONSTRAINT TAG_TICKET_PK PRIMARY KEY (IDTICKET,IDTAG),
    CONSTRAINT TAG_TICKET_TICKET_FK1 FOREIGN KEY(IDTICKET) REFERENCES TICKETS(IDTICKET) ON UPDATE CASCADE ON DELETE CASCADE ,
    CONSTRAINT TAG_TICKET_TAG_FK1 FOREIGN KEY(IDTAG) REFERENCES TAGS(IDETAG) ON UPDATE CASCADE ON DELETE CASCADE 
);

DROP TABLE IF EXISTS DEPARTMENT_AGENT;
CREATE TABLE DEPARTMENT_AGENT(
    IDAGENT INT NOT NULL,
    IDDEPARTEMENT INT NOT NULL,
    CONSTRAINT DEPARTMENT_AGENT_PK PRIMARY KEY (IDAGENT,IDDEPARTEMENT),
    CONSTRAINT DEPARTMENT_AGENT_FK1 FOREIGN KEY(IDAGENT) REFERENCES USERS(IDUSER) ON UPDATE CASCADE ON DELETE CASCADE ,
    CONSTRAINT DEPARTMENT_AGENT_FK1 FOREIGN KEY(IDDEPARTEMENT) REFERENCES DEPARTEMENTS(IDDEPARTEMENT) ON UPDATE CASCADE ON DELETE CASCADE 
);