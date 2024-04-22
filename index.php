<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


//delete Function
function deleteid($con,$pnum){
    $deleteq ="DELETE FROM `users` WHERE `phone`='$pnum'";
    $con->query($deleteq);
}


//Insert Function
function insert_data($conn){
  $name= $_POST['name'];
  $email= $_POST['email'];
  $phone= $_POST['phone'];
  $gender=$_POST['gender'];
  $password= $_POST['password'];

  $sql= "INSERT INTO `Users`(`name`, `gender`, `email`, `phone`, `password`) VALUES ('$name','$gender','$email','$phone','$password')";
  $conn->query($sql);
        
}


$conn= new mysqli('localhost','root','','user');
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
        if($_SERVER['REQUEST_METHOD']=='POST'){
            insert_data($conn);
        }
        elseif(isset($_GET['delete'])){
           $pnumber = $_GET['delete'];
           deleteid($conn,$pnumber);
        }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User data</title>
    <style>
        
        table{
            border: 2px solid blueviolet;
            border-collapse: collapse;
           width: 80%;
            margin: auto;
        }
        th,td{
            border: 2px solid blueviolet;
            padding: 10px;
        }
        th{
            background-color: blueviolet;
            color: white;
        }
        td{
            background-color: white;
            color: black;
        }
        button{
            border: none;
            width: 90%;
            height:32px;
            border-radius: 5px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            }
            .del{
                background-color: red;
            }
            .up{
                background-color: green;
            }

    </style>
   
</head>
<body>

    <table>
        <tr>
            <th>Name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>

        <?php

        $sqlGet= "SELECT * FROM `users`";
        $result=$conn->query($sqlGet);

        if($result->num_rows > 0 ){
            while($row=$result->fetch_assoc()){

              echo  "<tr>";
              echo  "<td>" . $row["name"] . "</td>";
              echo  "<td>" . $row["gender"] . "</td>";
              echo  "<td>" . $row["email"] . "</td>";
              echo  "<td>" . $row["phone"] . "</td>";
              echo  "<td>" . $row["password"] . "</td>";
              echo '<td><button class="del" id='.$row["phone"].' >Delete</button></td>';
              echo '<td><button class="up" >Update</button></td>';
              echo  "</tr>";   
            }

        }
        ?>

    </table>

    <script>

            let btnDel=document.getElementsByClassName("del");
            Array.from(btnDel).forEach(function(element){

            element.addEventListener('click',function(e){
                let s=element.id;
                if(confirm("Are you sure you want to delete this record?"))
                { 
                    window.location= `/learnphp/index.php?delete=${s}`;
                }
            });
            });
    </script>
    
</body>
</html>