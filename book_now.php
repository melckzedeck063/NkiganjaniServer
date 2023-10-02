
<?php
include('./connect.php');

$property_id   = "12";
$user_id = "12";
$booking_status = "Pending" ;
$owner_id = "15";


if(isset($_POST["property_id"])){
    $property_id = $_POST["property_id"];
}

if(isset($_POST["user_id"])){
    $user_id = $_POST["user_id"];
}

if(isset($_POST["owner_id"])){
    $owner_id = $_POST["owner_id"];
}

if(isset($_POST["booking_status"])){
    $booking_status = $_POST["booking_status"];
}


if(!empty($fproperty_id) || !empty($booking_status) || !empty($user_id)){
  

    $insert_query = "INSERT INTO bookings (property_id, user_id, owner_id, booking_status)  VALUES('$property_id','$user_id', '$owner_id' , '$booking_status')";
    if(mysqli_query($conn, $insert_query)){

        $update_query = "UPDATE properties SET status = 'Booked' WHERE property_id ='$property_id'";
    if(mysqli_query($conn, $update_query)){
        $results["success"]= "1";
        $results["message"] = "New book placed succesfully";
         echo json_encode($results);
          mysqli_close($conn);
       }
       else{
        $result['success']='0';
        $result['message']='Request failed  please try again';
            echo json_encode($result);
            mysqli_close($conn);
       }
    } 
       else {
            $result['success']='0';
            $result['message']='Request failed  please try again';
                echo json_encode($result);
                mysqli_close($conn);
       }
}  
 
else{
    echo "All inputs are required";
}

// echo "Home  sweet home";

?>