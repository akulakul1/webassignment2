<?php
require_once 'db.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); exit; }

$id = intval($_POST['id'] ?? 0);
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$course = trim($_POST['course'] ?? '');
$dob = $_POST['dob'] ?? null;

$errors = [];
if ($id <= 0) $errors[] = "Invalid ID.";
if ($name === '') $errors[] = "Name is required.";
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
if ($course === '') $errors[] = "Course is required.";

if ($errors) {
    echo "<p>" . implode('<br>', array_map('htmlspecialchars', $errors)) . "</p>";
    echo '<p><a href="edit.php?id=' . urlencode($id) . '">Back</a></p>';
    exit;
}

$stmt = $mysqli->prepare("UPDATE students SET name = ?, email = ?, course = ?, dob = ? WHERE id = ?");
if (!$stmt) { die("Prepare failed: " . $mysqli->error); }
$stmt->bind_param('ssssi', $name, $email, $course, $dob, $id);
$exec = $stmt->execute();

if (!$exec) {
    echo "Error: " . htmlspecialchars($stmt->error);
    echo '<p><a href="edit.php?id=' . urlencode($id) . '">Back</a></p>';
    exit;
}
$stmt->close();
header('Location: index.php');
exit;
