CREATE DATABASE IF NOT EXISTS konva_editor;

USE konva_editor;

CREATE TABLE IF NOT EXISTS users(
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY(id)
);

INSERT INTO users (name, email, password) VALUES('demouser', 'demouser@demo.com', '123456')