

CREATE DATABASE message CHARACTER SET utf8 COLLATE utf8_general_ci;

create table message.events
(
	id int auto_increment
		primary key,
	name varchar(128) null,
	class_name varchar(128) not null,
	method varchar(128) null
);

create table message.message
(
	id int auto_increment
		primary key,
	body text null
);

INSERT INTO message.events (name, class_name, method)
VALUES ('OnSubmit', 'engldom\\Events\\OnSubmit', 'execute');

