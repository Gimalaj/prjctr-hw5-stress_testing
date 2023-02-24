-- create the databases
CREATE DATABASE IF NOT EXISTS prjctr;

CREATE USER IF NOT EXISTS 'prjctr'@'%';
SET PASSWORD FOR 'prjctr'@'%' = 'qwerty123';
FLUSH PRIVILEGES;