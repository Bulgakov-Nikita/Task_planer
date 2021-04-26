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
#Добавил tasks (Долгов Алекскй)
create table tasks (
id int auto_increment primary key,
`name` varchar (32) not null,
`description` varchar (128),
type_task_id int,
compfite bool not null,
grops_id int,
objects_id int,
data_begin datetime,
data_end datetime, 
data_add datetime not null,
data_edit datetime,
periods_id int,
parent_id int
);
alter table tasks
add foreign key (type_task_id) references type_task (id);
alter table tasks
add foreign key (groups_id) references `groups` (id);
alter table tasks
add foreign key (projects_id) references projects (id);
alter table tasks
add foreign key (periods_id) references periods (id);
alter table tasks
add foreign key (perent_id) references tasks (id);
