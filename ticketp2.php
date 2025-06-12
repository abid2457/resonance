<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Tooplate">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Resonance Ticket Detail Page</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/tooplate-artxibition.css">
<!--

Resonance

https://www.tooplate.com/view/2125-artxibition

-->
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
                    <span>Hurry up, everyone! The tickets are limited.</span>
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

    <div class="ticket-details-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="left-image">
                        <img src="/assets/images/arijit1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="right-content">
                        <h4>Arijit Singh India Tour 2025 | Mumbai</h4>
                        <span id="tickets-remaining">240 Tickets still available</span>
                        <ul>
                            <li><i class="fa fa-clock-o"></i> March 23 | 6PM</li>
                            <li><i class="fa fa-map-marker"></i> Jio World Garden, Mumbai</li>
                        </ul>
                        <div class="quantity-content">
                            <div class="left-content">
                                <h6>Standard Ticket</h6>
                                <p id="ticket-price" data-price="1599">₹1599 ticket</p>
                            </div>
                            <div class="right-content">
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus">
                                    <input type="number" step="1" min="1" max="08" name="quantity" value="1" title="Qty" class="input-text qty text" size="4">  
                                    <input type="button" value="+" class="plus">
                                </div>
                            </div>
                        </div>
                        <div class="total">
                            <h4>Total: <span id="total-price">₹1599</span></h4>
                            <div class="main-dark-button"><a href="#" id="purchase-tickets">Purchase Tickets</a></div>
                        </div>
                        <div class="warn">
                            <p>*You Can Only Buy 08 Tickets For This Show</p>
                        </div>
                    </div>
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
                              <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email Address" required="">
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
    <script src="assets/js/quantity.js"></script>
    <script src="assets/js/custom.js"></script>
    

  </body>

</html>
