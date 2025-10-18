require_once 'db.php';
$stmt = $mysqli->prepare("SELECT id, name, email, course, dob, created_at FROM students ORDER BY id DESC");
$stmt->execute();
$result = $stmt->get_result();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Students - Simple CRUD</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="wrap">
    <h1>Students</h1>
    <p><a class="btn" href="create.php">+ Add Student</a></p>

    <table>
      <thead>
        <tr><th>#</th><th>Name</th><th>Email</th><th>Course</th><th>DOB</th><th>Added</th><th>Action</th></tr>
      </thead>
      <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?=htmlspecialchars($row['id'])?></td>
          <td><?=htmlspecialchars($row['name'])?></td>
          <td><?=htmlspecialchars($row['email'])?></td>
          <td><?=htmlspecialchars($row['course'])?></td>
          <td><?=htmlspecialchars($row['dob'])?></td>
          <td><?=htmlspecialchars($row['created_at'])?></td>
          <td>
            <a href="edit.php?id=<?=urlencode($row['id'])?>" class="link">Edit</a>
            <form method="post" action="delete.php" style="display:inline" onsubmit="return confirm('Delete this record?');">
              <input type="hidden" name="id" value="<?=htmlspecialchars($row['id'])?>">
              <button type="submit" class="link-btn">Delete</button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>