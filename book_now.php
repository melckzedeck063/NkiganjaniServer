
<?php
include('./connect.php');

$firstname   = "";
 $lastname = "";
  $phone = "";
   $username = "" ;
   $password = "";
   $role = "";

if(isset($_POST["firstname"])){
    $firstname = $_POST["firstname"];
}
if(isset($_POST["phone"])){
    $phone = $_POST["phone"];
}
if(isset($_POST["lastname"])){
    $lastname = $_POST["lastname"];
}
if(isset($_POST["password"])){
    $password = md5($_POST["password"]);
}
if(isset($_POST["username"])){
    $username = $_POST["username"];
}
if(isset($_POST["role"])){
    $role = $_POST["role"];
}

if(!empty($firstname) || !empty($phone) ||  !empty($username) || !empty($role) || !empty($password) || !empty($lastname)){
  
    $select_query = "SELECT * FROM users  WHERE username = '$username'";
    $email_results = mysqli_query($conn, $select_query);
    if(mysqli_num_rows($email_results) > 0){
        $result['success']='0';
            $result['message']='Email already exists! please try again';
                echo json_encode($result);
                mysqli_close($conn);
    }
    else {
    $insert_query = "INSERT INTO users (firstname, lastname, username, phone, role,password)  VALUES('$firstname','$lastname' , '$username', '$phone', '$role', '$password')";
    if(mysqli_query($conn, $insert_query)){
        $results["success"]= "1";
        $results["message"] = "New account created succesfully";
         echo json_encode($results);
          mysqli_close($conn);
       }
       else {
            $result['success']='0';
            $result['message']='Request failed  please try again';
                echo json_encode($result);
                mysqli_close($conn);
       }
}  
 }
else{
    echo "All inputs are required";
}

// echo "Home  sweet home";

?>