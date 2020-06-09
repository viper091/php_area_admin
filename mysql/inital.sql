

create table users(
    id int auto_increment,
    username varchar(60) not null,
    password varchar(255) not null,
    primary key(id)
);

create table clients(
    id int auto_increment,
    `name` varchar(60) not null,
    birthday timestamp not null,
    cpf varchar(11) not null,
    rg varchar(20) not null,
    phone_number varchar(11) not null,
    primary key(id)

);

create table adresses
(
    id int  auto_increment,
    client_id int not null,
    address varchar(60) not null,

    primary key(id),
    foreign key(client_id) references clients(id)

);
insert into users(username,password) values ("vitor","123");
insert into clients(name,birthday, cpf,rg,phone_number) values ("cliente 1",now(), "1234567489","123456789","000000000");
insert into adresses(client_id,address) values (1,"endereco 1"),(1, "endereco 2");