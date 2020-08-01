# create databases
CREATE DATABASE IF NOT EXISTS `uefa`;
CREATE DATABASE IF NOT EXISTS `uefatest`;

# create root user and grant rights
CREATE USER 'root'@'localhost' IDENTIFIED BY 'root';
GRANT ALL ON *.* TO 'root'@'%';