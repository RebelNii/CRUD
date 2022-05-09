<?php
//connect to Database
require_once("./conn.php");

//Logic
$id=$_GET["updateid"];

//writing sql to fill-out form when we click on update
$sql = "SELECT * FROM `crud` WHERE `id`=$id  ";
$result = $db->query($sql);
$array = $result->fetch_array();
$name = $array["name"];
$email = $array["email"];
$mobile = $array["mobile"];
$password = $array["password"];



if(isset($_POST["submit"])){
    if(empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["mobile"]) || empty($_POST["password"])){
        echo "Please complete form.";
    }

    $name = addslashes($_POST["name"]);
    $email = addslashes($_POST["email"]);
    $mobile = addslashes($_POST["mobile"]);
    $password = addslashes($_POST["password"]);

    //REgex pattern
    $pattern="/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/";//email verification regex
    if(!preg_match($pattern, $_POST["email"])){
        exit("Please use a valid email address");
    }
    $pattern="/^.{6,20}$/";
    if(!preg_match($pattern,$_POST["password"])){
        exit("Password should be between 6 and 20 characters");
    }

    $password = md5($password);
    //insert sql
    $sql = "UPDATE`crud` SET `id`='$id', `name`='$name', `email`='$email', `mobile`='$mobile',
     `password`='$password' WHERE `id`='$id'";

    $result = $db->query($sql);

    if(!$result){
        textAlert(classmsg:'error',msg:'SQL error');
    }else{
        textAlert(classmsg:'success',msg:'SQL success');
    }

    $db->close();



}

function textAlert($classmsg,$msg){
    $element = "<h6 class='$classmsg'>$msg</h6>";
    echo $element;
}





?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
     rel="stylesheet" >
    <title>CRUD</title>
</head>
<body>
    
    <div class="container my-5">
        <form action="" method="POST">
            <div class="form-group">
            <label>Name</label>
                <input type="text" name="name" value=<?php echo $name ?> placeholder="enter name" 
                class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
            <label>Email</label>
                <input type="email" name="email" value=<?php echo $email ?> placeholder="enter email" 
                class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
            <label>Mobile</label>
                <input type="text" name="mobile" value=<?php echo $mobile ?> placeholder="enter mobile" 
                class="form-control" autocapitalize="off">
            </div>
            <div class="form-group">
            <label>Password</label>
                <input type="password" name="password" value=<?php echo $password ?> placeholder="enter password" 
                class="form-control" autocomplete="off">
            </div>
            <button name="submit" type="submit" class="btn btn-primary"><a href='./display.php'>Update</a></button>
        </form>
    </div>







</body>
</html>