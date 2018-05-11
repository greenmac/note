<?php
$db_host='localhost';
$db_name='minisoccer';
$db_user='minisoccer';
$db_pass='sgiErsWn893b';

$link=new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8",$db_user,$db_pass);
$link->query("set names 'utf8'");
$better_sql_defaults=array("set SESSION sql_mode ='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");
$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
foreach ($better_sql_defaults as $sql){
	$link->query($sql);
}

date_default_timezone_set('Asia/Taipei');
session_start();
 ?>
