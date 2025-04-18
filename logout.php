<?php
session_start();

// Destroy the session to log out the user
session_unset();
session_destroy();

header("Location: ../index.html"); // Redirect to login page
exit();
?>
