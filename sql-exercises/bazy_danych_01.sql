create database test1;
use test1;


create table uczen
(
	`id_uczen` int auto_increment primary key,
    `imie` varchar(30) not null,
    `nazwisko` varchar(30) not null
);

insert into uczen (imie, nazwisko) values ('AAAA','BBBB');
insert into uczen (imie, nazwisko) values ('CCCC','DDDD');
insert into uczen (imie, nazwisko) values ('EEEE','FFFF');
insert into uczen (imie, nazwisko) values ('GGGG','HHHH');

select * from uczen;

create table przedmiot
(
	`id_przedmiot` int auto_increment primary key,
    `nazwa` varchar(30) not null
);


insert into przedmiot (nazwa) values ('Matematyka');
insert into przedmiot (nazwa) values ('Fizyka');

select * from przedmiot;

create table ocena
(
	`id_ocena` int auto_increment primary key,
    `wartosc` int,
    `data_` date,
    `id_uczen` int,
    `id_przedmiot` int,
    constraint `ocena_uczen` foreign key (id_uczen) references uczen(id_uczen),
    constraint `ocena_przedmiot` foreign key (id_przedmiot) references przedmiot(id_przedmiot)
);

load data infile 'C:/Users/.../Desktop/data.csv' -- wstawic adres pliku csv
into table ocena
fields terminated by ','
enclosed by '"'
lines terminated by '\n'
ignore 1 rows
(wartosc, data_, id_uczen, id_przedmiot);

select * from ocena;

select uczen.imie, przedmiot.nazwa, avg(wartosc)
from ocena
inner join uczen on ocena.id_uczen = uczen.id_uczen
inner join przedmiot on ocena.id_przedmiot = przedmiot.id_przedmiot
group by uczen.imie;

select uczen.imie, przedmiot.nazwa, avg(wartosc), max(wartosc), min(wartosc), max(data_) as ostatnia_data_,
(select wartosc from ocena as o where o.id_uczen = ocena.id_uczen order by data_ desc limit 1) as ostatnia_ocena
from ocena
inner join uczen on ocena.id_uczen = uczen.id_uczen
inner join przedmiot on ocena.id_przedmiot = przedmiot.id_przedmiot
group by uczen.imie;
