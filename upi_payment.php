<?php
// Check if session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';

if (!isset($_GET['event_id'], $_GET['quantity'], $_GET['transaction_id'])) {
    die("Invalid request.");
}

$event_id = intval($_GET['event_id']);
$quantity = intval($_GET['quantity']);
$transaction_id = trim($_GET['transaction_id']);
$user_id = $_SESSION['user_id']; // Ensure user is logged in

if (empty($transaction_id)) {
    die("Error: Transaction ID is required.");
}

// Check if the transaction ID is already used
$check_query = $conn->prepare("SELECT id FROM payments WHERE payment_id = ?");
$check_query->bind_param("s", $transaction_id);
$check_query->execute();
$check_query->store_result();
if ($check_query->num_rows > 0) {
    die("Error: This transaction ID is already used.");
}

// Fetch event details
$query = $conn->prepare("SELECT title, ticket_price, available_tickets FROM events WHERE id = ?");
$query->bind_param("i", $event_id);
$query->execute();
$result = $query->get_result();
$event = $result->fetch_assoc();

if (!$event) {
    die("Error: Event not found.");
}

if ($quantity > $event['available_tickets']) {
    die("Error: Not enough tickets available.");
}

// Fetch user details
$query = $conn->prepare("SELECT first_name, last_name, email FROM users WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Error: User not found.");
}

$full_name = $user['first_name'] . ' ' . $user['last_name'];
$email = $user['email'];
$amount = $quantity * $event['ticket_price'];

// Insert payment into `payments` table
$stmt = $conn->prepare("INSERT INTO payments (user_id, event_id, payment_id, amount) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iisd", $user_id, $event_id, $transaction_id, $amount);
$stmt->execute();

// Find the last assigned seat number
$seat_query = $conn->query("SELECT seat_number FROM ticket_bookings WHERE event_id = $event_id ORDER BY id DESC LIMIT 1");

$last_seat_number = 0;
if ($seat_query && $seat_query->num_rows > 0) {
    $last_row = $seat_query->fetch_assoc();
    $last_seat = explode(", ", $last_row['seat_number']);
    $last_seat_number = (int) str_replace("S", "", end($last_seat)); // Get the last seat number
}

// Assign new seat numbers correctly
$seat_numbers = [];
for ($i = 1; $i <= $quantity; $i++) {
    $new_seat_number = "S" . str_pad($last_seat_number + $i, 3, '0', STR_PAD_LEFT);
    $seat_numbers[] = $new_seat_number;
}

$seat_list = implode(", ", $seat_numbers); // Convert array to string

// Insert booking into `ticket_bookings`
$stmt = $conn->prepare("INSERT INTO ticket_bookings (user_id, event_id, name, email, quantity, seat_number) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iissis", $user_id, $event_id, $full_name, $email, $quantity, $seat_list);
$stmt->execute();

// Update available tickets
$conn->query("UPDATE events SET available_tickets = available_tickets - $quantity WHERE id = $event_id");

// Redirect to ticket-details page with success message
header("Location: ticket-details.php?id=$event_id&success=1&seats=$seat_list");
exit();

$stmt->close();
$conn->close();
?>
