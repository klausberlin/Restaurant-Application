drop database restaurant;
create database restaurant;
use restaurant;

create table category
(
	id int auto_increment
		primary key,
	name varchar(255) null
);

create table foodorders
(
	id int auto_increment
		primary key,
	item_id int null,
	table_id int null,
	order_id int null,
	status_id int not null
);


create table items
(
	id int auto_increment
		primary key,
	name varchar(255) null,
	price decimal(15,2) null,
	category int null,
	constraint items_ibfk_1
		foreign key (category) references category (id)
);

create table orders
(
	id int auto_increment
		primary key,
	user_id int null,
	table_id int null,
	timestamp VARCHAR(255) not null,
	totalprice decimal(15,2) null
);

create table tables
(
	id int auto_increment primary key,
	name varchar(255) null
);

INSERT INTO tables(name) VALUES ('left');
INSERT INTO tables(name) VALUES ('middle');
INSERT INTO tables(name) VALUES ('right');
INSERT INTO tables(name) VALUES ('floor');


create table users
(
	id int auto_increment
		primary key,
	name varchar(80) not null,
	password varchar(40) not null,
	role enum('Kitchen', 'Waitress', 'Manager') null
);

INSERT INTO users(users.name,users.password,users.role) VALUES ('waitress','waitress', 2);
INSERT INTO users(users.name,users.password,users.role) VALUES ('manager','manager', 3);
INSERT INTO users(users.name,users.password,users.role) VALUES ('kitchen','kitchen', 1);

create index order_id
	on foodorders (order_id);

create index item_id
	on foodorders (item_id);

create index table_id
	on foodorders (table_id);



create index category
	on items (category);

alter table foodorders
	add constraint foodorders_ibfk_2
		foreign key (item_id) references items (id);


create index user_id
	on orders (user_id);

alter table foodorders
	add constraint foodorders_ibfk_1
		foreign key (order_id) references orders (id);

alter table foodorders
	add constraint foodorders_ibfk_4
		foreign key (order_id) references orders (id);

alter table foodorders
	add constraint foodorders_ibfk_3
		foreign key (table_id) references tables (id);

alter table orders
	add constraint orders_ibfk_1
		foreign key (user_id) references users (id);
