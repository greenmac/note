<?php
include_once('link.php');
header("Content-Type:text/html; charset=utf-8");

##db連結
class db{

    public $host = 'localhost';
    public $username = 'root';
    public $database = 'email';
    public $password = 'Z5hidXkqdTYCyDPH';

    function __construct(){
        $this->sql_connect();
        $this->sql_database();
        $this->set_db_encode();
    }

    function sql_connect(){
        return @mysql_connect($this->host,$this->username,$this->password);
    }

    function sql_database(){
        return @mysql_select_db($this->database);
    }

    function set_db_encode(){
        return mysql_query("SET NAMES 'utf8'");
    }

}

##print_r
function pre($pre) {
  echo '<pre>';
  print_r($pre);
  echo '</pre>';
}

##用function刪除,相同功能寫一次後呼叫出
class demo
{
  function r_nidDe($table,$r_nid,$link)
  {
    $sql="DELETE from $table where r_nid in ($r_nid)";
    $sqlResult=$link->prepare($sql);
    $sqlResult->execute();
    pre($sql);
  }
}
$demo=new demo;
$demo->r_nidDe('race_name','150,151,166',$link);
$demo->r_nidDe('race','150,151,166',$link);
$demo->r_nidDe('site','150,151,166',$link);
$demo->r_nidDe('grouping','150,151,166',$link);

##陣列重新排序(升序)
$numbers = array(4, 6, 2, 22, 11);
sort($numbers);
echo $numbers[0];
?>
