drop database if exists waycloud;
create database waycloud;
use waycloud;

create table if not exists users (
	id_user int not null auto_increment primary key,
	name varchar(30) not null,
	surname varchar(30) not null,
	email varchar(255) not null,
	password varchar(255) not null);
	
create table if not exists files (
	id_file int not null auto_increment primary key,
	name varchar(100) not null,
	size int not null,
	type varchar(30) not null default '',
	user int not null,
	foreign key (user) references users(id_user));

