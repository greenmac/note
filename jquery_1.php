<script>
function chioceClick(partidpid,t)
{
  //map
  var sel = $("input:checkbox:checked").map(function()
  {
    //attr
    return $(this).attr('class');
  }).get();

  if(partidpid)
  {
    $.ajax(
    {
      type: "POST",
      url: 'jquery_ajax.php',
      cache: false,
      data:
      {
        'pid':sel.join(','),
        'partidpid':partidpid,
        'r_nid':<?php echo $r_nid;?>,
        'c_status':<?php echo $c_status;?>,
        'chioce':1,
      },
      error: function()
      {
        alert('Ajax request 發生錯誤');
      },
      success: function(ddd)
      {
        // console.log(ddd);return;
        var data2obj=$.parseJSON($.trim(ddd));
        if(data2obj.chioceMessage=="have")
        {
          $('#status'+t).attr('checked',false);
          alert('此球員已重複報名，請與此球員聯繫確認');
          return;
        }
      }
    })
  }
}

  if(partidpid)
  {
    $.ajax(
    {
      type: "POST",
      url: 'jquery_ajax.php',
      cache: false,
      data:
      {
        'pid':sel.join(','),
        'partidpid':partidpid,
        'r_nid':<?php echo $r_nid;?>,
        'c_status':<?php echo $c_status;?>,
        'chioce':1,
      },
      error: function()
      {
        alert('Ajax request 發生錯誤');
      },
      success: function(ddd)
      {
        // console.log(ddd);return;
        var data2obj=$.parseJSON($.trim(ddd));
        if(data2obj.chioceMessage=="have")
        {
          $('#status'+t).attr('checked',false);
          alert('此球員已重複報名，請與此球員聯繫確認');
          return;
        }
      }
    })
  }
}

function Chk_status(){
  alert('身分證確認');
}

  $().ready(function()
  {
    $('#addsend').click(function()
    {
      let sel='';
      //each
      const status=$('input[name="status"]:checked').each(function(i,v)
      {
        sel+=$(this).attr("class")+',';
        // console.log(i);return;
        //console.log(v);return;
        //console.log($(this).attr("class"));
      });
      // console.log(sel);

      $.ajax(
      {
        url: "appoint_list_ajax.php",
        type:"post",
        datatype:"json",
        data:
        {
          "mid":<?php echo $mid;?>,
          "tid":<?php echo $tid;?>,
          "r_nid":<?php echo $r_nid;?>,
          "c_status":<?php echo $c_status;?>,
          "pid":sel,
          'chioce':2,
        },
        error:function(xhr, status, error)
        {
          const err = eval("(" + xhr.responseText + ")");
          alert(err.Message);
          alert(data);return;
          //alert("指派失敗");
        },
        success: function(data)
        {
          // console.log(data);return;
          var dataobj=$.parseJSON($.trim(data));
          switch(dataobj.factor)
          {
            case 1:
              alert("指派球員不滿7人");
              return;
              break;
            case 2:
              alert("指派球員超過10人");
              return;
              break;
            case 3:
              alert("指派球員成功");
              window.location='appoint_index.php?<?php echo 'm_id='.$m_id.'&mid='.$mid.'&r_nid='.$r_nid.'&rid='.$rid.'&tid='.$tid.'&c_status='.$c_status.'&connect_tid='.$connect_tid.'&gid='.$gid;?>';
              break;
            case 4:
              alert("新指派球員超出決賽替換球員數\n請保留預賽球員最低7人\n");
              return;
            default:
              return;
          }
        }
      });
    })
  })
</script>
