<?php
include('./connect.php');

$user_id ="15";
if(isset($_POST["user_id"])){
    $user_id = $_POST["user_id"];
}

if(!empty($user_id)){

    $select_query = "SELECT b.*, u.firstname AS user_firstname, u.lastname AS user_lastname, p.property AS property, p.price AS property_price
                     FROM bookings b
                     LEFT JOIN users u ON (b.user_id = u.id)
                     LEFT JOIN properties p ON b.property_id = p.property_id
                     WHERE b.user_id = '$user_id' OR b.owner_id = '$user_id'";

    $results = mysqli_query($conn, $select_query);
    
    if ($results) {
        $my_bookings = array();
    
        while ($row = mysqli_fetch_assoc($results)) {
            $my_bookings[] = $row;
        }
    
        if (count($my_bookings) > 0) {
            $result["success"] = "1";
            $result["message"] = "Bookings data found successfully";
            $result["bookings_data"] = $my_bookings;
            echo json_encode($result);
        } else {
            $result["success"] = "0";
            $result["message"] = "No booking data found";
            echo json_encode($result);
        }
    
        mysqli_close($conn);
    } else {
        $result["success"] = "0";
        $result["message"] = "Error executing query: " . mysqli_error($conn);
        echo json_encode($result);
    }

}else {
    $result["success"] = "0";
    $result["message"] = "User id not found";
    echo json_encode($result);
}
?>
