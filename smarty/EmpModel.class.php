<?php
require_once 'SqlHelper.class.php';
class EmpModel{
	//从数据库中获取所有用户信息
	public function showEmpList(){		
		$sql="select * from emp";
		$sqlHelper=new SqlHelper;
		$arr=$sqlHelper->execute_dql2($sql);
	//	die($sql."1111000");
		$sqlHelper->close_connect();
		return $arr;
	}
}
?>
<!--
--创建一个数据库
create database smartytest;
use smartytest;
create table admin
( admid tinyint unsigned primary key, /*管理员id*/
  passwd char(32) not null, /*密码*/
  name varchar(64) not null);

create table emp
( empid int unsigned primary key auto_increment,
  name varchar(64) not null,
  passwd varchar(64) not null,
  email varchar(64) not null,
  grade tinyint default 1,
  sal float default 0);

--测试数据
set names gbk;
--set character_set_client=gbk;
--set character_set_results=gbk;
insert into emp (name, passwd, email, grade, sal) values('xiaoming1',md5('123'),'xiaoming@sohu.com',1,5000);
insert into admin values(100,md5('123'),'顺平');
select * from emp;
select * from admin;
desc admin;
set character_set_client=utf8;
set character_set_results=utf8;
select * from emp;
select * from admin;
desc admin;
-->