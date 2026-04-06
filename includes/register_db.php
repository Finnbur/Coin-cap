<?php
session_start();
include('db.php');

$email = $_POST['email'];
$password = $_POST['password'];
$rePassword = $_POST['rePassword'];

if($password !== $rePassword) {
    echo "Passwords do not match";
    exit;
}

// Check if email already exists
$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0) {
    echo "Email already registered";
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$insert = "INSERT INTO users (email, password) VALUES ('$email', '$hashedPassword')";

if(mysqli_query($con, $insert)) {
    $_SESSION['loggedIn'] = true;
    $_SESSION['email'] = $user['id'];

    echo "success";
} else {
    echo "Failed to register: " . mysqli_error($con);
}