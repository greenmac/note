<?php
##有加郵遞區號連動的可在<guestbook-index.php>找到
?>
<div class="form-group">
    <label for="">通訊地址</label>
    <select class="form-control" id="smcid" name="smcid">
      <?php
        if(!empty($pid)&&trim($pid))
        {
          echo '<option value="">請選擇縣市</option>';
          foreach($sys_map_citySqlRows as $smc)
          {
            $factor=$playerSqlRows[0]['smcid']==$smc['smcid']?'selected':'';
            echo '<option value="'.$smc['smcid'].'"'.$factor.'>'.$smc['city'].'</option>';
          }
        }
        else
        {
          echo '<option value="">請選擇</option>';
        }
      ?>
    </select>
</div>
<div class="form-group">
    <select class="form-control" id="smaid" name="smaid">
      <?php
        if(!empty($pid)&&trim($pid))
        {
          echo '<option value="">請選擇鄉鎮市區</option>';
          foreach($sys_map_areaSqlRows as $sma)
          {
            $factor=$playerSqlRows[0]['smaid']==$sma['smaid']?'selected':'';
            echo '<option value="'.$sma['smaid'].'"'.$factor.'>'.$sma['area'].'</option>';
          }
        }
        else
        {
          echo '<option value="">請選擇</option>';
        }
      ?>
    </select>
</div>
<script>
  //區域連動
  $(document).ready(function()
  {
      //利用jQuery的ajax把縣市編號(CNo)傳到Town_ajax.php把相對應的區域名稱回傳後印到選擇區域(鄉鎮)下拉選單
      $('#smcid').change(function()
      {
          var CNo= $('#smcid').val();
          $.ajax(
          {
              type: "POST",
              url: 'player_update_city_ajax.php',
              cache: false,
              data:{'CNo':CNo},
              error: function(data)
              {
                // console.log(data);
                // return;
                  alert('Ajax request 發生錯誤');
              },
              success: function(data)
              {
                // alert(data);
                $('#smaid').html(data);
              }
          });
      });
  });
</script>
