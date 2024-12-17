<?php
include('db.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        

        $email = remove_space($_POST['email']);
        $password = remove_space($_POST['password']);
        
        $check = $conn->prepare("SELECT `id` , `email` , `password` FROM `users` WHERE `email` = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $check->bind_result($userid , $user_mail ,$hash_pass);
            
            if ($check->fetch()) {
                if (password_verify($password, $hash_pass)) {
                    $_SESSION['id'] = $userid;
                    $_SESSION['login_done'] = " Succesfully Log in! you will be redirect after 3 Seconds";
                    header('Location: ../login.php');
                } else {
                    echo "Invalid password!";
                }
            }
        } else {
            echo "No user found with that email!";
        }
        
        $check->close();
    }
}
function remove_space($str) {
    return trim($str); 
}
?>
