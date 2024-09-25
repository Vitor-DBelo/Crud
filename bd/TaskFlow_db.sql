create database TaskFlow
default character set utf8mb4
default collate utf8mb4_general_ci;

use TaskFlow;

-- Tabela de usuários
create table user_db(
    id int not null auto_increment, 
    nome varchar(150) not null,
    email varchar(255) not null unique,
    senha varchar(255) not null, 
    primary key (id) 
);

-- Tabela de tarefas
create table tarefas(
    id int not null auto_increment,
    titulo varchar(155),
    descrição text,
    user_id int, 
    primary key (id), 
    foreign key (user_id) references user_db(id) on delete cascade 
);
