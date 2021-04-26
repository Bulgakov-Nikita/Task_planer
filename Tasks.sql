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
	complite BOOL
);

CREATE TABLE `groups` (
	id INT PRIMARY KEY AUTO_INCREMENT,
	`name` VARCHAR(64) NOT NULL,
	date_begin DATETIME,
	date_end DATETIME,
	`description` TEXT,
	complite BOOL,
	projects_id INT,
	FOREIGN KEY (projects_id) REFERENCES projects(id)
); 

CREATE TABLE tasks (
	id INT PRIMARY KEY AUTO_INCREMENT AUTO_INCREMENT,
	`name` VARCHAR(64) NOT NULL,
	`description` TEXT,
	type_task_id INT,
	complite BOOL NOT NULL,
	groups_id INT,
	projects_id INT,
	data_begin DATETIME,
	data_end DATETIME, 
	data_add DATETIME NOT NULL,
	data_edit DATETIME,
	parent_id INT, 
	FOREIGN KEY (type_task_id) REFERENCES type_task(id),
	FOREIGN KEY (groups_id) REFERENCES `groups`(id),
	FOREIGN KEY (projects_id) REFERENCES projects(id),
	FOREIGN KEY (parent_id) REFERENCES tasks(id)
);

CREATE TABLE periods (
	id INT PRIMARY KEY AUTO_INCREMENT,
	tasks_id INT,
	`interval` INT,
	type_interval_id INT,
	FOREIGN KEY (type_interval_id) REFERENCES type_interval(id),
	FOREIGN KEY (tasks_id) REFERENCES tasks(id)
);
  
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
