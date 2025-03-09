<?php
include 'db.php';

// Fetch events for the Venues & Tickets section
$venues_query = $conn->query("SELECT * FROM events ORDER BY date_time ASC");

if (!$venues_query) {
    die("Error fetching venue events: " . $conn->error);
}

// Fetch events for the Event Cards section (limit to latest 6 events)
$events_query = $conn->query("SELECT * FROM events ORDER BY date_time ASC LIMIT 6");

if (!$events_query) {
    die("Error fetching event cards: " . $conn->error);
}

// Fetch featured events for the carousel (limit to 5)
$carousel_query = $conn->query("SELECT * FROM events ORDER BY date_time ASC LIMIT 5");

if (!$carousel_query) {
    die("Error fetching carousel events: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <title>Resonance</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/tooplate-artxibition.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    body .banner {
        position: relative;
        background: url('concert-bg.jpg') center/cover no-repeat;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url("/assets/images/signup.webp") no-repeat center center/cover;
    }

    .content {
        position: relative;
        z-index: 2;
    }

    h1 {
        font-size: 24px;
        font-weight: bold;
        margin: 0;
    }

    p {
        font-size: 16px;
        margin: 5px 0 15px;
    }

    .btn {
        background: #d61a1a;
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 5px;
        display: inline-block;
    }

    .btn:hover {
        background: #b01515;
    }

    .btn-icon {
        margin-left: 5px;
    }

    h2 {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
    }

    .events-container {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .event-card {
        background-color: #222;
        border-radius: 8px;
        overflow: hidden;
        width: 300px;
        position: relative;
    }

    .event-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .event-details {
        padding: 32px;
        color: white;
    }

    .event-details h3 {
        font-size: 18px;
        margin: 0 0 5px;
    }

    .event-details p {
        font-size: 14px;
        margin: 0;
        color: #bbb;
    }

    .btn {
        display: inline-block;
        margin-top: 10px;
        background-color: #d61a1a;
        color: white;
        text-decoration: none;
        padding: 10px 15px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 5px;
    }

    .btn:hover {
        background: #b01515;
    }

    .new-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: yellow;
        color: black;
        font-size: 12px;
        font-weight: bold;
        padding: 3px 6px;
        border-radius: 3px;
    }

    .right-menu li {
        display: inline-block;
        margin-left: 15px;
    }

    .right-menu a {
        color: white;
        text-decoration: none;
        font-size: 14px;
        font-weight: bold;
    }

    .fullwidth-carousel {
        position: relative;
        width: 100%;
    }

    .owl-fullwidth {
        display: flex;
        align-items: center;
    }

    /* Navigation Arrows */
    .carousel-prev,
    .carousel-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.6);
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 24px;
        z-index: 1000;
        border-radius: 50%;
    }

    .carousel-prev {
        left: 10px;
    }

    .carousel-next {
        right: 10px;
    }

    .carousel-prev:hover,
    .carousel-next:hover {
        background: rgba(0, 0, 0, 0.9);
    }

    /* Dots Styling */
    .custom-dots {
        text-align: center;
        position: absolute;
        bottom: 70px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
    }

    .custom-dots button {
        width: 12px;
        height: 12px;
        margin: 5px;
        border-radius: 50%;
        background: #ccc;
        border: none;
        cursor: pointer;
    }

    .custom-dots button.active {
        background: #ffcc00;
        width: 14px;
        height: 14px;
    }

    .custom-btn {
        display: inline-block;
        padding: 12px 24px;
        background-color: #ff0000;
        /* Red color */
        color: #fff;
        font-size: 18px;
        font-weight: bold;
        text-decoration: none;
        border-radius: 6px;
        transition: 0.3s ease-in-out;
    }

    .custom-btn:hover {
        background-color: #cc0000;
        /* Darker red */
    }

    .event-card {
        background-color: #222;
        border-radius: 8px;
        overflow: hidden;
        width: 439px;
        height: 49vh;
        margin-bottom: 30px;
        position: relative;
    }

    .owl-nav {
        display: none;
    }
    
