# create databases
CREATE DATABASE IF NOT EXISTS `hero`;
CREATE DATABASE IF NOT EXISTS `herotest`;

# create root user and grant rights
CREATE USER 'root'@'localhost' IDENTIFIED BY 'root';
GRANT ALL ON *.* TO 'root'@'%';