<?php include 'session.php'; ?>
<?php
include 'db.php';

// Fetch the next 3 upcoming events
$query = $conn->query("SELECT * FROM events WHERE date_time >= NOW() ORDER BY date_time ASC LIMIT 3");

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

    <title>Resonance</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/tooplate-artxibition.css">
<!--

Resonance



-->
    </head>
    <style>
        h2{
            text-align: center;
            margin-bottom: 10px;
        }
        .testimonial-container {
            display: flex;
            overflow-x: scroll;
            white-space: nowrap;
            gap: 20px;
            max-width: 1000px;
            margin: 0 auto;
            padding: 10px 0;
            box-sizing: border-box;
        }

        .testimonial-container::-webkit-scrollbar {
            height: 8px;
            background-color: #121212;
        }

        .testimonial-container::-webkit-scrollbar-thumb {
            background-color: #ffcc00;
            border-radius: 4px;
        }

        .testimonial p {
            color: white;
        }
        .testimonial {
            background: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
            display: inline-block;
            box-sizing: border-box;
            word-wrap: break-word; /* Prevent text from overflowing */
            white-space: normal; /* Allow text wrapping */
        }

        .testimonial p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .testimonial .name {
            font-weight: bold;
            color: #ffcc00;
        }

        .stars {
            color: #ffcc00;
        }

        /* Hide the scrollbar when not hovered */
        .testimonial-container {
            scrollbar-width: thin;
            scrollbar-color: transparent transparent;
        }

        /* Show scrollbar on hover */
        .testimonial-container:hover {
            scrollbar-width: auto;
            scrollbar-color: #ffcc00 transparent;
        }

    </style>
    
    <body>
    <!-- header section -->
    <?php include_once('menu_include.php'); ?>

    <!-- ***** About Us Page ***** -->
    <div class="page-heading-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Jio World Garden, Mumbai</h2>
                    <span>March 23 2025</span>
                </div>
            </div>
        </div>
    </div>

    <div class="about-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="left-image">
                        <img src="/assets/images/jioworld-garden1.jpg"alt="party time">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="right-content">
                        <div class="about-map-image">
                            <img src="/assets/images/jiogarden.png" alt="party location">
                        </div>
                        <div class="down-content">
                            <h4>Jio World Garden, Mumbai</h4>
                            <ul>
                                <li>Monday to Sunday </li>
                                <li>3:00PM - 12:00 AM</li>
                            </ul>
                            <span><i class="fa fa-ticket"></i> Tickets Starting From $34.00</span>
                            <div class="main-dark-button">
                                <a href="ticket-details.php">Purchase Tickets</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h2>🎶 What Our Fans Say 🎶</h2>

    <div class="testimonial-container">
        <div class="testimonial">
            <p>“Absolutely mind-blowing! The stage, the lights, the music—everything was perfect. Best night of my life!”</p>
            <div class="stars">★★★★★</div>
            <p class="name">- Rahul Verma</p>
        </div>

        <div class="testimonial">
            <p>“Seamless ticket booking and an amazing concert experience! The energy was unreal. Can’t wait for the next one!”</p>
            <div class="stars">★★★★★</div>
            <p class="name">- Simran Kapoor</p>
        </div>

        <div class="testimonial">
            <p>“The sound quality and visuals were top-notch. It felt like a dream come true to see my favorite artist live!”</p>
            <div class="stars">★★★★★</div>
            <p class="name">- Arjun Mehta</p>
        </div>

        <div class="testimonial">
            <p>“The crowd, the vibe, and the performances were just incredible. Everything was so well-organized. Highly recommended!”</p>
            <div class="stars">★★★★★</div>
            <p class="name">- Neha Sharma</p>
        </div>

        <div class="testimonial">
            <p>“A night to remember! I had the best time with my friends. Thank you for making this such a memorable experience!”</p>
            <div class="stars">★★★★★</div>
            <p class="name">- Vikram Singh</p>
        </div>
    </div>

    <div class="about-upcoming-shows">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <h2>About The Upcoming Show</h2>
                    <p><p>Resonance is your ultimate destination for discovering, experiencing, and connecting with live music events. Whether you're a fan of intimate gigs, massive festivals, or exclusive underground shows, we bring you the latest updates, ticket details, and venue insights—all in one place.

                        Our platform is designed to keep music lovers in sync with the rhythm of the concert scene. Explore upcoming events, book tickets, and immerse yourself in the electrifying energy of live performances.
                        
                        At Resonance, we believe that music is more than just sound—it's an experience. Let the beats, melodies, and unforgettable moments take over as you dive into a world of music like never before.
                        
                        🎶 Stay tuned, stay connected, and let the music resonate!
                        These are <a href="index.php">Homepage</a>, <a href="about.php">About</a>, 
                        <a href="rent-venue.php">Rent a venue</a>, <a href="shows-events.html">shows &amp; events</a>, 
                        <a href="event-details.php">event details</a>, <a href="tickets.php">tickets</a>, and <a href="ticket-details.php">ticket details</a>. 
                        You can feel free to modify any page as you like. If you have any question, please visit our <a href="https://www.tooplate.com/contact" target="_blank">Contact page</a>.</p></p>
                    <h4>Items That Are Restricted</h4>
                    <ul>
                        <li>* Flash Cameras</li>
                        <li>* Food & Drinks</li>
                        <li>* Any kind of flashy objects</li>
                    </ul>
                    <h4>Directions & Car Parking</h4>
                    <p>Getting to the venue is easy, whether you're driving or using public transport. Convenient parking options are available nearby, including on-site parking and designated lots within walking distance. We recommend arriving early to secure a spot, as spaces may fill up quickly on event days.

                        For those using public transport, the venue is well-connected with nearby bus stops and metro stations. Ride-sharing services and taxi drop-off points are also available for added convenience.
                        
                        Plan your route in advance and follow event signage for smooth access. Let’s make your concert experience hassle-free—see you at the show! 
                        </p>
                    <div class="text-button">
                        <a href="https://www.google.com/maps/dir/12.7806467,78.7143056/No+3+%26+4,+Jio+World+Garden,+Jio+Garden+Public+Gate,+G+Block+BKC,+Bandra+Kurla+Complex,+Bandra+East,+Mumbai,+Maharashtra+400051/@15.943585,70.966367,6z/data=!3m1!4b1!4m9!4m8!1m1!4e1!1m5!1m1!1s0x3be7c90064e6b06d:0xa117f6f432847cb3!2m2!1d72.8624436!2d19.0619813?entry=ttu&g_ep=EgoyMDI1MDEyNy4wIKXMDSoASAFQAw%3D%3D">Need Directions? <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="next-shows">
                    <h4><i class="fa fa-clock-o"></i> Get The Next Upcoming Show Tickets</h4>
                    <ul>
                        <?php while ($event = $query->fetch_assoc()): ?>
                            <li>
                                <h5><?php echo htmlspecialchars($event['title']); ?></h5>
                                <span>
                                    <?php echo date("F j", strtotime($event['date_time'])); ?> <br>
                                    <?php echo date("g A", strtotime($event['date_time'])); ?>
                                </span>
                                <div class="icon-button">
                                    <a href="ticket-details.php?id=<?php echo $event['id']; ?>">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="also-like">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>You Might Also Like...</h2>
                </div>
                <div class="col-lg-4">
                    <div class="like-item">
                        <div class="thumb">
                            <a href="event-details.php"><img src="assets/images/like-01.jpg" alt=""></a>
                            <div class="icons">
                                <ul>
                                    <li><a href="event-details.php"><i class="fa fa-arrow-right"></i></a></li>
                                    <li><a href="ticket-details.php"><i class="fa fa-ticket"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="down-content">
                            <span>Sept 10 to 14, 2021</span>
                            <a href="event-details.php"><h4>Wonder Land Music and Arts Festival</h4></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="like-item">
                        <div class="thumb">
                            <a href="event-details.php"><img src="assets/images/like-02.jpg" alt=""></a>
                            <div class="icons">
                                <ul>
                                    <li><a href="event-details.php"><i class="fa fa-arrow-right"></i></a></li>
                                    <li><a href="ticket-details.php"><i class="fa fa-ticket"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="down-content">
                            <span>Oct 11 to 16, 2021</span>
                            <a href="event-details.php"><h4>Big Water Splashing Festival</h4></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="like-item">
                        <div class="thumb">
                            <a href="event-details.php"><img src="assets/images/like-03.jpg" alt=""></a>
                            <div class="icons">
                                <ul>
                                    <li><a href="event-details.php"><i class="fa fa-arrow-right"></i></a></li>
                                    <li><a href="ticket-details.php"><i class="fa fa-ticket"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="down-content">
                            <span>Nov 10 to 18, 2021</span>
                            <a href="event-details.php"><h4>Tiger Dance Hip Hop Festival</h4></a>
                        </div>
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

    <?php include 'footer.php'; ?>

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