<script>
function addSend()
{
  // validate.手機號碼驗證
  jQuery.validator.addMethod("isMobile", function(value, element) {
      var length = value.length;
      var mobile = /^09[0-9]{2}[0-9]{6}$/;
      return this.optional(element) || (length == 10 && mobile.test(value));
  }, "請正確填寫您的手機");
  // validate.身分證驗證
  jQuery.validator.addMethod("isIdCardNo", function(value, element) {
      var length = value.length;
      var id_card = /^[A-Z]{1}[0-9]{1}[0-9]{8}$/;
      return this.optional(element) || (length == 10 && id_card.test(value));
  }, "請正確填寫您的身分證");
  //validate主要程式
  //$(document).ready(function()
  //{
  // 在键盘按下并释放及提交后验证提交表单
  var validform=$("#addform").validate(
    {
      rules:
         {
            name_player: "required",
            birth: {
              required: true,
              dateISO: true
            },
            id_card: {
              required: true,
              // isIdCardNo:true,
              // minlength: 10,
              // maxlength: 10
            },
            name_parents: "required",
            mobile: {
              required: true,
              isMobile:true,
              minlength: 10,
              maxlength: 10
            },
            // smcid: "required",
            // smaid: "required",
            // address: "required",
            // clothes_back_num: {
            //   required: true,
            //   digits: true,
            //   minlength: 1,
            //   maxlength: 2
            // },
            // clothes_size: "required"
         },
      messages:
        {
          name_player: "請輸入球員名字",
          birth: {
            required:"请输入球員出生年月日",
            dateISO: "請輸入正確格式YYYY/mm/dd"
          },
          id_card: {
            required: "請輸入身分證字號或護照號碼",
            // isIdCardNo:"例:A123456789",
            // minlength: "請符合身分證格式",
            // maxlength: "請符合身分證格式"
          },
          name_parents: "請輸入球員家長名字",
          mobile: {
            required: "請輸入手機號碼",
            isMobile: "請輸入09開頭的10碼號碼",
            minlength: "不可小於10碼",
            maxlength: "不可大於10碼"
          },
          // smcid: "請選擇縣市",
          // smaid: "請選擇鄉鎮市區",
          // address: "請輸入地址",
          // clothes_back_num: {
          //   required:"請輸入球員背號",
          //   digits:"請輸入數字",
          //   minlength: "不可小於1碼",
          //   maxlength: "不可大於2碼"
          // },
          // clothes_size: "請輸入球員球衣尺寸"
        }
   });
  //});
  var chkResult=validform.form();
  if (chkResult==true)
  {
    const link='player_update_ajax.php';
    const name_player=$('#name_player').val();
    const birth=$('#birth').val();
    const id_card=$('#id_card').val();
    const name_parents=$('#name_parents').val();
    const mobile=$('#mobile').val();
    const smcid=$('#smcid').val()?$('#smcid').val():0;
    const smaid=$('#smaid').val()?$('#smaid').val():0;
    const address=$('#address').val()?$('#address').val():0;
    const clothes_back_num=$('#clothes_back_num').val()?$('#clothes_back_num').val():0;
    const clothes_size=$('#clothes_size').val()?$('#clothes_size').val():0;

    $.ajax(
    {
      url: link,
      type:"post",
      cache: true,
      async:false,
      datatype:"json",
      data:
      {
        "pid":<?php echo $pid;?>,
        "name_player":name_player,
        "birth":birth,
        "id_card":id_card,
        "name_parents":name_parents,
        "mobile":mobile,
        "smcid":smcid,
        "smaid":smaid,
        "address":address,
        "clothes_back_num":clothes_back_num,
        "clothes_size":clothes_size
      },
      error:function(data)
      {
        alert("編輯失敗");
      },
      success:function(data)
      {
        // console.log(data);
        // return;
        var dataobj=$.parseJSON($.trim(data));
        if(dataobj.status=="success")
          {
            alert("編輯成功");
              window.location='player_index.php?<?php echo 'm_id='.$m_id.'&mid='.$mid;?>';
          }
      }
   });
  }
}
</script>
