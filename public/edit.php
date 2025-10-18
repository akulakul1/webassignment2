<?php
require_once 'db.php';
$id = intval($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: index.php'); exit; }

$stmt = $mysqli->prepare("SELECT id, name, email, course, dob FROM students WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
if (!$row) { echo "Record not found. <a href='index.php'>Back</a>"; exit; }
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Student</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="wrap">
    <h1>Edit Student</h1>
    <form method="post" action="update.php">
      <input type="hidden" name="id" value="<?=htmlspecialchars($row['id'])?>">
      <label>Name<br><input type="text" name="name" required maxlength="100" value="<?=htmlspecialchars($row['name'])?>"></label>
      <label>Email<br><input type="email" name="email" required maxlength="150" value="<?=htmlspecialchars($row['email'])?>"></label>
      <label>Course<br><input type="text" name="course" required maxlength="100" value="<?=htmlspecialchars($row['course'])?>"></label>
      <label>DOB<br><input type="date" name="dob" value="<?=htmlspecialchars($row['dob'])?>"></label>
      <div class="actions">
        <button type="submit">Update</button>
        <a class="btn" href="index.php">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>
