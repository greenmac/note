<?php
include_once(dirname(dirname(__FILE__)).'/link.php');
include_once(dirname(dirname(__FILE__)).'/function.php');
header("Content-Type:text/html; charset=utf-8");
//配合資料庫使用的分頁功能
//先判斷是否有收到$page的值
//$page 是記錄目前的頁數
if(isset($_GET['page']))
{
  $page = $_GET['page'];  //有收到就使用收到的值
}
else
{
  $page = 1;  //沒有收到就設為1，從第1頁開始
}

// include("xxx.php");  //引進資料庫連結檔案

$num = 10;  //設定每頁要顯示幾筆資料，ex 10筆
$pagenum = 10;  //設定每頁要顯示的頁碼數 ex 10個
$limit_start = ($page-1)*$num;  //$limit_start是設定每一頁要顯示資料的開始值
$start = (int)(($page-1) / $pagenum) * $pagenum + 1;  //$start是設定顯示每頁頁碼的開始值
$end = $start + $pagenum -1;  //$end是設定顯示每頁頁碼的結束值
$next = $page+1;  //下一頁
$pre = $page-1;  //上一頁

//先進行一次搜尋
$sql = "SELECT * FROM connect ORDER BY cid DESC";
$result = $link->prepare($sql);
$result -> execute();
$total = $result -> rowcount();  //取出要顯示的資料總筆數
$pages = ceil($total / $num);  //設定總頁數，全部資料/每頁要顯示幾筆資料

//再次進行搜尋
//這次在LIMIT的值放上$limit_start , $num 分別是每頁要顯示的資料的開頭與結尾
$sql = "SELECT * FROM connect ORDER BY cid DESC LIMIT $limit_start , $num";
$result -> execute();
$total = $result -> rowcount();  //取出要顯示的資料總筆數

//輸出分頁導覽列
echo "<td>" . $total . "</td>(顯示資料的總筆數)<br>";  //顯示資料的總筆數
echo "<td>" . $page . " / " . $pages . "</td>(顯示目前頁數/總頁數)<br>";   //顯示目前頁數/總頁數

//判斷目前的頁數是否是第一頁
//大於第一頁就顯示第一頁和上一頁
if($page > 1)
{
  echo '<td><a href="test04.php?page=1">第一頁</a></td>';
  echo "<td><a href=\"test04.php?page=" . $pre . "\">上一頁</a></td>";
}

//判斷總頁數是否小於等於每頁要顯示的頁碼數
//小於等於的話就只要顯示出第一頁到最後一頁的全部頁碼
if($pages <= $pagenum)
{ //開始輸出頁碼
  for($i=$start; $i<=$pages; $i++)
  { //在目前頁數裡本身頁數的頁碼就不要連結，如果不是就加上連結
    if($i == $page)
    {
      echo "<td> " . $i . " </td>";
    }
    else
    {
      echo "<td > <a href=\"test04.php?page=" . $i ."\">" . $i . "</a> </td>";
    }
  }
}
else
{ //如果總頁數大於每頁要顯示的頁碼數
  //如果目前的頁數大於5，預設定為第6頁開始，每頁的頁碼就往前移動1位  ex 目前的頁數為第6頁，所以輸出 2 3 4 5 6 7 8 9 10 11，如果是第7頁就輸出 3 4 5 6 7 8 9 10 11 12，依此類推
  if($page > 5)
  {
    $end = $page+5;  //每頁結尾的頁碼就+5
    if ($end > $pages)
    {  //如果每頁結尾的頁碼大於總頁數
      $end = $pages;  //就將每頁結尾的頁碼改寫為最後一頁
    }
    $start = $end-9;  //將每頁開頭的頁碼設為結尾的頁碼-9
    //開始輸出頁碼
    for($i=$start; $i<=$end; $i++)
    { //在目前頁數裡本身頁數的頁碼就不要連結，如果不是就加上連結
      if($i == $page)
      {
        echo "<td> " . $i . " </td>";
      }
      else
      {
        echo "<td> <a href=\"test04.php?page=" . $i ."\">" . $i . "</a> </td>";
      }
    }
  }
  else
  { //如果目前的頁數小於5
    if ($end > $pages)
    { //如果每頁結尾的頁碼大於總頁數
      $end = $pages;  //就將每頁結尾的頁碼改寫為最後一頁
    }
    //開始輸出頁碼
    for($i=$start; $i<=$end; $i++)
    { //在目前頁數裡本身頁數的頁碼就不要連結，如果不是就加上連結
      if($i == $page)
      {
        echo "<td> " . $i . " </td>";
      }
      else
      {
        echo "<td> <a href=\"test04.php?page=" . $i ."\">" . $i . "</a> </td>";
      }
    }
  }
}

//頁碼輸出結束
//判斷目前的頁數是否是最末頁
//小於最末頁就顯示下一頁和最末頁
if($page < $pages)
{
  echo "<td><a href=\"test04.php?page=" . $next . "\">下一頁</a></td>";
  echo "<td><a href=\"test04.php?page=" . $pages . "\">最末頁</a></td>";
}
//分頁導覽列輸出結束
?>
