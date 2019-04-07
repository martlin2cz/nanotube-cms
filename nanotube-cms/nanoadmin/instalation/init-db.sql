CREATE DATABASE nanotube;

USE nanotube;

CREATE USER 'nanotube_db_user'@'localhost' IDENTIFIED BY 'his_nano_pa55word';

GRANT ALL PRIVILEGES ON nanotube.* TO 'nanotube_db_user'@'localhost' WITH GRANT OPTION;

