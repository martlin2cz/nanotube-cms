CREATE DATABASE nanotube_dev;

USE nanotube_dev;

CREATE USER 'nanotube_db_user'@'localhost' IDENTIFIED BY 'his_nano_password';

GRANT ALL PRIVILEGES ON nanotube_dev.* TO 'nanotube_db_user'@'localhos' WITH GRANT OPTION;

