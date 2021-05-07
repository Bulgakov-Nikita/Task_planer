CREATE DATABASE IF NOT EXISTS tasks_db DEFAULT CHARACTER SET utf8 COLLATE utf8_default_ci;
USE tasks_db;

CREATE TABLE type_task (
	id INT PRIMARY KEY AUTO_INCREMENT,
   	`name` VARCHAR(64) NOT NULL
);

CREATE TABLE type_interval (
	id INT PRIMARY KEY AUTO_INCREMENT,
   	`name` VARCHAR(64) NOT NULL
);

CREATE TABLE users(
	id INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    `password` VARCHAR(45) NOT NULL
);

CREATE TABLE projects (
	id INT PRIMARY KEY AUTO_INCREMENT,
	`name` VARCHAR(64) NOT NULL,
	date_begin DATETIME,
	date_end DATETIME,
	`description` TEXT,
    created_at INT NOT NULL,
    created_by INT NOT NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE,
    updated_at INT,
    updated_by INT,
    deleted_at INT,
    deleted_by INT,
    `active` TINYINT(1),
    `lock` INT
);

CREATE TABLE `groups` (
	id INT PRIMARY KEY AUTO_INCREMENT,
	`name` VARCHAR(64) NOT NULL,
	date_begin DATETIME,
	date_end DATETIME,
	`description` TEXT,
	projects_id INT,
	FOREIGN KEY (projects_id) REFERENCES projects(id) ON DELETE CASCADE,
    created_at INT NOT NULL,
    created_by INT NOT NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE,
    updated_at INT,
    updated_by INT,
    deleted_at INT,
    deleted_by INT,
    `active` TINYINT(1),
    `lock` INT
); 

CREATE TABLE tasks (
	id INT PRIMARY KEY AUTO_INCREMENT,
	`name` VARCHAR(64) NOT NULL,
	`description` TEXT,
	type_task_id INT,
	groups_id INT,
	projects_id INT,
	data_begin DATETIME,
	data_end DATETIME, 
	parent_id INT, 
	FOREIGN KEY (type_task_id) REFERENCES type_task(id) ON DELETE CASCADE,
	FOREIGN KEY (groups_id) REFERENCES `groups`(id) ON DELETE CASCADE,
	FOREIGN KEY (projects_id) REFERENCES projects(id) ON DELETE CASCADE,
	FOREIGN KEY (parent_id) REFERENCES tasks(id) ON DELETE CASCADE,
    created_at INT NOT NULL,
    created_by INT NOT NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE,
    updated_at INT,
    updated_by INT,
    deleted_at INT,
    deleted_by INT,
    `active` TINYINT(1) NOT NULL,
    `lock` INT
);

CREATE TABLE periods (
	id INT PRIMARY KEY AUTO_INCREMENT,
	tasks_id INT NOT NULL,
	`interval` INT NOT NULL,
	type_interval_id INT NOT NULL,
	FOREIGN KEY (type_interval_id) REFERENCES type_interval(id) ON DELETE CASCADE,
	FOREIGN KEY (tasks_id) REFERENCES tasks(id) ON DELETE CASCADE
);

#Подумать ещё
 CREATE TABLE `action` (
	id INT PRIMARY KEY AUTO_INCREMENT,
	`type` INT,
	`description` TEXT,
	`action` TEXT
);

CREATE TABLE task_action (
	id INT PRIMARY KEY AUTO_INCREMENT,
	tasks_id INT,
	action_id INT,
	sort INT,
	FOREIGN KEY (tasks_id) REFERENCES tasks(id) ON DELETE CASCADE,
	FOREIGN KEY  (action_id) REFERENCES `action`(id) ON DELETE CASCADE
);

INSERT INTO  type_task(id, `name`) values
	(null, 'Лёгкая'),
	(null, 'Средняя'),
	(null, 'Сложная');
