<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['dish_name']) && isset($_POST['dish_ingredient']) && isset($_POST['dish_price'])) {
        
        if (isset($_FILES['dish_img']) && $_FILES['dish_img']['error'] == 0) {
            $dname = remove_space($_POST['dish_name']);
            $ding = remove_space($_POST['dish_ingredient']);
            $dprice = remove_space($_POST['dish_price']);
            
            if (!is_numeric($dprice)) {
                echo "The price must be a number.";
                return;
            }
            $upload_to = '../uploads/';
            $image_name = $_FILES['dish_img']['name'];  
            $image_tmp = $_FILES['dish_img']['tmp_name'];  
            $image_path = $upload_to . basename($image_name);
            
            if (move_uploaded_file($image_tmp, $image_path)) {
                
                $insert_dish = $conn->prepare("INSERT INTO `dishes` (`name`, `description`, `price`, `created_at`, `image_path`) VALUES (?, ?, ?, NOW(), ?)");
                $insert_dish->bind_param("ssds", $dname, $ding, $dprice, $image_path);
                
                if ($insert_dish->execute()) {
                    echo "Dish inserted successfully!";
                } else {
                    echo "Error: " . $insert_dish->error;
                }
                
            } else {
                echo "Error uploading the image.";
            }
        } else {
            echo "No image uploaded or there was an error with the image.";
        }
    } else {
        echo "You must enter all the data.";
    }
} else {
    header("Location: ../index.php");
    exit();
}

function remove_space($str) {
    return trim($str);
}
?>
