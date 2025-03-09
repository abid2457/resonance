<?php
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Error: You must be logged in to view your bookings.");
}

$user_id = $_SESSION['user_id'];

// Fetch all bookings for the logged-in user
$query = $conn->prepare("
    SELECT tb.id AS booking_id, tb.event_id, tb.quantity, tb.seat_number, tb.booking_time, 
           e.title, e.location, e.date_time, e.thumbnail_url
    FROM ticket_bookings tb
    JOIN events e ON tb.event_id = e.id
    WHERE tb.user_id = ?
    ORDER BY tb.booking_time DESC
");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

$conn->close();
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
    <title>My Bookings</title>
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

<div class="container mt-5">
    <h2>My Bookings</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Event</th>
                <th>Location</th>
                <th>Date & Time</th>
                <th>Quantity</th>
                <th>Seat Numbers</th>
                <th>Booking Date</th>
                <th>E-Ticket</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($booking = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <img src="/resonance/<?php echo htmlspecialchars($booking['thumbnail_url']); ?>" width="50" alt="Event">
                        <?php echo htmlspecialchars($booking['title']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($booking['location']); ?></td>
                    <td><?php echo date("F j, Y | g A", strtotime($booking['date_time'])); ?></td>
                    <td><?php echo $booking['quantity']; ?></td>
                    <td><?php echo htmlspecialchars($booking['seat_number']); ?></td>
                    <td><?php echo date("F j, Y", strtotime($booking['booking_time'])); ?></td>
                    <td>
                        <a href="generate_ticket.php?booking_id=<?php echo $booking['booking_id']; ?>" class="btn btn-primary btn-sm">
                            Download E-Ticket
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
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


</body>
</html>