</style>

<body>
    <?php include 'menu_include.php'; ?>
    

    <!-- Fullwidth Carousel Section -->
    <div class="fullwidth-carousel">
        <div class="owl-fullwidth owl-carousel">
            <?php while ($event = $carousel_query->fetch_assoc()): ?>
                <div class="item">
                    <a href="ticket-details.php?id=<?php echo $event['id']; ?>">
                        <img src="/resonance/<?php echo htmlspecialchars($event['thumbnail_url']); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>">
                    </a>
                    <div class="overlay">
                        <p class="title"><?php echo htmlspecialchars($event['title']); ?></p>
                        <p class="description">TICKETS ARE ON SALE NOW</p>
                        <a href="ticket-details.php?id=<?php echo $event['id']; ?>" class="btn">GET TICKETS</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Custom Navigation Arrows -->
        <button class="carousel-prev">&#10094;</button>
        <button class="carousel-next">&#10095;</button>

        <!-- Dots Container (Optional) -->
        <div class="custom-dots"></div>
    </div>

    <h2>WHAT'S NEW:</h2>
    <!-- Event Cards Section -->
    <div class="events-container">
        <?php while ($event = $events_query->fetch_assoc()): ?>
            <div class="event-card">
                <?php
                // Mark the event as "New" if it was added in the last 30 days
                $event_date = new DateTime($event['date_time']);
                $now = new DateTime();
                $interval = $event_date->diff($now);
                if ($interval->days <= 30): ?>
                    <span class="new-badge">New</span>
                <?php endif; ?>
                
                <img src="/resonance/<?php echo htmlspecialchars($event['thumbnail_url']); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>">
                <div class="event-details">
                    <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                    <p><?php echo date("d M Y", strtotime($event['date_time'])); ?></p>
                    <a href="ticket-details.php?id=<?php echo $event['id']; ?>" class="btn">Find Tickets</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="banner">
        <div class="overlay"></div>
        <div class="content">
            <h1>SIGN UP TO RESONANCE PRE-SALE</h1>
            <p style="color: white;">Enjoy exclusive perks</p>
            <a href="/login.html" class="btn">SIGN UP NOW! <span class="btn-icon">🔗</span></a>
        </div>
    </div>


    <!-- Venue & Tickets Section -->
    <div class="venue-tickets">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Our Venues & Tickets</h2>
                    </div>
                </div>

                <?php while ($event = $venues_query->fetch_assoc()): ?>
                    <div class="col-lg-4">
                        <div class="venue-item">
                            <div class="thumb">
                                <img src="/resonance/<?php echo htmlspecialchars($event['thumbnail_url']); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>">
                            </div>
                            <div class="down-content">
                                <div class="left-content">
                                    <div class="main-white-button">
                                        <a href="ticket-details.php?id=<?php echo $event['id']; ?>">Purchase Tickets</a>
                                    </div>
                                </div>
                                <div class="right-content">
                                    <h4><?php echo htmlspecialchars($event['title']); ?></h4>
                                    <p><?php echo htmlspecialchars($event['location']); ?></p>
                                    <ul>
                                        <li><i class="fa fa-sitemap"></i><?php echo $event['total_tickets']; ?></li>
                                        <li><i class="fa fa-user"></i><?php echo $event['available_tickets']; ?></li>
                                    </ul>
                                    <div class="price">
                                        <span>1 ticket<br>from <em>₹<?php echo number_format($event['ticket_price'], 2); ?></em></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

            </div>
        </div>
    </div>

    <?php $conn->close(); ?>



    <!-- *** Coming Events ***-->
    <div class="coming-events">
        <div class="left-button">
            <div class="main-white-button">
                <a href="shows-events.html">Discover More</a>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="event-item">
                        <div class="thumb">
                            <a href="event-details.php"><img src="assets/images/jioworld-garden1.jpg" alt=""></a>
                        </div>
                        <div class="down-content">
                            <a href="event-details.php">
                                <h4>Jio World Garden, Mumbai</h4>
                            </a>
                            <ul>
                                <li><i class="fa fa-clock-o"></i> monday to Sunday: 08:00-14:00</li>
                                <li><i class="fa fa-map-marker"></i>No 3 & 4, Jio Garden Public Gate, G Block BKC,
                                    Bandra Kurla Complex, Bandra East, Mumbai, Maharashtra 400051</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="event-item">
                        <div class="thumb">
                            <a href="event-details.php"><img src="assets/images/concerts delhi.webp" alt=""></a>
                        </div>
                        <div class="down-content">
                            <a href="event-details.php">
                                <h4>Delhi stadiums </h4>
                            </a>
                            <ul>
                                <li><i class="fa fa-clock-o"></i> monday to Sunday: 08:00-14:00</li>
                                <li><i class="fa fa-map-marker"></i>Jawaharlal Nehru Stadium</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="event-item">
                        <div class="thumb">
                            <a href="event-details.php"><img src="assets/images/event-03.jpg" alt=""></a>
                        </div>
                        <div class="down-content">
                            <a href="event-details.php">
                                <h4>YMCA Ground, Nandanam, Chennai</h4>
                            </a>
                            <ul>
                                <li><i class="fa fa-clock-o"></i> monday to Sunday: 08:00-14:00</li>
                                <li><i class="fa fa-map-marker"></i> Old No 333, New No 497, Y.M.C.A Collage Of
                                    Physical Education, Anna Salai, Nandanam, Chennai - 600035</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- *** Subscribe *** -->
    <div class="subscribe">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h4>Subscribe Our Newsletter:</h4>
                </div>
                <div class="col-lg-8">
                    <form id="subscribe" action="" method="get">
                        <div class="row">
                            <div class="col-lg-9">
                                <fieldset>
                                    <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*"
                                        placeholder="Your Email Address" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-3">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="main-dark-button">Submit</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
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
            margin: left 30px;
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

    <?php include 'footer.php'; ?>

    
    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/mixitup.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/home.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="assets/js/custom.js"></script>

    <script>
        $(document).ready(function () {
            $(".owl-fullwidth").owlCarousel({
                items: 1,          // One full-width slide at a time
                loop: true,        // Infinite loop
                autoplay: true,    // Auto-slide
                autoplayTimeout: 4000, // Slide duration (4s)
                nav: true,         // Prev/Next buttons
                dots: true,        // Show dots
            });
        });
        $(document).ready(function () {
            var owl = $(".owl-fullwidth").owlCarousel({
                items: 1,
                loop: true,
                autoplay: false,
                nav: false, // Disable default Owl Carousel navigation
                dots: true, // Enable dots
                dotsContainer: '.custom-dots' // Custom dots container
            });

            // Custom navigation
            $(".carousel-prev").click(function () {
                owl.trigger("prev.owl.carousel");
            });

            $(".carousel-next").click(function () {
                owl.trigger("next.owl.carousel");
            });

            // Custom dots functionality
            $(".custom-dots button").click(function () {
                var index = $(this).index();
                owl.trigger("to.owl.carousel", [index, 300]);
            });

            // Update active dot on slide change
            owl.on("changed.owl.carousel", function (event) {
                var index = event.item.index - event.relatedTarget._clones.length / 2;
                $(".custom-dots button").removeClass("active");
                $(".custom-dots button").eq(index).addClass("active");
            });

            // Initialize dots dynamically
            var dotCount = $(".owl-fullwidth .item").length;
            for (var i = 0; i < dotCount; i++) {
                $(".custom-dots").append("<button></button>");
            }
            $(".custom-dots button:first").addClass("active");
        });


    </script>

</body>

</html>