<?php
    include('../inc/db.php');
    session_start();
    if (isset($_SESSION['id']) && $_SESSION['id'] == 1){
?>
<!DOCTYPE html>
<html>
<head>
<title>Bootstrap Admin Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
    font-family: "Raleway", sans-serif;
  }
  .sidebar {
    height: 100vh;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #f8f9fa;
    padding-top: 20px;
    z-index: 1000;
    border-right: 1px solid #dee2e6;
  }
  .content {
    margin-left: 250px;
    padding: 20px;
  }
</style>
</head>
<body>

<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <button class="btn btn-dark me-2" id="sidebarToggle">
      <i class="fa fa-bars"></i>
    </button>
    <a class="navbar-brand" href="#">Logo</a>
  </div>
</nav>

<!-- Sidebar -->
<div class="sidebar bg-light">
  <div class="text-center mt-5">
    <img src="/w3images/avatar2.png" class="rounded-circle mb-2" style="width: 60px;">
    <p>Welcome, <strong>Mike</strong></p>
    <div>
      <a href="#" class="btn btn-light btn-sm"><i class="fa fa-envelope"></i></a>
      <a href="#" class="btn btn-light btn-sm"><i class="fa fa-user"></i></a>
      <a href="#" class="btn btn-light btn-sm"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <h5 class="text-center">Dashboard</h5>
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link active" href="index.php"><i class="fa fa-users"></i> Dishes</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="fa fa-eye"></i> Menus</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="fa fa-users"></i> Traffic</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="fa fa-bullseye"></i> Geo</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="fa fa-diamond"></i> Orders</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="fa fa-bell"></i> News</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="fa fa-bank"></i> General</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="fa fa-history"></i> History</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>
    </li>
  </ul>
</div>

<!-- Main Content -->
<div class="content">
  <div class="container-fluid pt-5">
    <div class="row">
      <div class="col-md-3">
        <div class="card text-white bg-danger mb-3">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <i class="fa fa-comment fa-2x"></i>
              <h3>52</h3>
            </div>
            <p>Messages</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <i class="fa fa-eye fa-2x"></i>
              <h3>99</h3>
            </div>
            <p>Views</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <i class="fa fa-share-alt fa-2x"></i>
              <h3>23</h3>
            </div>
            <p>Shares</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <i class="fa fa-users fa-2x"></i>
              <h3>50</h3>
            </div>
            <p>Users</p>
          </div>
        </div>
      </div>
      <div class="mt-5 container">
                <div class="row">
                    <div class="col-6">
                        <h2>Insert New Dish</h2>
                        <form action="../inc/add_dishes.php" method="POST" enctype="multipart/form-data">
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
                            <div class="mb-3">
                                <label for="dish_img" class="form-label">Dish Image</label>
                                <input type="file" step="0.01" class="form-control" id="dish_img" name="dish_img" required>
                            </div>
                            <?php 
                                $get_chef = "SELECT `id`,`title` FROM `menus`";
                                $do = $conn->query($get_chef);
                                if($do->num_rows < 1){
                                    echo "There must be an error showing chef";
                                }
                            ?>
                            <div class="mb-3">
                                <label for="menu_id">Choose the menu</label>
                                <select name="menu_id" id="menu_id" class="form-select"  class="form-label">
                                    <?php while($row = $do->fetch_assoc()): ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['title'] ?></option>
                                    <?php endwhile ?>
                                </select>
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
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('sidebarToggle').addEventListener('click', function () {
    const sidebar = document.querySelector('.sidebar');
    if (sidebar.style.display === 'block') {
      sidebar.style.display = 'none';
    } else {
      sidebar.style.display = 'block';
    }
  });
</script>

</body>
</html>
<?php
    }else{
        lmima();
    }

    function lmima(){
        header('Location: ../profile.php');
    }
 ?>