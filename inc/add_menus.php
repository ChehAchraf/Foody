<?php 
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['menu_name']) && isset($_POST['menu_description']) && isset($_POST['chef_id']) && isset($_POST['dish_ids'])) {
        $conn->begin_transaction();
        
        try {
            $chef_id = $_POST['chef_id'];
            $menuprice = $_POST['menuprice'];
            $menuname = remove_space($_POST['menu_name']);
            $menudesc = remove_space($_POST['menu_description']);
            
            if(!is_numeric($chef_id) || !is_numeric($menuprice)){
                throw new Exception("The chef and price must be numbers");
            }
            
            // Insert the menu
            $insert_menu = $conn->prepare("INSERT INTO `menus`(`chef_id`,`title`,`description`,`price`,`created_at`) VALUES(?,?,?,?,NOW())");
            $insert_menu->bind_param("issd", $chef_id, $menuname, $menudesc, $menuprice);
            
            if (!$insert_menu->execute()) {
                throw new Exception("Failed to create menu");
            }
            
            $menu_id = $conn->insert_id;
            
            // Update the dishes with the new menu_id
            $update_dish = $conn->prepare("UPDATE dishes SET menu_id = ? WHERE id = ?");
            
            foreach($_POST['dish_ids'] as $dish_id) {
                if(!empty($dish_id)) {  // Only process if dish_id is not empty
                    $update_dish->bind_param("ii", $menu_id, $dish_id);
                    if (!$update_dish->execute()) {
                        throw new Exception("Failed to assign dish to menu");
                    }
                }
            }
            
            $conn->commit();
            echo "Menu created successfully with selected dishes";
            
        } catch (Exception $e) {
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please fill all required fields";
    }
} else {
    header("Location: ../index.php");
    exit();
}

function remove_space($str) {
    return trim($str);
}
?>