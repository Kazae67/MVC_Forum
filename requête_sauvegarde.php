CREATE TABLE Category(
   id_category INT,
   label VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_category)
);

CREATE TABLE User(
   id_user INT,
   nickname VARCHAR(50) NOT NULL,
   password VARCHAR(255) NOT NULL,
   email VARCHAR(150) NOT NULL,
   creation_date DATETIME NOT NULL,
   role VARCHAR(20) NOT NULL,
   PRIMARY KEY(id_user),
   UNIQUE(nickname),
   UNIQUE(email)
);

CREATE TABLE Topic(
   id_topic INT,
   title VARCHAR(150) NOT NULL,
   creation_date DATETIME NOT NULL,
   is_locked TINYINT(1) NOT NULL,
   id_user INT NOT NULL,
   id_category INT NOT NULL,
   PRIMARY KEY(id_topic),
   FOREIGN KEY(id_user) REFERENCES User(id_user),
   FOREIGN KEY(id_category) REFERENCES Category(id_category)
);

CREATE TABLE Post(
   id_post INT,
   text TEXT NOT NULL,
   creation_date DATETIME NOT NULL,
   id_user INT NOT NULL,
   id_topic INT NOT NULL,
   PRIMARY KEY(id_post),
   FOREIGN KEY(id_user) REFERENCES User(id_user),
   FOREIGN KEY(id_topic) REFERENCES Topic(id_topic)
);