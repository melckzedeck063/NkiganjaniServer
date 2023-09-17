


<?php
include("connect.php");

$user_id = "12";
if(isset($_POST["user_id"])){
    $user_id = $_POST["user_id"];
}

// Fetch conversations and user information based on the condition
$get_conversations_query = "SELECT c.*, 
                                  CASE
                                    WHEN c.user1_id != '$user_id' THEN u1.firstname
                                    WHEN c.user2_id != '$user_id' THEN u2.firstname
                                  END AS user_firstname,
                                  CASE
                                    WHEN c.user1_id != '$user_id' THEN u1.lastname
                                    WHEN c.user2_id != '$user_id' THEN u2.lastname
                                  END AS user_lastname,
                                  CASE
                                    WHEN c.user1_id != '$user_id' THEN u1.id
                                    WHEN c.user2_id != '$user_id' THEN u2.id
                                  END AS receiver_id
                            FROM conversation c
                            LEFT JOIN users u1 ON c.user1_id = u1.id
                            LEFT JOIN users u2 ON c.user2_id = u2.id
                            WHERE c.user1_id = '$user_id' OR c.user2_id = '$user_id'";

$result = mysqli_query($conn, $get_conversations_query);

if ($result) {
    $conversations = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $conversations[] = $row;
    }

    if (count($conversations) > 0) {
        $response["success"] = "1";
        $response["message"] = "Conversations found successfully";
        $response["conversations"] = $conversations;
        echo json_encode($response);
    } else {
        $response["success"] = "0";
        $response["message"] = "No conversations found";
        echo json_encode($response);
    }
} else {
    // Error occurred while executing the query
    $response["success"] = "0";
    $response["message"] = "Error fetching conversations";
    echo json_encode($response);
}
?>

