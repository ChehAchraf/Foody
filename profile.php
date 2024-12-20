<?php 
    session_start();
    if( isset($_SESSION['id']) ){
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
            <aside class="col-md-3 sidebar p-3">
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
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" class="form-control" value="John Doe">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" value="johndoe@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" id="phone" class="form-control" value="+123456789">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Information</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-primary text-white">Booking History</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Booking Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2024-12-01</td>
                                    <td>18:30</td>
                                    <td><span class="badge bg-success">Approved</span></td>
                                </tr>
                                <tr>
                                    <td>2024-11-15</td>
                                    <td>20:00</td>
                                    <td><span class="badge bg-danger">Cancelled</span></td>
                                </tr>
                                <tr>
                                    <td>2024-11-05</td>
                                    <td>19:00</td>
                                    <td><span class="badge bg-success">Approved</span></td>
                                </tr>
                            </tbody>
                        </table>
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