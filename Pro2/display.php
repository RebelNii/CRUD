<?php
require_once("./conn.php");









?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
     rel="stylesheet" >
     <link rel="stylesheet" href="./crud.css" >
    <title>CRUD</title>
</head>
<body>

    <div class="container my-5">
        <div class="read">
            <button name="user" type="submit" class="btn btn-primary">
                <a href="./hello.php" class="text-light">Add User</a>
            </button>
        
        </div>
        
        <div class="table pt-4">
        <table class="table table-success table-striped">
             <thead>
                 <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Mobile</th>
                     <th>Password</th>
                     <th>Operations</th>
                 </tr>
             </thead>
             <tbody>
                <?php
                    function textAlert($classmsg,$msg){
                        $element = "<h6 class='$classmsg'>$msg</h6>";
                        echo $element;
                    }
                    
                    $sql = "SELECT * FROM `crud`";

                    $result = $db->query($sql);

                    if(!$result){
                        textAlert(classmsg:'error',msg:'SQL error');
                    }


                    $password = md5($password);

                    //I could've used a display button to perform this task but decided to try something new
                    if($result){
                        while($array=$result->fetch_array()){
                            
                            $id = $array['id'];
                            $name = $array['name'];
                            $email = $array['email'];
                            $mobile = $array['mobile'];
                            $password = $array['password'];

                            

                            echo "<tr>
                                <th scope='row'>$id</th>
                                <td>$name</td>
                                <td>$email</td>
                                <td>$mobile</td>
                                <td>$password</td>
                                <td>
                                    <button id='btn1' class='text-light'> <a href='./update.php?updateid=$id'>Update</a></button>
                                    <button id='btn2' class='text-light'><a href='./delete.php?deleteid=$id'>Delete</a></button>
                                </td>
                            
                            </tr>  ";


                        }
                        $db->close();
                    }
            

                ?>
                


             </tbody>
        </table>
        </div>
    </div>





    
</body>
</html>