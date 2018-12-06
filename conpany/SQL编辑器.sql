use db_books;
//创建表
CREATE TABLE runoob_tbl(
runoob_id INT NOT NULL AUTO_INCREMENT,
runoob_title VARCHAR(100) NOT NULL,
runoob_author VARCHAR(40) NOT NULL,
submission_date DATETIME,
PRIMARY KEY ( runoob_id ) )ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE runoob_tbl//删除表

select*from runoob_tbl where runoob_author='runoob.com';
UPDATE tb_pdo_mysql1 set name='".$name."',email='".$email."',addre='".$addre."'
UPDATE runoob_tbl SET runoob_title='学习 PHP' and  runoob_author='菜鸟教程' WHERE  runoob_id=1;
UPDATE runoob_tbl SET runoob_title='学习 C++' WHERE runoob_id=3;
select *from runoob_tbl where runoob_id=4;
delete from runoob_tbl where runoob_id>30;
update runoob_tbl SET runoob_title='学习mysql',runoob_author='菜鸟教程' WHERE runoob_id=2;

CREATE TABLE `employee_tbl` (
  `id` int(11) NOT NULL,
  `name` char(10) NOT NULL DEFAULT '',
  `date` datetime NOT NULL,
  `singin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '登录次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `employee_tbl` VALUES('1','小明','2016-04-22 15:25:33','1'),('2', '小王', '2016-04-20 15:25:47', '3'), ('3', '小丽', '2016-04-19 15:26:02', '2'), ('4', '小王', '2016-04-07 15:26:14', '4'), ('5', '小明', '2016-04-11 15:26:40', '4'), ('6', '小明', '2016-04-04 15:26:54', '2');
SELECT *FROM employee_tbl;
SELECT name,COUNT(*) FROM employee_tbl GROUP BY name;

SELECT name, SUM(singin) as singin_count FROM  employee_tbl GROUP BY name WITH ROLLUP;

SELECT coalesce(name,'总数'),SUM(singin) as singin_count FROM employee_tbl GROUP BY name WITH ROLLUP;

create table tcount_tbl(
id int(11) NOT NULL,
runoob_author varchar(40) NOT NULL,
runoob_count varchar(20) NOT NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO tcount_tbl VALUES ('1','菜鸟教程','10'),('2','RUNOBB.CON','20'),('3','PHP','30');

SELECT a.runoob_id, a.runoob_author, b.runoob_count FROM runoob_tbl a LEFT JOIN tcount_tbl b ON a.runoob_author = b.runoob_author;
SELECT a.runoob_id, a.runoob_author, b.runoob_count FROM runoob_tbl a INNER JOIN tcount_tbl b ON a.runoob_author = b.runoob_author;
SELECT a.runoob_id, a.runoob_author, b.runoob_count FROM runoob_tbl a, tcount_tbl b WHERE a.runoob_author = b.runoob_author;



CREATE TABLE runoob_transaction_test( id int(5) ) engine=innodb;
select * from runoob_transaction_test;
begin;
insert into runoob_transaction_test value(5);
insert into runoob_transaction_test value(6);
commit;
select *from runoob_transaction_test;

begin;
insert into runoob_transaction_test value(7);
rollback;
select*from runoob_transaction_test;

use db_books;

create table testalter_tb1(
i int,
c char(1)
);
//alter的应用
alter table testalter_tb1 DROP i;
alter table testalter_tb1 ADD i INT;
SHOW COLUMNS FROM testalter_tb1;
ALTER TABLE testalter_tb1 DROP i;
ALTER TABLE testalter_tb1 ADD i INT FIRST;
ALTER TABLE testalter_tb1 DROP i;
ALTER TABLE testalter_tb1 ADD i INT AfTER C ;

ALTER TABLE testalter_tb1 MODIFY C CHAR(10);

ALTER TABLE testalter_tb1 CHANGE j j BIGINT;
ALTER TABLE testalter_tb1 CHANGE j i INT;

ALTER TABLE testalter_tb1 MODIFY j BIGINT NOT NULL DEFAULT 100;

ALTER TABLE testalter_tb1 ALTER i SET DEFAULT 1000;
ALTER TABLE testalter_tb1 ALTER i DROP DEFAULT;

\\修改类型
ALTER TABLE testalter_tb1 ENGINE=MYISAM;
SHOW TABLE STATUS LIKE 'testalter_tb1'

ALTER TABLE testalter_tb1 RENAME TO alter_tb1;
use db_books;

CREATE DATABASE db_shop;
drop database db_shop;
use db_shop;
CREATE TABLE tb_shangpin(
id INT NOT NULL AUTO_INCREMENT,
nam VARCHAR(20) NOT NULL,
sex  VARCHAR(3) NOT NULL,
phone VARCHAR(11) NOT NULL,
address TEXT NOT NULL,
postcode VARCHAR(10) NOT NULL,
submision_date DATE,
PRIMARY KEY(`id`)
)
alter table tb_shangpin RENAME TO db_shop;
 
insert into db_shop VALUES('0','小明','男','18888888888','中国北京','588888','2018-07-20');

select *FROM tb_book;

UPDATE db_shop SET nam="张三" WHERE id='1'
delete from db_shop where id='10'

CREATE TABLE tb_affiache(
id INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(200) NOT NULL,
content TEXT NOT NULL,
createtime DATETIME NOT NULL
)

select count(*) as total from tb_affiche order by id Desc

select * from tb_affiche order by id desc limit 0,3;

select*from tb_affiche 

use db_books;
create table tb_insert(
id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
name varchar(10) NOT NULL,
number int NOT NULL,
phone int(11) NOT NULL,
address text NOT NULL
)
//创建数据库
create DATABASE db_databass
DROP DATABASE  db_databass
CREATE DATABASE IF NOT EXISTS db_database DEFAULT CHARSET utf8 COLLATE utf8_general_ci;
//创建新表
create TABLE tb_pdo_mysql(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
pdo_type varchar(10) NOT NULL,
database_name varchar(50) NOT NULL,
dates datetime NOT NULL 
)

insert into tb_pdo_mysql pdo_type,database_name,dates pdo,Oracle,2018-08-06 11:27:25;

drop procedure if exists pro_reg;//
edlimiter
create procedure pro_reg(in name varchar(15),in pwd varchar(15),in email varchar(20),in addre text)
begin
insert into tb_pdo_mysql1(name,pwd,email,addre)values(name,pwd,email,addre);
end;

drop procedure if exists pro_reg;
delimiter//
create procedure pro_reg(in nc varchar(80),in pwd varchar(80), in email varchar(80),in address varchar(50))
begin
insert into tb_reg(name,pwd,email,address)values(nc,pwd,email,address);
end;
//

SELECT count(*) as total from tb_pdo_mysql1

select count(*) as total from tb_pdo_mysql
use db_books;

SHOW INDEX FROM tb_insert;
create INDEX indexname ON tb_insert(name(10));
alter table tb_insert ADD index phone()
DROP index indexname on tb_insert


ALTER TABLE tb_insert ADD FULLTEXT index_name()

SHOW INDEX FROM tb_insert;

create table tb_class(
 name varchar(10) NOT NULL primary key,
 class int NOT NULL,
 date date NOT NULL
)
drop table banji
create table banji(
       id int auto_INCREMENT primary KEY,
       hanjihao varchar(10) unique key comment'班好',
       banzhuren varchar(10) comment '班主任',
       open_date date comment'日期'
)
create table xuesheng(
       id int  auto_INCREMENT primary KEY,
       
       name varchar(10),
       age tinyint,
       banji_id int,
       foreign key (banji_id) references banji(id)
)

select version()//版本选择

create table tab_xuanxiang(
 id int auto_increment primary key,
 name varchar(10),
 age tinyint
)
charset= gbk,
engine=myIsam,
auto_increment=1000,
comment='说明文字';

insert tab_xuanxiang(id,name,age)values(null,'李四',18)
select *from tab_xuanxiang

alter table tab_xuanxiang add sex tinyint



 
use db_database
drop table load_data
create table load_data(
 id int not null auto_increment primary key,
 userid varchar(20),
 UserPwd varchar(20) not null,
 UserName varchar(10) not null,
 Gender tinyint not null,
 Email varchar(30) ,
 UserAddress varchar(30) not null,
 Phone varchar(15) not null
)

load data infile 'H:/E_market.txt' into table load_data

select *from load_data
delete from load_data where id=23 

show variables like '%secure%';

select *from load_data where id  in (1,23,3,2)

SELECT  'userid' as '用户名' ，'UserAddress' as '地址' FROM load_data group by id asc

select UserAddress, count(*) as 数量 from load_data group by UserAddress

use db_database

create table product(
id int not null auto_increment primary key,
pro_name varchar(30),
pro_type varchar(10),
pro_price varchar(10),
pro_brand varchar(10),
pro_address varchar(10)

)

use db_database
drop table deepcate
create table deepcate(
       id int not null auto_increment primary key,
       pid  int(11) not null,
       catename varchar(30) not null,
       cateorder int(10) unsigned not null DEFAULT '0',
       createtime int(10) not null
)ENGINE=InnoDB AUTO_INCREMENT=11 default charset=utf8 comment='分类表';

INSERT INTO `deepcate` ( `pid`, `catename`, `cateorder`, `createtime`) VALUES
( 3, '北京新闻', 0, 0),
( 4, '美国新闻', 0, 0),
( 2, '美女图片', 0, 0),
(2, '风景图片', 0, 0),
( 7, '欧美明星', 0, 0),
( 9, '英国电影', 0, 0),
( 10, '英国电影', 0, 0),
( 6, '英国电影', 0, 0)

create database db_compary
DROP database db_compary
CREATE DATABASE IF NOT EXISTS db_compary DEFAULT CHARSET utf8 COLLATE utf8_general_ci;

use db_compary
create table user(
id int not null AUTO_INCREMENT,
username varchar(10) NOT null,
password varchar(30) not null,
lasttime datetime not null,
createtime datetime not null,
counname int,
PRIMARY KEY (id)
)DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci

create table about(
id int not null AUTO_INCREMENT,
title varchar(30) not null,
content varchar(300) not null,
createtime datetime,
PRIMARY key(id)
)DEFAULT CHARacter SET utf8 COLLATE utf8_general_ci

create table contact(
id int  not null AUTO_increment,
site varvahr(30) not null,
tel varchar(15) not null,
suppot varchar(15) not null
)









