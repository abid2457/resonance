<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="logo"></div>
            </div>
            <div class="col-lg-5">
                <div class="links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="about.php">Info</a></li>
                        <li><a href="rent-venue.php">Venues</a></li>
                        <li><a href="tickets.php">Tickets</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                
                <div class="social-links">
                    <h4>Follow Us</h4>
                    <ul>
                        <li><a href="https://www.x.com/"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="assets/js/jquery-2.1.0.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- SweetAlert2 CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).ready(function () {
        $("#logoutBtn").click(function () {
            $.ajax({
                url: "logout_ajax.php",
                type: "POST",
                success: function () {
                    window.location.href = "login.php";
                }
            });
        });
    });
</script>
