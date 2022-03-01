create database shoppinglist;

use shoppinglist;

create table item (
    id int primary key auto_increment,
    description varchar(255) not null,
    amount smallint usigned not null
);

insert into into item (description,amount) values ('Test item', 1)