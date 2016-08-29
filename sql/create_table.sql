create database if not exists wantedly_subject;
use wantedly_subject;

create table if not exists user_list(
	user_id int not null auto_increment,
	user_name varchar(256) not null,
	update_time datetime,
	register_time datetime,
	primary key(user_id)
)default charset=utf8;

create table if not exists skill_data(
	skill_id int not null auto_increment,
	skill_name varchar(256) not null,
	update_time datetime,
	register_time datetime,
	primary key(skill_id)
)default charset=utf8;

create table if not exists user_skill(
	user_id int not null,
	skill_id int not null,
	skill_point int not null,
	update_time datetime,
	register_time datetime
)default charset=utf8;

create table if not exists user_skill_pointup(
	user_id int(8) not null,
	to_user_id int(8) not null,
	to_skill_id int(8) not null,
	update_time datetime,
	register_time datetime
)default charset=utf8;
