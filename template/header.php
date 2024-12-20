<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['Logback'])) {
        unset($_SESSION['id']);
        header('Location: index.php');
        exit(); // Always exit after a header redirect
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Burger King - Food Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Nunito:600,700" rel="stylesheet"> 
    
    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css">


    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Nav Bar Start -->
    <div class="navbar navbar-expand-lg bg-light navbar-light">
        <div class="container-fluid">
            <a href="index.html" class="navbar-brand">Foody <span>King</span></a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <a href="feature.php" class="nav-item nav-link">Feature</a>
                    <a href="team.php" class="nav-item nav-link">Chef</a>
                    <a href="menu.php" class="nav-item nav-link">Menu</a>
                    <a href="booking.php" class="nav-item nav-link">Booking</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu">
                            <a href="blog.php" class="dropdown-item">Blog Grid</a>
                            <a href="single.php" class="dropdown-item">Blog Detail</a>
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link">Contact</a>

                    <!-- For Login -->
                    <?php if (!isset($_SESSION['id'])) { ?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Connexion</a>
                            <div class="dropdown-menu">
                                <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#loginModal">Login</button>
                                <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#signupModal">Sign Up</button>
                            </div>
                        </div>
                    <?php } elseif ($_SESSION['id'] == 1) { ?>
                        <!-- For Admin -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Profile</a>
                            <div class="dropdown-menu">
                                <a  href="./dash/" class="btn btn-primary dropdown-item">Dashboard</a>
                                <form action="" method="POST">
                                    <button name="Logback" type="submit" class="btn btn-primary dropdown-item">Logout</button>
                                </form>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Profile</a>
                            <div class="dropdown-menu">
                                <a href="profile.php" class="btn btn-primary dropdown-item">Dashboard</a>
                                <form action="" method="POST">
                                    <button name="Logback" type="submit" class="btn btn-primary dropdown-item">Logout</button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Nav Bar End -->
</body>
</html>
