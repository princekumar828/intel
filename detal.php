<?php
 $conn=new mysqli('localhost','root','','news');
 if($conn->connect_error){
  echo "connection failed";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <style>
  .mainImg{
    width: 500px;
    height: 500px;
    margin: auto;
  }
   </style>
</head>
<body>
<?php

    if(isset($_GET['news'])){
      $id=$_GET['news'];
      $sql="SELECT `id`, `heading`, `img`, `discription`, `time` FROM `allNews` WHERE `id`='$id'";
      $result=$conn->query($sql);
      $row=$result->fetch_assoc();
      echo '<img src="'. $row['img'] .'" alt="" class="mainImg">';
      echo '<h3 class="mainheading">'. $row['heading'] .'</h3>';
      echo ' <p class="allDis">  '. $row['discription'] .' </p>';
    }
    conn->close();
?>
</body>
</html>