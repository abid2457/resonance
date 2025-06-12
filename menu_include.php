<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.php" class="logo">Res<em>onance</em></a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="index.php" class="active">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="rent-venue.php">Rent Venue</a></li>
                        <li><a href="event-details.php">Events</a></li> 
                        
                        <li><a href="tickets.php">Tickets</a></li> 
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li><a href="my_booking.php">My Bookings</a></li> 
                            <li><a href="javascript:void(0)" class="user-name">👤 <?php echo $_SESSION['user_name']; ?></a></li>
                            <li><a href="javascript:void(0)" id="logoutBtn">Logout</a></li>
                        <?php else: ?>
                            <li><a href="login.php">Log In</a></li>
                            <li><a href="register.php">Sign Up</a></li>
                        <?php endif; ?>
                        
                    </ul>        
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>