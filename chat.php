<?php
include("connect.php");


$user_id= "7";
$receiver_id =  "15";
$message_content ="hello";

if(isset($_POST["user_id"])){
    $user_id = $_POST["user_id"];
}
if(isset($_POST["receiver_id"])){
    $receiver_id = $_POST["receiver_id"];
}
if(isset($_POST["message"])){
    $message_content = $_POST["message"];
}


// Check if a conversation exists between the two users
$check_conversation_query = "SELECT * FROM conversation
                             WHERE (user1_id = '$user_id' AND user2_id = '$receiver_id')
                             OR (user1_id = '$receiver_id' AND user2_id = '$user_id')";
$result = mysqli_query($conn, $check_conversation_query);

if (mysqli_num_rows($result) > 0) {
    // Conversation exists, retrieve the conversation_id
    $row = mysqli_fetch_assoc($result);
    $conversation_id = $row["conversation_id"];
    
    // Insert the message into the messages table
    $insert_message_query = "INSERT INTO messages (conversation_id, sender_id, message)
                            VALUES ('$conversation_id', '$user_id', '$message_content')";
                            // echo  "here it works";
    if (mysqli_query($conn, $insert_message_query)) {
        $results["success"] = "1";
        $results["message"] = "Message sent successfully";
        echo json_encode($results);
    } else {
        $results["success"] = "0";
        $results["message"] = "Message sending failed";
        echo json_encode($results);
    }
} else {
    // Conversation doesn't exist, create a new conversation and insert the message
    $create_conversation_query = "INSERT INTO conversation (user1_id, user2_id)
                                VALUES ('$user_id', '$receiver_id')";
    if (mysqli_query($conn, $create_conversation_query)) {
        $conversation_id = mysqli_insert_id($conn); // Get the auto-generated conversation_id
        
        // Insert the message into the messages table
        $insert_message_query = "INSERT INTO messages (conversation_id, sender_id, message)
                                VALUES ('$conversation_id', '$user_id', '$message_content')";
        if (mysqli_query($conn, $insert_message_query)) {
            $results["success"] = "1";
            $results["message"] = "Conversation created and message sent successfully";
            echo json_encode($results);
        } else {
            $results["success"] = "0";
            $results["message"] = "Conversation creation and message sending failed";
            echo json_encode($results);
        }
    } else {
        $results["success"] = "0";
        $results["message"] = "Conversation creation failed";
        echo json_encode($results);
    }
}
?>


