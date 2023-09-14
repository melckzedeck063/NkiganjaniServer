<?php
include('./connect.php');


$select_query = "SELECT *  FROM properties";
    $results =  mysqli_query($conn, $select_query);

    if(mysqli_num_rows($results) >0){
        $propeties_data  = mysqli_fetch_assoc($results);
        $result["success"]="1";
        $result["message"] ="Properties data found succesfully";
        $result["propeties_data"] = $propeties_data;
         echo json_encode($result);
         mysqli_close($conn);
    }
    else {
        $result["success"]="0";
        $result["message"] ="No property data found";
         echo json_encode($result);
         mysqli_close($conn);
    }

?>