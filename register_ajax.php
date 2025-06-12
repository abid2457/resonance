<?php
include 'db.php';

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$postcode = $_POST['postcode'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password) && !empty($postcode)) {
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, postal_code) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $password, $postcode);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
} else {
    echo "All fields are required!";
}
$conn->close();
?>
