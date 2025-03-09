<?php
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($email) && !empty($password)) {
    $stmt = $conn->prepare("SELECT id, first_name, last_name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $first_name, $last_name, $hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $first_name . " " . $last_name;
            echo "success";
        } else {
            echo "Invalid credentials!";
        }
    } else {
        echo "User not found!";
    }
    $stmt->close();
} else {
    echo "All fields are required!";
}
$conn->close();
?>
