<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>Friends_interface</title>

    <link rel="stylesheet" href="css/bootstrap.css">
        
  <script type="text/javascript">
  function reply_click(clicked_id)
  {
      alert(clicked_id);
  }
</script>

</head>

<body>
<?php
$index = array();
$index[0] = 0 ;
$index[1] =1;
$index[2] = 2;
?>


<button id=<?php $index[0] ?> onClick="reply_click(this.id)">B1</button>
<button id=<?php $index[1] ?> onClick="reply_click(this.id)">B2</button>
<button id=<?php $index[2] ?> onClick="reply_click(this.id)">B3</button>


</body>
</html>