<?php
    session_start();
    if (isset($_SESSION['id']) && $_SESSION['id'] == 1){
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
  <body>
    <header class="py-4 px-5 bg-dark text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5>Foody | Dashboard</h5>
            <img  src="https://i.pravatar.cc/50" alt="" style="border-radius: 100%;">
        </div>
    </header>
    <section class="d-flex">
        <div class="bg-dark h-full text-white p-2 col-2 d-flex flex-column align-items-center ">
            <a href="#" class="text-white text-decoration-none fs-6"> 
                <i class="fa-solid fa-plate-wheat"></i> Dishes
            </a>
            <hr style="width: 80%;color: white;">
            <a href="#" class="text-white text-decoration-none fs-6"> 
                <i class="fa-solid fa-plate-wheat"></i> Menus
            </a>
            <hr style="width: 80%;color: white;">
            <a href="#" class="text-white text-decoration-none fs-6"> 
                <i class="fa-solid fa-plate-wheat"></i> Client
            </a>
            <hr style="width: 80%;color: white;">
            <a href="#" class="text-white text-decoration-none fs-6"> 
                <i class="fa-solid fa-plate-wheat"></i> Reservations
            </a>
        </div>
        <div class="p-5 container">
            <div class="row gap-2">
                <!-- Plate 1 - Type A -->
                <div class="d-flex flex-column align-items-center justify-content-center bg-danger text-white p-2 col rounded" >
                    <i class="fas fa-utensils fa-3x mb-3"></i> <!-- Icon for plates -->
                    <h4>Type A Plates</h4>
                    <p class="h2">250</p>
                    <small>Total Available</small>
                </div>
        
                <!-- Plate 2 - Type B -->
                <div class="d-flex flex-column align-items-center justify-content-center bg-danger text-white p-2 col rounded" >
                    <i class="fas fa-cogs fa-3x mb-3"></i> <!-- Icon for machinery or types -->
                    <h4>Type B Plates</h4>
                    <p class="h2">180</p>
                    <small>Total Available</small>
                </div>
        
                <!-- Plate 3 - Type C -->
                <div class="d-flex flex-column align-items-center justify-content-center bg-danger text-white p-2 col rounded" >
                    <i class="fas fa-plate fa-3x mb-3"></i> <!-- Icon for plates -->
                    <h4>Type C Plates</h4>
                    <p class="h2">150</p>
                    <small>Total Available</small>
                </div>
        
                <!-- Plate 4 - Damaged Plates -->
                <div class="d-flex flex-column align-items-center justify-content-center bg-danger text-white p-2 col rounded" >
                    <i class="fas fa-ban fa-3x mb-3"></i> <!-- Icon for damaged or prohibited -->
                    <h4>Damaged Plates</h4>
                    <p class="h2">30</p>
                    <small>Total Damaged</small>
                </div>
            </div>
            <div class="mt-5 container">
                <div class="row">
                    <div class="col-6">
                        <h2>Insert New Dish</h2>
                        <form action="insert_dish.php" method="POST">
                        <!-- Menu ID -->
                        
                        <!-- Dish Name -->
                        <div class="mb-3">
                            <label for="dish_name" class="form-label">Dish Name</label>
                            <input type="text" class="form-control" id="dish_name" name="dish_name" required>
                        </div>

                        <!-- Ingredients -->
                        <div class="mb-3">
                            <label for="dish_ingredient" class="form-label">Dish Ingredients</label>
                            <textarea class="form-control" id="dish_ingredient" name="dish_ingredient" rows="3" required></textarea>
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label for="dish_price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="dish_price" name="dish_price" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Insert Dish</button>
                        </form>
                    </div>
                    <div class="col-6">
                        <div class="">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
<?php
    }else{
        header('Location: ../login.php');
    }
 ?>