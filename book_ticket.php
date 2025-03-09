<?php
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in!");
}

// Get event ID and ticket quantity
$event_id = isset($_POST['event_id']) ? intval($_POST['event_id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

if ($event_id <= 0 || $quantity <= 0) {
    die("Error: Invalid event or ticket quantity.");
}

// 🔹 Fetch event details
$query = $conn->prepare("SELECT title, ticket_price, available_tickets FROM events WHERE id = ?");
if (!$query) {
    die("Error preparing event query: " . $conn->error);
}

$query->bind_param("i", $event_id);
$query->execute();
$result = $query->get_result();

if (!$result) {
    die("Error executing event query: " . $conn->error);
}

$event = $result->fetch_assoc();
if (!$event) {
    die("Error: Event not found.");
}

// Check ticket availability
if ($quantity > $event['available_tickets']) {
    die("Error: Not enough tickets available.");
}

// 🔹 Fetch user details
$user_id = $_SESSION['user_id'];
$query = $conn->prepare("SELECT first_name, last_name, email FROM users WHERE id = ?");
if (!$query) {
    die("Error preparing user query: " . $conn->error);
}

$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

if (!$result) {
    die("Error executing user query: " . $conn->error);
}

$user = $result->fetch_assoc();
if (!$user) {
    die("Error: User not found.");
}

$full_name = $user['first_name'] . ' ' . $user['last_name'];
$email = $user['email'];

// 🔹 Find the highest allocated seat number
$seat_query = $conn->query("SELECT seat_number FROM ticket_bookings WHERE event_id = $event_id ORDER BY id DESC LIMIT 1");

$last_seat_number = 0;
if ($seat_query && $seat_query->num_rows > 0) {
    $last_row = $seat_query->fetch_assoc();
    $last_seat = explode(", ", $last_row['seat_number']);
    $last_seat_number = (int) str_replace("S", "", end($last_seat)); // Get the last seat number
}

// 🔹 Assign new seat numbers correctly
$seat_numbers = [];
for ($i = 1; $i <= $quantity; $i++) {
    $new_seat_number = "S" . str_pad($last_seat_number + $i, 3, '0', STR_PAD_LEFT);
    $seat_numbers[] = $new_seat_number;
}

$seat_list = implode(", ", $seat_numbers); // Convert array to string

// 🔹 Insert booking into database
$stmt = $conn->prepare("INSERT INTO ticket_bookings (user_id, event_id, name, email, quantity, seat_number) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Error preparing insert query: " . $conn->error);
}

$stmt->bind_param("iissis", $user_id, $event_id, $full_name, $email, $quantity, $seat_list);
if (!$stmt->execute()) {
    die("Error inserting booking: " . $stmt->error);
}

// 🔹 Update available tickets
$update = $conn->query("UPDATE events SET available_tickets = available_tickets - $quantity WHERE id = $event_id");
if (!$update) {
    die("Error updating available tickets: " . $conn->error);
}

// 🔹 Final success message
echo "Booking successful! Your seats: " . $seat_list;

$stmt->close();
$conn->close();
?>
