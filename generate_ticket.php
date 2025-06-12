<?php
require_once __DIR__ . '/vendor/autoload.php'; // Composer autoload
include 'db.php';
require_once __DIR__ . '/vendor/tecnickcom/tcpdf/tcpdf.php'; // ✅ Use correct path


use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Writer\PngWriter;

if (!isset($_GET['booking_id'])) {
    die("Error: Booking ID is required.");
}

$booking_id = intval($_GET['booking_id']);

// Fetch booking details
$query = $conn->prepare("SELECT * FROM ticket_bookings WHERE id = ?");
$query->bind_param("i", $booking_id);
$query->execute();
$result = $query->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    die("Error: Booking not found.");
}

// Fetch event details
$query = $conn->prepare("SELECT * FROM events WHERE id = ?");
$query->bind_param("i", $booking['event_id']);
$query->execute();
$result = $query->get_result();
$event = $result->fetch_assoc();

if (!$event) {
    die("Error: Event not found.");
}

$conn->close();

// Generate QR Code
$qrCodeResult = Builder::create()
    ->writer(new PngWriter()) 
    ->data("Booking ID: " . $booking['id'] . "\nEvent: " . $event['title'] . "\nSeats: " . $booking['seat_number'])
    ->encoding(new Encoding('UTF-8'))
    ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
    ->size(200)
    ->margin(10)
    ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
    ->foregroundColor(new Color(0, 0, 0))
    ->backgroundColor(new Color(255, 255, 255))
    ->build();

$qrCodePath = "tickets/qrcode_" . $booking['id'] . ".png";
$qrCodeResult->saveToFile($qrCodePath);

// Initialize TCPDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Resonance Events');
$pdf->SetTitle('E-Ticket - ' . $event['title']);
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// Generate Ticket Content
$html = '
    <h1 style="text-align: center;">E-Ticket</h1>
    <h2 style="text-align: center;">' . htmlspecialchars($event['title']) . '</h2>
    <p><strong>Name:</strong> ' . htmlspecialchars($booking['name']) . '</p>
    <p><strong>Email:</strong> ' . htmlspecialchars($booking['email']) . '</p>
    <p><strong>Event Date:</strong> ' . date("F j, Y | g A", strtotime($event['date_time'])) . '</p>
    <p><strong>Venue:</strong> ' . htmlspecialchars($event['location']) . '</p>
    <p><strong>Seats:</strong> ' . htmlspecialchars($booking['seat_number']) . '</p>
    <p><strong>Quantity:</strong> ' . $booking['quantity'] . '</p>
    <p><strong>Booking ID:</strong> ' . $booking['id'] . '</p>
    <div style="text-align: center;">
        <img src="' . $qrCodePath . '" width="150px">
    </div>
    <p style="text-align: center;">Scan this QR code for ticket verification.</p>
';

// Write HTML to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output PDF
$pdf->Output("E-Ticket-" . $booking['id'] . ".pdf", "D"); // Force download
exit;
?>
