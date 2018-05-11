<script>
field_Chk();
var race_name=$("#race_name").val();
var sku=$("#sku").val();
var alertMsg="";

if(!race_name){alert("請填寫盃賽名稱"); $("#race_name").focus(); return;}
if(!sku){alert("請填寫SKU料號"); $("#sku").focus();return;}
if($('input[name="site_check[]"]:checked').length==0){alert('請先選擇場區');return;}

<?php
foreach($siteSqlRows as $sK2=>$sV2)
{
?>
$('input[id="<?php echo !empty($sV2['place'])?$sV2['place']:'';?>"]:checked').each(function(i,v)
{
  var siteName=$(this).attr('id');
  if($('textarea[id="race_date<?php echo $sK2?>"]').val()=="")
  {
    alertMsg+="【場區:"+siteName+"】請填寫比賽日期\n";
    return;
  }

  if($('input[id="gid<?php echo $sK2;?>"]').is(':checked')==false)
  {
    alertMsg+="【場區:"+siteName+"】請選擇年齡分組\n";
    return;
  }

  if($('input[id="begin_date<?php echo $sK2;?>"]').val()=="")
  {
    alertMsg+="【場區:"+siteName+"】請設定盃賽開始日期\n";
    return;
  }

  if($('input[id="begin_hour<?php echo $sK2;?>"]').val()=="")
  {
    alertMsg+="【場區:"+siteName+"】請設定盃賽開始時間(時)\n";
    return;
  }

  if($('input[id="begin_minutes<?php echo $sK2;?>"]').val()=="")
  {
    alertMsg+="【場區:"+siteName+"】請設定盃賽開始時間(分)\n";
    return;
  }

  if($('input[id="final_date<?php echo $sK2;?>"]').val()=="")
  {
    alertMsg+="【場區:"+siteName+"】請設定盃賽結束日期\n";
    return;
  }

  if($('input[id="final_hour<?php echo $sK2;?>"]').val()=="")
  {
    alertMsg+="【場區:"+siteName+"】請設定盃賽結束時間(時)\n";
    return;
  }

  if($('input[id="final_minutes<?php echo $sK2;?>"]').val()=="")
  {
    alertMsg+="【場區:"+siteName+"】請設定盃賽結束時間(分)\n";
    return;
  }

  // if($('textarea[id="note<?php //echo $sK2;?>"]').val()=="")
  // {
  //   alertMsg+="【場區:"+siteName+"】請填寫注意事項\n";
  //   return;
  // }
});

/*2018/04/26隱藏,舊的
$('input[name="site_check[]"]:checked').each(function(i,v)
{
  var siteName=$(this).attr('id');
  if($('textarea[name="apply['+i+'][race_date]"]').val()=="")
  {
    alertMsg+="【場區:"+siteName+"】請填寫比賽日期\n";
    return;
  }

  if($('input[name="apply['+i+'][gid][check][]"]').is(':checked')==false)
  {
    alertMsg+="【場區:"+siteName+"】請選擇年齡分組\n";
    return;
  }

  if($('input[name="apply['+i+'][begin_date]"]').val()=="")
  {
    alertMsg+="【場區:"+siteName+"】請設定盃賽開始時間\n";
    return;
  }

  if($('input[name="apply['+i+'][final_date]"]').val()=="")
  {
    alertMsg+="【場區:"+siteName+"】請設定盃賽結束時間\n";
    return;
  }
});
*/

<?php
}
?>
</script>
