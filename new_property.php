
<?php
include('./connect.php');

$property   = "";
 $location = "";
  $price = "";
   $bedrooms = "" ;
   $bathroom = "";
   $duration = "";
   $parking = "";
   $owner = "";
   $description="";
   $cover_image ="";

if(isset($_POST["property"])){
    $property = $_POST["property"];
}
if(isset($_POST["price"])){
    $price = $_POST["price"];
}
if(isset($_POST["location"])){
    $location = $_POST["location"];
}
if(isset($_POST["bathrooms"])){
    $bathroom = $_POST["bathrooms"];
}
if(isset($_POST["bedrooms"])){
    $bedrooms = $_POST["bedrooms"];
}
if(isset($_POST["duration"])){
    $duration = $_POST["duration"];
}
if(isset($_POST["parking"])){
    $parking = $_POST["parking"];
}
if(isset($_POST["owner"])){
    $owner =(int) $_POST["owner"];
}
if(isset($_POST["description"])){
    $description = $_POST["description"];
}

if(isset($_POST["cover_image"])){
    $cover_image = $_POST["cover_image"];
}

if(!empty($property) || !empty($price) ||  !empty($bedrooms) || !empty($duration) || !empty($bathroom) || !empty($location)  || !empty($parking) || !empty($owner) || !empty($description) || !empty($cover_image)){
  
    $insert_query = "INSERT INTO properties (property, location, price, bedrooms,bathrooms,parking,duration,photo,description, owner)  VALUES('$property','$location', '$price','$bedrooms', '$bathroom', '$parking', '$duration','$cover_image','$description', '$owner')";
    if(mysqli_query($conn, $insert_query)){
        $results["success"]= "1";
        $results["message"] = "New property registered succesfully";
         echo json_encode($results);
          mysqli_close($conn);
       }
       else {
            $result['success']='0';
            $result['message']='Request failed  please try again';
                echo json_encode($result);
                mysqli_close($conn);
       }

    // echo "everything here  works fine";
}  
 
else{
     $result["success"] =  "0";
     $result["message"]  = "All inputs are required";  
    echo json_encode($result);
}

// echo "Home  sweet home";

?>

<!-- <div>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam est fugiat dolor commodi. Blanditiis et quasi, fugit id expedita autem facilis nisi culpa perferendis voluptate, voluptatem architecto provident tempore eos.
</div> -->