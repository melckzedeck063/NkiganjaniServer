

<?php
include('./connect.php');

$convID = "";
if(isset($_POST["conv_id"])){
    $convID = $_POST['conv_id'];
}

$select_query = "SELECT * FROM messages WHERE conversation_id = '$convID'";
$results = mysqli_query($conn, $select_query);

if ($results) {
    $message_data = array();

    while ($row = mysqli_fetch_assoc($results)) {
        $message_data[] = $row;
    }

    if (count($message_data) > 0) {
        $result["success"] = "1";
        $result["message"] = "Messages found successfully";
        $result["messages"] = $message_data;
        echo json_encode($result);
    } else {
        $result["success"] = "0";
        $result["message"] = "No message found";
        echo json_encode($result);
    }

    mysqli_close($conn);
} else {
    $result["success"] = "0";
    $result["message"] = "Error executing query: " . mysqli_error($conn);
    echo json_encode($result);
}
?>
