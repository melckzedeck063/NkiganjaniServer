

<?php
include('./connect.php');

$select_query = "SELECT * FROM properties";
$results = mysqli_query($conn, $select_query);

if ($results) {
    $property_data = array();

    while ($row = mysqli_fetch_assoc($results)) {
        $property_data[] = $row;
    }

    if (count($property_data) > 0) {
        $result["success"] = "1";
        $result["message"] = "Properties data found successfully";
        $result["properties_data"] = $property_data;
        echo json_encode($result);
    } else {
        $result["success"] = "0";
        $result["message"] = "No property data found";
        echo json_encode($result);
    }

    mysqli_close($conn);
} else {
    $result["success"] = "0";
    $result["message"] = "Error executing query: " . mysqli_error($conn);
    echo json_encode($result);
}
?>
