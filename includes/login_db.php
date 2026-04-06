<?php
session_start();
include('db.php');

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    // Verify password
    if(password_verify($password, $user['password'])) {
        // Set session variables like in registration
        $_SESSION['loggedIn'] = true;
        $_SESSION['userId'] = $user['id'];

        echo "success";
    } else {
        echo "Invalid email or password";
    }
} else {
    echo "Invalid email or password";
}