<?php
    include('../inc/db.php');
    session_start();
    if (isset($_SESSION['id']) && $_SESSION['id'] == 1){
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Reservations</title>
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
        <a class="navbar-brand" href="#">Admin Dashboard</a>
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
            <a class="nav-link active" href="reservations.php"><i class="fa fa-calendar"></i> Reservations</a>
        </li>
    </ul>
</div>

<!-- Main Content -->
<div class="content">
    <div class="container-fluid pt-5">
        <h2>Manage Reservations</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Menu Name</th>
                    <th>Client Name</th>
                    <th>Client Email</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT reservations.id, menus.title AS menu_name, users.name AS client_name, users.email AS client_email, reservation_date, reservation_time, status 
                          FROM reservations 
                          JOIN menus ON reservations.menu_id = menus.id 
                          JOIN users ON reservations.client_id = users.id";
                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['menu_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['client_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['client_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['reservation_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['reservation_time']); ?></td>
                        <td>
                            <form action="../inc/update_reservation.php" method="POST">
                                <input type="hidden" name="reservation_id" value="<?php echo $row['id']; ?>">
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="pending" <?php echo $row['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="confirmed" <?php echo $row['status'] == 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                    <option value="cancelled" <?php echo $row['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form action="../inc/delete_reservation.php" method="POST">
                                <input type="hidden" name="reservation_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('sidebarToggle').addEventListener('click', function () {
        const sidebar = document.querySelector('.sidebar');
        sidebar.style.display = sidebar.style.display === 'block' ? 'none' : 'block';
    });
</script>

</body>
</html>
<?php
    } else {
        header('Location: ../profile.php');
    }
?>
