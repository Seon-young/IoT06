create table gps (
   num int not null auto_increment,
   mac char(100) not null,
   lat double not null,
   lon double not null,
   primary key(num)
);