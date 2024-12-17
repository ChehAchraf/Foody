<?php 
include('db.php');
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if( isset($_POST['name']) &&isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['confirmPassword']) && isset($_POST['termsCheck'])){
            $name = remove_space($_POST['name']);
            $email = remove_space($_POST['email']);
            $phone = remove_space($_POST['phone']);
            $password = remove_space($_POST['password']);
            $confirmPassword = remove_space($_POST['confirmPassword']);
            $termsCheck = $_POST['termsCheck'];
            if($termsCheck !== "on"){
                die( "You must agree to the terms");
            }
            if ($password !== $confirmPassword) {
                die("Passwords do not match.");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die("Invalid email format.");
            }
            $phone = preg_replace('/\D/', '', $phone);
            $hashpass = password_hash($password, PASSWORD_DEFAULT);
            echo "done";
            $insert_data = $conn->prepare("INSERT INTO `users`(`name`,`email`,`password`,`role`,`created_at`) VALUES(?,?,?,'client', NOW())");
            $insert_data->bind_param("sss",$name,$email,$hashpass);
            $insert_data->execute();
            if ($insert_data->affected_rows > 0) {
                echo "User created successfully";
            } else {
                echo "Error creating user: " . $insert_data->error;
            }
        }else{
            die("You must enter any data");
        }
}

function remove_space($str){
    return trim($str);
}

