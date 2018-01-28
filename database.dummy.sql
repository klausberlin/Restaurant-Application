create table category
(
	id int auto_increment
		primary key,
	name varchar(255) null
)
;

create table foodorders
(
	id int auto_increment
		primary key,
	item_id int null,
	table_id int null,
	order_id int null,
	status_id int not null
)
;

create index order_id
	on foodorders (order_id)
;

create index item_id
	on foodorders (item_id)
;

create index table_id
	on foodorders (table_id)
;

create table items
(
	id int auto_increment
		primary key,
	name varchar(255) null,
	price decimal(15,2) null,
	category int null,
	constraint items_ibfk_1
		foreign key (category) references category (id)
)
;

create index category
	on items (category)
;

alter table foodorders
	add constraint foodorders_ibfk_2
		foreign key (item_id) references items (id)
;

create table orders
(
	id int auto_increment
		primary key,
	user_id int null,
	table_id int null,
	timestamp timestamp default CURRENT_TIMESTAMP not null,
	totalprice decimal(15,2) null
)
;

create index user_id
	on orders (user_id)
;

alter table foodorders
	add constraint foodorders_ibfk_1
		foreign key (order_id) references orders (id)
;

alter table foodorders
	add constraint foodorders_ibfk_4
		foreign key (order_id) references orders (id)
;

create table tables
(
	id int auto_increment
		primary key,
	name varchar(255) null
)
;

alter table foodorders
	add constraint foodorders_ibfk_3
		foreign key (table_id) references tables (id)
;

create table users
(
	id int auto_increment
		primary key,
	name varchar(80) not null,
	password varchar(40) not null,
	role enum('Kitchen', 'Waitress', 'Manager') null
)
;

alter table orders
	add constraint orders_ibfk_1
		foreign key (user_id) references users (id)
;
