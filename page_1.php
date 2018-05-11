<?php
include_once(dirname(dirname(__FILE__)).'/link.php');
include_once(dirname(dirname(__FILE__)).'/function.php');
header("Content-Type:text/html; charset=utf-8");

$c_status=isset($_GET['c_status'])&&trim($_GET['c_status'])?trim($_GET['c_status']):1;
$kind=!empty($_GET['kind'])&&trim($_GET['kind'])?trim($_GET['kind']):0;
$t_status=!empty($_GET['t_status'])&&trim($_GET['t_status'])?trim($_GET['t_status']):0;

if(empty($kind))
{
  $race_nameSql="SELECT
  race_name.r_nid,
  race_name.appmaker_name,
  race_name.name,
  race_name.sku,
  race_name.status,
  race.rid,
  race.r_nid,
  race.sid,
  race.status,
  race.kind,
  race.race_date,
  race.gid,
  race.begin_date,
  race.begin_hour,
  race.begin_minutes,
  race.final_date,
  race.final_hour,
  race.final_minutes,
  race.note,
  race.start_time
  FROM
  (
    SELECT *
    FROM race
    WHERE status=$c_status
    group by r_nid
    order by rid desc
  )race
  inner join race_name
  on race.r_nid=race_name.r_nid
  order by race_name.r_nid desc";
}
elseif(!empty($kind))
{
  $c_status=0;
  $race_nameSql="SELECT
  race_name.r_nid,
  race_name.appmaker_name,
  race_name.name,
  race_name.sku,
  race_name.status,
  race.rid,
  race.r_nid,
  race.sid,
  race.status,
  race.kind,
  race.race_date,
  race.gid,
  race.begin_date,
  race.begin_hour,
  race.begin_minutes,
  race.final_date,
  race.final_hour,
  race.final_minutes,
  race.note,
  race.start_time,
  race.end_time
  FROM
  (
    SELECT *
    FROM race
    WHERE status=$c_status and kind=$kind
    group by r_nid
  )race
  inner join race_name
  on race.r_nid=race_name.r_nid
  order by race.end_time desc";
}
// pre($race_nameSql);exit;
$race_nameSqlResult=$link->prepare($race_nameSql);
$race_nameSqlResult->execute();
$race_nameSqlRows=$race_nameSqlResult->fetchall();

$race_nameSqlNums=$race_nameSqlResult->rowcount();
$race_nameSqlPer=10;//每頁呈現幾筆
$race_nameSqlPages=ceil($race_nameSqlNums/$race_nameSqlPer);//(總筆數/每頁呈現幾筆),會出現幾頁
$race_nameSqlPage=!isset($_GET['race_nameSqlPage'])?1:(int)$_GET['race_nameSqlPage'];//取get值
$race_nameSqlStart=($race_nameSqlPage-1)*$race_nameSqlPer;//每頁從陣列['0']開始顯示
$race_nameSqlRange=10;//每頁顯示的頁碼數
$start = (int)(($race_nameSqlPage-1) / $race_nameSqlRange) * $race_nameSqlRange + 1;  //$start是設定顯示每頁頁碼的開始值
$end = $start + $race_nameSqlRange -1;  //$end是設定顯示每頁頁碼的結束值
$race_nameSql.=" LIMIT $race_nameSqlStart,$race_nameSqlPer";//陣列['0']開始顯示,呈現幾筆
$race_nameSqlResult=$link->prepare($race_nameSql);
$race_nameSqlResult->execute();
$race_nameSqlRows=$race_nameSqlResult->fetchall();
// pre($race_nameSqlRows);exit;
?>
<?php
  echo $race_nameSqlPage==1?'':'<li><a href=?c_status='.$c_status.'&kind='.$kind.'&t_status='.$t_status.'&race_nameSqlPage=1>首頁</i></a></li>'.'　';
  echo $race_nameSqlPage==1?'':'<li><a href=?c_status='.$c_status.'&kind='.$kind.'&t_status='.$t_status.'&race_nameSqlPage='.($race_nameSqlPage-1).'><i class="fa fa-chevron-left"></i></a></li>'.'　';//上一頁
  if($race_nameSqlPages <= $race_nameSqlRange)
  { //開始輸出頁碼
    for($i=1;$i<=$race_nameSqlPages;$i++)
    {
      echo $i==$race_nameSqlPage ? '<li class="active"><a>'.$i.'</a></li>':'<li><a href="?c_status='.$c_status.'&kind='.$kind.'&t_status='.$t_status.'&race_nameSqlPage='.$i.'">'.$i.'</a></li>';//當前顯示頁不會有連結,且放大
    }
  }
  else
  { //如果總頁數大於每頁要顯示的頁碼數
    //如果目前的頁數大於5，預設定為第6頁開始，每頁的頁碼就往前移動1位  ex 目前的頁數為第6頁，所以輸出 2 3 4 5 6 7 8 9 10 11，如果是第7頁就輸出 3 4 5 6 7 8 9 10 11 12，依此類推
    if($race_nameSqlPage > 5)
    {
      $end = $race_nameSqlPage+5;  //每頁結尾的頁碼就+5
      if ($end > $race_nameSqlPages)
      {  //如果每頁結尾的頁碼大於總頁數
        $end = $race_nameSqlPages;  //就將每頁結尾的頁碼改寫為最後一頁
      }
      $start = $end-9;  //將每頁開頭的頁碼設為結尾的頁碼-9
      //開始輸出頁碼
      for($i=$start; $i<=$end; $i++)
      { //在目前頁數裡本身頁數的頁碼就不要連結，如果不是就加上連結
        echo $i==$race_nameSqlPage ? '<li class="active"><a>'.$i.'</a></li>':'<li><a href="?c_status='.$c_status.'&kind='.$kind.'&t_status='.$t_status.'&race_nameSqlPage='.$i.'">'.$i.'</a></li>';//當前顯示頁不會有連結,且放大
      }
    }
    else
    { //如果目前的頁數小於5
      if ($end > $race_nameSqlPages)
      { //如果每頁結尾的頁碼大於總頁數
        $end = $race_nameSqlPages;  //就將每頁結尾的頁碼改寫為最後一頁
      }
      //開始輸出頁碼
      for($i=$start; $i<=$end; $i++)
      { //在目前頁數裡本身頁數的頁碼就不要連結，如果不是就加上連結
        echo $i==$race_nameSqlPage ? '<li class="active"><a>'.$i.'</a></li>':'<li><a href="?c_status='.$c_status.'&kind='.$kind.'&t_status='.$t_status.'&race_nameSqlPage='.$i.'">'.$i.'</a></li>';//當前顯示頁不會有連結,且放大
      }
    }
  }
  echo $race_nameSqlPage==$race_nameSqlPages?'':'　'.'<li><a href=?c_status='.$c_status.'&kind='.$kind.'&t_status='.$t_status.'&race_nameSqlPage='.($race_nameSqlPage+1).'><i class="fa fa-chevron-right"></i></a></li>';//下一頁
  echo $race_nameSqlPage==$race_nameSqlPages?'':'　'.'<li><a href=?c_status='.$c_status.'&kind='.$kind.'&t_status='.$t_status.'&race_nameSqlPage='.$race_nameSqlPages.'>末頁</i></a></li>';
  echo '<li><a>共'.$race_nameSqlPages.'頁</a></li>';  //顯示目前總頁數
  echo '<li><a>共'.$race_nameSqlNums.'筆</a></li>'; //顯示總筆數
?>
