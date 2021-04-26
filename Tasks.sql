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

CREATE TABLE `groups` (
  id INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(32) NOT NULL,
  date_begin DATETIME,
  date_end DATETIME,
  `description` TEXT,
  complite BOOL,
  projects_id INT,
  FOREIGEN KEY (projects_id) references projects(id)
); 

CREATE tasks (
  id INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(32) NOT NULL,
  `description`TEXT,
  type_task_id INT,
  compfite BOOL NOT NULL,
  grops_id INT,
  objects_id INT,
  data_begin DATETIME ,
  data_end DATETIME , 
  data_add DATETIME NOT NULL,
  data_edit DATETIME ,
  periods_id INT,
  parent_id INT, 
  FOREIGN KEY (type_task_id) REFERENCES type_task(id),
  FOREIGN KEY (groups_id) REFERENCES `groups`(id),
  FOREIGN KEY (projects_id) REFERENCES projects(id),
  FOREIGN KEY (periods_id) REFERENCES periods(id),
  FOREIGN KEY (perent_id) REFERENCES tasks(id)
  );
  
CREATE TABLE task_action(
  tasks_id INT,
  action_id INT,
  sort INT,
  FOREIGN KEY (tasks_id) REFERENCES tasks(id),
  FOREIGN KEY  (action_id) REFERENCES `action`(id)
);
