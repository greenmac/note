<?php
##增加欄位
$sql="ALTER TABLE connect ADD COLUMN kind INT(10) DEFAULT 1 AFTER status";

##增加新資料表
$new_table="connect_finals";
$creat_table=
"CREATE table if not exists $new_table
(
  c_fid int(10) unsigned auto_increment PRIMARY KEY,
  mid INT(10) NOT NULL DEFAULT '0',
  tid INT(10) NOT NULL DEFAULT '0',
  rid INT(10) NOT NULL DEFAULT '0',
  r_nid INT(10) NOT NULL DEFAULT '0',
  sid INT(10) NOT NULL DEFAULT '0',
  gid INT(10) NOT NULL DEFAULT '0',
  status INT(10) NOT NULL DEFAULT '0',
  calculate INT(10) NOT NULL DEFAULT '0',
  team_name varchar(50) not null DEFAULT 'NULL',
  leader_name varchar(50) not null DEFAULT 'NULL',
  leader_mobile varchar(50) not null DEFAULT 'NULL',
  leader_email varchar(50) not null DEFAULT 'NULL',
  coach_name varchar(50) not null DEFAULT 'NULL',
  coach_mobile varchar(50) not null DEFAULT 'NULL',
  coach_email varchar(50) not null DEFAULT 'NULL',
  supervise_name varchar(50) not null DEFAULT 'NULL',
  supervise_mobile varchar(50) not null DEFAULT 'NULL',
  supervise_email varchar(50) not null DEFAULT 'NULL',
  start_time datetime,
  end_time datetime DEFAULT CURRENT_TIMESTAMP
)";
$creat_tableResult=$link->prepare($creat_table);
$creat_tableResult->execute();
pre($creat_table);

##有逗號可以直接分隔出來的語法
$raceSql=
"SELECT race.rid,race.race_name,race.sku,race.sid,race.status,race.race_date,
SUBSTRING_INDEX(SUBSTRING_INDEX(race.gid, ',', numbers.n), ',', -1) gid,
race.begin_date,race.begin_hour,race.begin_minutes,race.final_date,race.final_hour,race.final_minutes,race.note,race.start_time,race.end_time
FROM
(
SELECT 1 n
    UNION ALL
SELECT 2
    UNION ALL
SELECT 3
    UNION ALL
SELECT 4
) numbers
INNER JOIN race ON CHAR_LENGTH(race.gid)-CHAR_LENGTH(REPLACE(race.gid, ',', ''))>=numbers.n-1
order by rid,gid";
$raceSqlResult=$link->prepare($raceSql);
$raceSqlResult->execute();
$raceSqlRows=$raceSqlResult->fetchall();

foreach($raceSqlRows as $raceSqlRows) {
  echo pre($raceSqlRows);
}

##update_select
$ticketSqlUpdate=
"UPDATE ticket as ticket,
(
  select * from race_name
) as race_name
set ticket.r_nid=race_name.r_nid
where ticket.sku=race_name.sku
";
$ticketSqlUpdateResult=$link->prepare($ticketSqlUpdate);
$ticketSqlUpdateResult->execute();

##insert into_select
$connect_finalsInsert=
"INSERT INTO connect(mid,tid,rid,r_nid,sid,gid,status,kind,calculate,team_name,leader_name,leader_mobile,leader_email,coach_name,coach_mobile,coach_email,supervise_name,supervise_mobile,supervise_email,start_time)
SELECT mid,tid,'$rid',r_nid,'$sid',gid,2,2,'$calculate',team_name,leader_name,leader_mobile,leader_email,coach_name,coach_mobile,coach_email,supervise_name,supervise_mobile,supervise_email,'$start_time' from connect
where cid=$cid
";
?>
