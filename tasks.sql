CREATE DATABASE tasks;
USE tasks;

CREATE TABLE type_task (
	id INT PRIMARY KEY AUTO_INCREMENT,
   	`name` VARCHAR(64) NOT NULL
);

CREATE TABLE type_interval (
	id INT PRIMARY KEY AUTO_INCREMENT,
   	`name` VARCHAR(64) NOT NULL
);

CREATE TABLE projects (
	id INT PRIMARY KEY AUTO_INCREMENT,
	`name` VARCHAR(64) NOT NULL,
	date_begin DATETIME,
	date_end DATETIME,
	`description` TEXT,
	complite BOOL,
    created_at INT,
    created_by INT,
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
	complite BOOL,
	projects_id INT,
	FOREIGN KEY (projects_id) REFERENCES projects(id),
    created_at INT,
    created_by INT,
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
	complite BOOL NOT NULL,
	groups_id INT,
	projects_id INT,
	data_begin DATETIME,
	data_end DATETIME, 
	parent_id INT, 
	FOREIGN KEY (type_task_id) REFERENCES type_task(id),
	FOREIGN KEY (groups_id) REFERENCES `groups`(id),
	FOREIGN KEY (projects_id) REFERENCES projects(id),
	FOREIGN KEY (parent_id) REFERENCES tasks(id),
    created_at INT,
    created_by INT,
    updated_at INT,
    updated_by INT,
    deleted_at INT,
    deleted_by INT,
    `active` TINYINT(1),
    `lock` INT
);

CREATE TABLE periods (
	id INT PRIMARY KEY AUTO_INCREMENT,
	tasks_id INT,
	`interval` INT,
	type_interval_id INT,
	FOREIGN KEY (type_interval_id) REFERENCES type_interval(id),
	FOREIGN KEY (tasks_id) REFERENCES tasks(id)
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
	FOREIGN KEY (tasks_id) REFERENCES tasks(id),
	FOREIGN KEY  (action_id) REFERENCES `action`(id)
);
