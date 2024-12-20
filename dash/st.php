<?php
include('../inc/db.php');
session_start();
if (isset($_SESSION['id']) && $_SESSION['id'] == 1) {
    $total_reservations = $conn->query("SELECT COUNT(*) AS total FROM reservations")->fetch_assoc()['total'];
    $confirmed_reservations = $conn->query("SELECT COUNT(*) AS total FROM reservations WHERE status = 'confirmed'")->fetch_assoc()['total'];
    $cancelled_reservations = $conn->query("SELECT COUNT(*) AS total FROM reservations WHERE status = 'cancelled'")->fetch_assoc()['total'];
    $pending_reservations = $conn->query("SELECT COUNT(*) AS total FROM reservations WHERE status = 'pending'")->fetch_assoc()['total'];
    $total_users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
    $total_menus = $conn->query("SELECT COUNT(*) AS total FROM menus")->fetch_assoc()['total'];

    $top_menus_query = "
        SELECT title, COUNT(r.id) AS reservation_count
        FROM menus m
        LEFT JOIN reservations r ON m.id = r.menu_id
        GROUP BY m.id
        ORDER BY reservation_count DESC
        LIMIT 5
    ";

    $top_menus_result = $conn->query($top_menus_query);

    if (!$top_menus_result) {
        die("Error executing query: " . $conn->error);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Statistics</title>
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
        .card {
            text-align: center;
            margin: 10px;
        }
        .card i {
            font-size: 24px;
            margin-bottom: 5px;
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
            <a class="navbar-brand" href="#">Admin Panel</a>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar bg-light">
        <div class="text-center mt-5">
            <img src="/w3images/avatar2.png" class="rounded-circle mb-2" style="width: 60px;">
            <p>Welcome, <strong>Admin</strong></p>
        </div>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="index.php"><i class="fa fa-users"></i> Dishes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="menu.php"><i class="fa fa-eye"></i> Menus</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reservations.php"><i class="fa fa-list"></i> Reservations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="statistics.php"><i class="fa fa-bar-chart"></i> Statistics</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid pt-5">
            <h1 class="mb-4">System Statistics</h1>
            <div class="row">
                <div class="col-md-2">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <i class="fa fa-list"></i>
                            <h4><?php echo $total_reservations; ?></h4>
                            <p>Total Reservations</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <i class="fa fa-check-circle"></i>
                            <h4><?php echo $confirmed_reservations; ?></h4>
                            <p>Confirmed Reservations</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <i class="fa fa-times-circle"></i>
                            <h4><?php echo $cancelled_reservations; ?></h4>
                            <p>Cancelled Reservations</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <i class="fa fa-hourglass-half"></i>
                            <h4><?php echo $pending_reservations; ?></h4>
                            <p>Pending Reservations</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <i class="fa fa-users"></i>
                            <h4><?php echo $total_users; ?></h4>
                            <p>Total Users</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <i class="fa fa-cutlery"></i>
                            <h4><?php echo $total_menus; ?></h4>
                            <p>Total Menus</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top 5 Menus by Reservations -->
            <h2 class="mt-5 mb-4">Top 5 Menus by Reservations</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Menu Name</th>
                        <th>Number of Reservations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($top_menus_result->num_rows > 0) {
                        while ($row = $top_menus_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                            echo "<td>" . $row['reservation_count'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No data available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
} else {
    header('Location: ../profile.php');
}
?>
