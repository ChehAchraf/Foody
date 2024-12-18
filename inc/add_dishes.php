<?php 
    include('db.php');
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if( isset( $_POST['dish_name'] )&& isset( $_POST['dish_ingredient'] ) && isset( $_POST['dish_price'] )){
            $dname = remove_space($_POST['dish_name']);
            $ding = remove_space($_POST['dish_ingredient']);
            $dprice = remove_space($_POST['dish_price']);
            if(!is_numeric($dprice)){
                echo "the price must be a number";
                return;
            }
            $insert_dish = $conn->prepare("INSERT INTO `dishes`(`name`,`description`,`price`,`created_at`) VALUES (?,?,?,NOW())");
            $insert_dish->bind_param("sss",$dname,$ding,$dprice);
            $insert_dish->execute();
            if($insert_dish->affected_rows > 0){
                echo "dishes Inserted !";
            }else{
                echo "there must be an error " . $insert_dish->error;
            }
        }else{
            echo "You must enter any data";
        }
    }else{
        header("Location: ../index.php");
    }


    function remove_space($str){
        return trim($str);
    }