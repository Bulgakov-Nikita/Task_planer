CREATE DATABASE tasks;
USE tasks;

CREATE TABLE type_task (
	id INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(16)
);

CREATE TABLE type_interval (
	id INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(16)
);

CREATE TABLE periods_id (
	tasks_id INT,
    `interval` INT,
    type_interval_id INT,
    FOREIGN KEY (type_interval_id) REFERENCES type_interval(id)
);

CREATE TABLE projects (
	id INT PRIMARY KEY AUTO_INCREMENT,
    date_begin DATETIME,
    date_end DATETIME,
    `description` TEXT,
    complite BOOL
);

# Элвин
create table `groups` (
id int auto_increment PRIMARY KEY,
`name` varchar(50) not null,
date_begin DATETIME,
date_end DATETIME,
`description` text,
complite bool,
projects_id int); 

alter table `groups`
ADD FOREIGEN KEY (projects_id) references projects (id);
