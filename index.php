<?php
include ("./connect.php");

$username="";
$password = "";

if(isset($_POST["username"])){
    $username = $_POST['username'];
}
if(isset($_POST['password'])){
    $password = md5($_POST['password']);
}


if(!empty($username) && !empty($password)){

    $select_query = "SELECT id,firstname,lastname,username,phone,role  FROM users WHERE username='$username' AND password='$password'";

    $results =  mysqli_query($conn, $select_query);

    if(mysqli_num_rows($results) >0){
        $user_data  = mysqli_fetch_assoc($results);
        $result["success"]="1";
        $result["message"] ="Succesfully loged in";
        $result["user_data"] = $user_data;
         echo json_encode($result);
         mysqli_close($conn);
    }
    else {
        $result["success"]="0";
        $result["message"] ="Invalid login credentials";
         echo json_encode($result);
         mysqli_close($conn);
    }
}
else {
    echo "All inputs are required";
}

?>