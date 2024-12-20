<?php 
    session_start();
    if( isset($_SESSION['id']) ){
        include('inc/db.php');
        if(isset($_POST['logout'])){
            unset($_SESSION['id']);
            header('Location: index.php');
        }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Meal Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f9f9f9;
        }
        .navbar {
            background-color: #ff6600;
        }
        .navbar-brand {
            color: white;
            font-weight: bold;
        }
        .sidebar {
            height: 100vh;
            background-color: #ff6600;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #cc5200;
        }
        .main-content {
            padding: 20px;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .btn-reset {
            all: unset; 
            display: inline-block; 
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Global Chef</a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <aside class="col-md-3 sidebar p-3 ">
                <h4>User Dashboard</h4>
                <a href="#">Profile</a>
                <a href="#">Reservations</a>
                <a href="#">Settings</a>
                <form action="" method="POST">
                    <a><button name="logout" class="btn-reset">Logout</button></a>
                </form>
            </aside>
            <main class="col-md-9 main-content">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">User Information</div>
                    <div class="card-body">
                    <?php 
                        $id = $_SESSION['id'];
                        $get_user_data = "SELECT * FROM `users` WHERE `id` = '$id'";
                        $get_the_result = $conn->query($get_user_data);
                        if($get_the_result->num_rows > 0){
                            $row = $get_the_result->fetch_assoc();
                    ?>
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" class="form-control" value="<?php echo $row['name'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" value="<?php echo $row['email'] ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Information</button>
                        </form>
                    <?php }else{
                        echo "there must be an error";
                    } ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-primary text-white">Booking History</div>
                    <div class="card-body">
                        <?php 
                            $get_reservations = "SELECT reservations.id AS reservation_id, menus.title AS menu_title, reservations.reservation_date, reservations.reservation_time, reservations.num_people, reservations.status FROM reservations JOIN menus ON reservations.menu_id = menus.id;";
                            $fetch = $conn->query($get_reservations);
                            if($fetch->num_rows > 0){
                        ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Menu name</th>
                                    <th>Booking Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $fetch->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['menu_title'] ?></td>
                                    <td><?php echo $row['reservation_date'] ?></td>
                                    <td><?php echo $row['reservation_time'] ?></td>
                                    <td><span class="badge bg-<?php echo ($row['status'] == "pending") ? "warning" : (($row['status'] == "confirmed") ? "success" : "danger"); ?>"><?php echo $row['status'] ?></span></td>
                                </tr>
                                <?php endwhile ?>
                            </tbody>
                        </table>
                        <?php }else{
                            echo '  <div class="container">
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Attention!</strong> Please make a reservation first.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>';           
                        }?>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
  }else{
    header('Location: index.php');
  }
?>