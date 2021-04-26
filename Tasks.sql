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