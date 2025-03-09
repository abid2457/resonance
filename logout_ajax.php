<?php
// Check if session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_unset();
session_destroy();
echo "logged out";
?>
