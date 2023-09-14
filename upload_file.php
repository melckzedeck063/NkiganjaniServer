<?php

// if(isset($_POST["name"])){

    $name = $_POST["name"];
    $image = $_POST["image"];
    $decodedImage = base64_decode("$image");
    $return = file_put_contents("uploads/" . $name . ".jpg", $decodedImage);
    $response = array();
    if ($return !== false) {
        $response['success'] = 1;
        $response['message'] = "Your image has ploaded successfully with Retrofit";
    } else {
        $response['success'] = 0;
        $response['message'] = "Image failed to pload";
    }
    echo json_encode($response);
// }
 
// include('./uploads')
?>

<!-- <!DOCTYPE html>
<html>
<head>
    <title>Image Upload Test</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Enter Name">
        <input type="file" name="image">
        <input type="submit" value="Upload Image">
    </form>
</body>
</html> -->

<?php
// $upload_dir = "uploads"; // Directory where you want to save the uploaded images
// if(isset($_POST['name'])){

//     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image']) && isset($_POST['name'])) {
//         $name = $_POST['name']; // Get the name for the uploaded image
//         $image = $_FILES['image']['tmp_name']; // Temporary location of the uploaded image
    
//         // Check if the directory exists, and if not, create it
//         if (!file_exists($upload_dir)) {
//             mkdir($upload_dir, 0777, true);
//         }
    
//         // Construct the path where the image will be saved
//         $upload_path = $upload_dir . $name . ".jpg"; // You can change the file extension if needed
//         error_log("Upload Path: " . $upload_path);
    
    
//         // Move the uploaded image to the specified path
//         if (move_uploaded_file($image, $upload_path)) {
//         // Image uploaded successfully
//         $response = array("message" => "Image Uploaded Successfully!!");
//         echo json_encode($response);
//     } else {
//         // Failed to move the uploaded image
//         $last_error = error_get_last();
//         $response = array("message" => "Failed to move the uploaded image: " . $last_error['message']);
//         echo json_encode($response);
//     }
    
//     } else {
//         // Invalid request or missing parameters
//         $response = array("message" => "Invalid request or missing parameters");
//         echo json_encode($response);
//     }
// }
?>
