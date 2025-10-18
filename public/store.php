<?php
require_once 'db.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php'); exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$course = trim($_POST['course'] ?? '');
$dob = $_POST['dob'] ?? null;

$errors = [];
if ($name === '') $errors[] = "Name is required.";
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
if ($course === '') $errors[] = "Course is required.";

if ($errors) {
    echo "<p>" . implode('<br>', array_map('htmlspecialchars', $errors)) . "</p>";
    echo '<p><a href="create.php">Back</a></p>';
    exit;
}

$stmt = $mysqli->prepare("INSERT INTO students (name, email, course, dob) VALUES (?, ?, ?, ?)");
if (!$stmt) { die("Prepare failed: " . $mysqli->error); }
$stmt->bind_param('ssss', $name, $email, $course, $dob);
$exec = $stmt->execute();

if (!$exec) {
    // handle duplicate email or other errors
    echo "Error: " . htmlspecialchars($stmt->error);
    echo '<p><a href="create.php">Back</a></p>';
    exit;
}
$stmt->close();
header('Location: index.php');
exit;
