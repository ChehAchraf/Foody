<?php 
    include('db.php');
    if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
        if ( isset($_POST['menu_name']) && isset($_POST['menu_description']) ) {
            $chef_id = $_POST['chef_id'];
            $menuprice = $_POST['menuprice'];
            $menuname = remove_space($_POST['menu_name']);
            $menudesc = remove_space($_POST['menu_description']);
            if(!is_numeric($chef_id) or !is_numeric($menuprice)){
                echo "the chef and the price are must be a number ";
                return;
            }
            $insert_menu = $conn->prepare("INSERT INTO `menus`(`chef_id`,`title`,`description` ,`price`,`created_at` ) VALUES(?,?,?,?,NOW()) ");
            $insert_menu->bind_param("issi",$chef_id,$menuname,$menudesc,$menuprice);
            $insert_menu->execute();
            if($insert_menu->affected_rows > 0 ){
                echo "menu isnerted";
            }

        }else{
            echo "No data, please enter any data ";
        }
    }else{

    }

function remove_space($str){
    return trim($str);
}