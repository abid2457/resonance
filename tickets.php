<?php include 'session.php'; ?>
<?php
include 'db.php';

// Define the number of results per page
$results_per_page = 6;

// Get the current page number from URL (default to 1 if not set)
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    $page = 1;
}

// Calculate the starting row
$start_from = ($page - 1) * $results_per_page;

// Fetch total number of events
$total_query = $conn->query("SELECT COUNT(*) AS total FROM events");
$total_row = $total_query->fetch_assoc();
$total_events = $total_row['total'];

// Calculate total pages
$total_pages = ceil($total_events / $results_per_page);

// Fetch events for the current page
$query = $conn->query("SELECT * FROM events ORDER BY date_time ASC LIMIT $start_from, $results_per_page");

if (!$query) {
    die("Error fetching events: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Tooplate">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>resonance - Tickets Page</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/tooplate-artxibition.css">
    
    </head>
    
    <body>
    
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->
    
    <!-- ***** Pre HEader ***** -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <span>Hey! The Show Is Starting In 5 Days.</span>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="text-button">
                        <a href="rent-venue.php">Contact Us Now! <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'menu_include.php'; ?>

    <!-- ***** About Us Page ***** -->
    <div class="page-heading-shows-events">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Tickets On Sale Now!</h2>
                    <span>Check out upcoming and past shows & events and grab your ticket right now.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="tickets-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="search-box">
                        <form id="subscribe" action="" method="get">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="search-heading">
                                        <h4>Sort The Upcoming Shows & Events By:</h4>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <select value="month">
                                                <option value="month">Month</option>
                                                <option name="June" id="June">June</option>
                                                <option name="July" id="July">July</option>
                                                <option name="August" id="August">August</option>
                                                <option name="September" id="September">September</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <select value="location">
                                                <option value="location">Location</option>
                                                <option name="Brazil" id="Brazil">Brazil</option>
                                                <option name="Europe" id="Europe">Europe</option>
                                                <option name="US" id="US">US</option>
                                                <option name="Asia" id="Asia">Asia</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <select value="month">
                                                <option value="month">Price</option>
                                                <option name="min" id="min">$0 - $50</option>
                                                <option name="standard" id="standard">$50 - $100</option>
                                                <option name="hight" id="hight">$100 - $200</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <fieldset>
                                            <button type="submit" id="form-submit" class="main-dark-button">Submit</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>Tickets Page</h2>
                    </div>
                </div>
                <div class="row">
                    <?php while ($event = $query->fetch_assoc()): ?>
                        <div class="col-lg-4">
                            <div class="ticket-item">
                                <div class="thumb">
                                    <img src="/resonance/<?php echo htmlspecialchars($event['thumbnail_url']); ?>" alt="">
                                    <div class="price">
                                        <span>1 ticket<br>from <em>₹<?php echo number_format($event['ticket_price'], 2); ?></em></span>
                                    </div>
                                </div>
                                <div class="down-content">
                                    <span>There Are <?php echo $event['available_tickets']; ?> Tickets Left For This Show</span>
                                    <h4><?php echo htmlspecialchars($event['title']); ?></h4>
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i> <?php echo date("F j | g A", strtotime($event['date_time'])); ?></li>
                                        <li><i class="fa fa-map-marker"></i> <?php echo htmlspecialchars($event['location']); ?></li>
                                    </ul>
                                    <div class="main-dark-button">
                                        <a href="ticket-details.php?id=<?php echo $event['id']; ?>">Purchase Tickets</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <div class="col-lg-12">
                    <div class="pagination">
                        <ul>
                            <!-- Previous Button -->
                            <?php if ($page > 1): ?>
                                <li><a href="?page=<?php echo ($page - 1); ?>">Prev</a></li>
                            <?php endif; ?>

                            <!-- Page Numbers -->
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="<?php echo ($page == $i) ? 'active' : ''; ?>">
                                    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- Next Button -->
                            <?php if ($page < $total_pages): ?>
                                <li><a href="?page=<?php echo ($page + 1); ?>">Next</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

<!-- *** Modern Navbar *** -->
<header>
        <nav class="navbar">
            <ul class="nav-links">
               <li><a href="index.php" class="active">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="shows-events.html">Events</a></li>
                <li><a href="tickets.php">Tickets</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- *** CSS Styling *** -->
    <style>
        /* Navbar Styling */
        .navbar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #111;
            padding: 15px 0;
            box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;

            /* Centering navbar content */
            display: flex;



            height: 60px;
            /* Ensuring a good height */
        }

        /* Centering navbar items */
        .nav-links {
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;

            padding: 0;
            margin: 0;
        }

        /* Spacing between menu items */
        .nav-links li {
            margin: 0 20px;
        }

        /* Styling menu links */
        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            transition: 0.3s;
        }

        /* Hover effect */
        .nav-links a:hover {
            color: #ff4a57;
        }

        /* Responsive for Mobile */
        @media (max-width: 768px) {
            .navbar {
                height: auto;
                padding: 10px 0;
            }

            .nav-links {
                flex-direction: column;
                gap: 10px;
            }

            .nav-links li {
                margin: 10px 0;
            }
        }
    </style>


    <!-- *** Stylish Footer *** -->
    <?php include 'footer.php'; ?>
    <!-- *** CSS Styling (Add to your CSS file) *** -->
    <style>
        /* Navbar Styling */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #111;
            padding: 15px 30px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo a {
            font-size: 24px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .nav-links {
            list-style: none;
            display: flex;
            margin-left:30%;
        }

        .nav-links li {
            margin: 0 15px;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: #ff4a57;
        }

        .menu-toggle {
            display: none;
            font-size: 24px;
            color: #fff;
        }

        /* Footer Styling */
        footer {
            background: #fff;
            color: #222;
            padding: 30px 0;
            text-align: center;
        }

        .footer .logo {
            font-size: 26px;
            font-weight: bold;
        }

        .links ul,
        .social-links ul {
            list-style: none;
            padding: 0;
        }

        .links ul li,
        .social-links ul li {
            display: inline;
            margin: 0 10px;
        }

        .links ul a,
        .social-links ul a {
            color: #ff4a57;
            text-decoration: none;
        }

        .under-footer {
            margin-top: 20px;
            font-size: 14px;
        }

        /* Responsive Navbar */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                right: 0;
                background: #111;
                width: 100%;
                text-align: center;
            }

            .nav-links li {
                margin: 15px 0;
            }

            .menu-toggle {
                display: block;
                cursor: pointer;
            }
        }
    </style>

    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/mixitup.js"></script> 
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/custom.js"></script>


  </body>
</html>