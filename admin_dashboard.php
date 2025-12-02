<?php
session_start();
require_once 'db.php';

// Нэвтрээгүй бол login руу буцаана
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

$success = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price       = trim($_POST['price'] ?? '');
    $image       = trim($_POST['image'] ?? '');

    if ($name === '' || $price === '') {
        $error = 'Кофены нэр болон үнийг заавал бөглөнө үү.';
    } elseif (!is_numeric($price)) {
        $error = 'Үнэ нь тоо байх ёстой (жишээ: 3, 4.5).';
    } else {
        $price = (float)$price;

        $stmt = $conn->prepare("INSERT INTO coffee (name, description, price, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $name, $description, $price, $image);

        if ($stmt->execute()) {
            $success = 'Шинэ coffee амжилттай бүртгэлээ!';
        } else {
            $error = 'Алдаа гарлаа: ' . $conn->error;
        }

        $stmt->close();
    }
}

// Сүүлд бүртгэсэн 10 coffee-г харуулъя
$result = $conn->query("SELECT id, name, price, image, created_at FROM coffee ORDER BY id DESC LIMIT 10");
?>
<!DOCTYPE html>
<html lang="mn">
<head>
  <meta charset="UTF-8">
  <title>Admin – Coffee Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">☕ Admin – Coffee бүртгэх</h1>
    <div>
      <span class="me-2">Сайн байна уу, <strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong></span>
      <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
  </div>

  <?php if ($success): ?>
    <div class="alert alert-success py-2"><?php echo htmlspecialchars($success); ?></div>
  <?php endif; ?>
  <?php if ($error): ?>
    <div class="alert alert-danger py-2"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <div class="card mb-4">
    <div class="card-body bg-secondary">
      <h2 class="h5 mb-3">Шинэ coffee нэмэх</h2>
      <form method="post">
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" placeholder="Espresso" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="2" placeholder="Rich and bold coffee shot."></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Price ($)</label>
          <input type="text" name="price" class="form-control" placeholder="3 or 4.5" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Image file name (optional)</label>
          <input type="text" name="image" class="form-control" placeholder="espresso.jpeg">
          <div class="form-text text-light">
            Зураг чинь <code>image/</code> хавтас дотор байх ёстой (жишээ: image/espresso.jpeg).
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Save coffee</button>
      </form>
    </div>
  </div>

  <h2 class="h5 mb-2">Сүүлд бүртгэсэн coffee-нууд</h2>
  <div class="card">
    <div class="card-body p-0 bg-secondary">
      <table class="table table-dark table-striped mb-0">
        <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Price</th>
          <th>Image</th>
          <th>Created at</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo htmlspecialchars($row['name']); ?></td>
              <td>$<?php echo number_format($row['price'], 2); ?></td>
              <td><?php echo htmlspecialchars($row['image']); ?></td>
              <td><?php echo $row['created_at']; ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center py-3">Одоогоор coffee бүртгээгүй байна.</td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
</body>
</html>