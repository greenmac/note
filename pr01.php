<?php
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
include($phpbb_root_path.'inc/common.php');
include_once('link.php');
include_once('function.php');
// ini_set('memory_limit', '1024M'); // or you could use 1G
$date1 = mktime(0,0,0,1,1,2017);
$date2 = mktime(0,0,0,13,11,2017);
$rand_time = rand($date1,$date2);
echo "隨機日期數字型態:".$rand_time."<br>";
$rtime = date("Y-m-d H:i:s",$rand_time);
echo "隨機日期:".$rtime."<br>";
echo "隨機日期strotime:".strtotime($rtime)."<br>";
echo "<hr>";

$start_time=mktime(0,0,0,1,1,2017);
$start_time2=date("Y-m-d H:i:s",$start_time);
$end_time=strtotime(date("2017-03-31 23:59:59"));
$end_time2=date("Y-m-d H:i:s",$end_time);
echo "start_time:".$start_time."<br>";
echo "start_time:".$start_time2."<br>";
echo "end_time:".$end_time."<br>";
echo "end_time:".$end_time2."<br>";
echo "<hr>";

#隨機10位數亂數
//$rand_m=rand(0,9);
//echo $rand_m."<br>";
$card_num_lenth = 10;//字串長度
$card_num = "";
$word = "0123456789";
for($i=0;$i<$card_num_lenth;$i++){
  $card_num .=$word[rand() % $card_num_lenth];
}
echo "隨機10位數亂數".$card_num."<br>";
echo"<hr>";

#隨機亂數'字串'+'數字'
$actiontype_c=rand(1,3);
$actiontype_c="c"."$actiontype_c";
echo "actiontype_c:".$actiontype_c."<br>";
echo"///////////"."<br>";

#隨機亂數'字串'+'數字'
$actiontype_e=rand(1,8);
$actiontype_e="e"."$actiontype_e";
echo "actiontype_e:".$actiontype_e."<br>";
echo"///////////"."<br>";

#隨機亂數'字串'+'數字'
$actiontype_v=rand(1,5);
$actiontype_v="v"."$actiontype_v";
echo "actiontype_v:".$actiontype_v."<br>";
echo"///////////"."<br>";

#隨機字串,選擇一個(用變數,不是預設陣列)
$actiontype=array($actiontype_c,$actiontype_e,$actiontype_v);
$random_keys= (int) array_rand($actiontype,1);#只會找出key值
$get_random_values=$actiontype[$random_keys];
echo "a++get_random_values:".$get_random_values."<br>";
echo"<hr>";

#隨機字串,選擇一個(不用變數,是預設陣列)
$actiontype=array('c1','c2','c3','e1','e2','e3','e4','e5','e6','e7','e8','v1','v2','v3','v4','v5');
$random_keys=(int) array_rand($actiontype,1);#只會找出key值
$actiontype_radom_values=$actiontype[$random_keys];#利用key值,顯示value值
echo "b++get_random_values:".$actiontype_radom_values."<br>";
echo"<hr>";

#unixtime轉換
$nowtime = date("Y-m-d H:i:s");
echo "現在時間:".$nowtime."<br>";
$time = strtotime($nowtime);
echo "現在時間strtotime:".$time."<br>";
echo"<hr>";

#隨機亂數
$category=rand(1,20);
echo "category:".$category."<br>";
echo "<hr>";

#隨機亂數,指定長度(10)
$order_no_lenth=10;//字串長度
$order_no="";
$word="0123456789";
for($y=0;$y<$order_no_lenth;$y++){
  $order_no .=$word[rand() % $order_no_lenth];
}
echo "order_num:".$order_no;
echo "<hr>";

#隨機亂數,指定長度(10),使用function
function Random_num($x)
{
  $Random_num_lenth=10;
  $Random_num="";
  $Random_word="0123456789";
  for($i=0;$i<$Random_num_lenth;$i++)
  {
    $Random_num .=$Random_word[rand() % $Random_num_lenth];
  }
  echo $x.$Random_num."<br>";
}
Random_num('a+++');
Random_num('b+++');
echo "<hr>";

#指定亂數,某個區間
$sku='a'.rand(1001,2000);
echo 'sku:'.$sku;
echo "<hr>";

##隨機$countrycode(隨機字串,自訂陣列)
$countryarray=array('TW','CA','AI','EG');
$countryrand=array_rand($countryarray,1);#只會找出key值
$countrycode=$countryarray[$countryrand]."<br>";#利用key值,顯示value值
echo 'countrycode='.$countrycode;
echo "<hr>";

##隨機$countrycode(隨機字串,自訂陣列)
$a=array("red","green","blue","yellow","brown");
$random_keys=(int) array_rand($a,1);#只會找出key值
echo $a[$random_keys]."<br>";#利用key值,顯示value值
echo $a[$random_keys]."<br>";#利用key值,顯示value值
echo $a[$random_keys]."<br>";#利用key值,顯示value值
echo"<hr>";
?>
