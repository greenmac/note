<html>
<head>
  <script src="https://code.jquery.com/jquery-3.3.0.js"></script>
  <script>
    $(document).ready(function(){
      $("#btn1").click(function(){
        $("p").append(function(n){
          return "<b>This p element has index " + n + "</b>";
        });
      });


     //set the default value
     var txtId = 1;
     //add input block in showBlock
     $("#btn2").click(function () {
         $("#showBlock").append('<div id="div' + txtId + '">Input:<input type="text" name="test[]" /> <input type="button" value="del" onclick="deltxt('+txtId+')"></div>');
         txtId++;
     });
   });
   //remove div
   function deltxt(id) {
       $("#div"+id).remove();
   }

  </script>
</head>
<body>
  <div id="showBlock"></div>
  <input id="btn2" type="button" name="" value="addItem">
  <h1>This is a heading</h1>
  <p>This is a paragraph.</p>
  <p>This is another paragraph.</p>
  <input id="btn1" type="button" name="" value="在每个 p 元素的结尾添加内容">
</body>
</html>
