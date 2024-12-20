<?php
include('./template/header.php')
?>

<!-- Page Header Start -->
<div class="page-header mb-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Food Menu</h2>
            </div>
            <div class="col-12">
                <a href="">Home</a>
                <a href="">Menu</a>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Food Start -->
<div class="food mt-0">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="food-item">
                    <i class="flaticon-burger"></i>
                    <h2>Burgers</h2>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasel nec pretium mi. Curabit facilis ornare velit non vulputa. Aliquam metus tortor auctor quis sem.
                    </p>
                    <a href="">View Menu</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="food-item">
                    <i class="flaticon-snack"></i>
                    <h2>Snacks</h2>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasel nec pretium mi. Curabit facilis ornare velit non vulputa. Aliquam metus tortor auctor quis sem.
                    </p>
                    <a href="">View Menu</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="food-item">
                    <i class="flaticon-cocktail"></i>
                    <h2>Beverages</h2>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasel nec pretium mi. Curabit facilis ornare velit non vulputa. Aliquam metus tortor auctor quis sem.
                    </p>
                    <a href="">View Menu</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Food End -->


<?php
include('./inc/db.php');
?>
<!-- Menu Start -->
<div class="menu">
    <div class="container">
        <div class="section-header text-center">
            <p>Food Menu</p>
            <h2>Delicious Food Menu</h2>
        </div>
        <div class="menu-tab">
            <ul class="nav nav-pills justify-content-center">
                <?php
                $menus_query = "SELECT * FROM menus";
                $menus_result = $conn->query($menus_query);
                $is_first_tab = true; 
                while ($menu = $menus_result->fetch_assoc()) { ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $is_first_tab ? 'active' : ''; ?>" 
                        data-toggle="pill" 
                        href="#menu-<?php echo $menu['id']; ?>">
                            <?php echo htmlspecialchars($menu['title']); ?>
                        </a>
                    </li>
                <?php
                    $is_first_tab = false; 
                } ?>
            </ul>
            
            <div class="tab-content">
                <?php
                $menus_result->data_seek(0);
                $is_first_content = true;
                while ($menu = $menus_result->fetch_assoc()) {
                    $menu_id = $menu['id'];
                    $dishes_query = "SELECT * FROM dishes WHERE menu_id = $menu_id";
                    $dishes_result = $conn->query($dishes_query);
                ?>
                    <div id="menu-<?php echo $menu['id']; ?>" 
                        class="container tab-pane <?php echo $is_first_content ? 'active' : 'fade'; ?>">
                        <div class="row">
                            <div class="col-lg-7 col-md-12">
                                <?php 
                                $has_dishes = false; 
                                while ($dish = $dishes_result->fetch_assoc()) { 
                                    $has_dishes = true; 
                                ?>
                                    <div class="menu-item">
                                        <div class="menu-img">
                                            <img src="<?php echo !empty($dish['image_path']) ? str_replace('../', '', $dish['image_path']) : 'img/default-placeholder.jpg'; ?>" alt="Dish Image">
                                        </div>
                                        <div class="menu-text">
                                            <h3>
                                                <span><?php echo htmlspecialchars($dish['name']); ?></span>
                                                <strong>$<?php echo number_format($dish['price'], 2); ?></strong>
                                            </h3>
                                            <p><?php echo htmlspecialchars($dish['description']); ?></p>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($has_dishes) { ?>
                                    <!-- Button to trigger the modal -->
                                    <button type="button" class="btn btn-primary btn-block mt-4" data-toggle="modal" data-target="#reservationModal-<?php echo $menu['id']; ?>">
                                        Reserve This Menu
                                    </button>
                                <?php } ?>
                            </div>
                            <div class="col-lg-5 d-none d-lg-block">
                                <img src="img/menu-burger-img.jpg" alt="Menu Section Image">
                            </div>
                        </div>
                    </div>

                    <!-- Modal for reservation -->
                    <div class="modal fade" id="reservationModal-<?php echo $menu['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel-<?php echo $menu['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reservationModalLabel-<?php echo $menu['id']; ?>">Reserve Menu: <?php echo htmlspecialchars($menu['title']); ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="reserve.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="menu" value="<?php echo $menu['id']; ?>">
                                        <div class="form-group">
                                            <label for="reservationDate">Reservation Date</label>
                                            <input type="date" class="form-control" name="date" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="reservationTime">Reservation Time</label>
                                            <input type="time" class="form-control" name="time" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="numPeople">Number of People</label>
                                            <input type="number" class="form-control" name="places" min="1" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button name="send" type="submit" class="btn btn-primary">Reserve Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                    $is_first_content = false; 
                } ?>
            </div>
        </div>
    </div>
</div>


<!-- Menu End -->
<!-- Footer Start -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-contact">
                            <h2>Our Address</h2>
                            <p><i class="fa fa-map-marker-alt"></i>123 Street, New York, USA</p>
                            <p><i class="fa fa-phone-alt"></i>+012 345 67890</p>
                            <p><i class="fa fa-envelope"></i>info@example.com</p>
                            <div class="footer-social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-youtube"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-link">
                            <h2>Quick Links</h2>
                            <a href="">Terms of use</a>
                            <a href="">Privacy policy</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="footer-newsletter">
                    <h2>Newsletter</h2>
                    <p>
                        Lorem ipsum dolor sit amet elit. Quisque eu lectus a leo dictum nec non quam. Tortor eu placerat rhoncus, lorem quam iaculis felis, sed lacus neque id eros.
                    </p>
                    <div class="form">
                        <input class="form-control" placeholder="Email goes here">
                        <button class="btn custom-btn">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <p>Copyright &copy; <a href="#">Your Site Name</a>, All Right Reserved.</p>
            <p>Designed By <a href="https://htmlcodex.com">HTML Codex</a></p>
        </div>
    </div>
</div>
<!-- Footer End -->

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>