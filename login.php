<?php
session_start();

// Gantikan username dan password hash dengan milik Anda
$storedUsername = '9ffd3736914b612c6e3e7a861d5fe2937b2ac471ed584832c53ce1a7dfb542e4'; // SHA-256 hash of "DevIDepzz"
$storedHashedPassword = '9ffd3736914b612c6e3e7a861d5fe2937b2ac471ed584832c53ce1a7dfb542e4'; // SHA-256 hash of "DevIDepzz"

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = hash('sha256', $_POST['username']);
    $password = hash('sha256', $_POST['password']);

    if ($username === $storedUsername && $password === $storedHashedPassword) {
        $_SESSION['loggedIn'] = true;
        header('Location: osint.php');
        exit();
    } else {
        header('Location: index.html?error=true');
        exit();
    }
} else {
    header('Location: index.html');
    exit();
}
?>
