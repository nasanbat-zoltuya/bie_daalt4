<?php
session_start();
require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = 'Нэвтрэх нэр болон нууц үгээ бөглөнө үү.';
    } else {
        $stmt = $conn->prepare("SELECT id, username, password FROM admin WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            // Одоохондоо plaintext шалгалт: DB-д password = 1234
            if ($password === $row['password']) {
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['admin_username'] = $row['username'];

                header("Location: admin_dashboard.php");
                exit;
            } else {
                $error = 'Нууц үг буруу байна.';
            }
        } else {
            $error = 'Ийм хэрэглэгч байхгүй байна.';
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="mn">
<head>
  <meta charset="UTF-8">
  <title>Admin Login – Coffee Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body bg-secondary text-light">
          <h1 class="h4 mb-3 text-center">🔐 Admin Login</h1>

          <?php if ($error): ?>
            <div class="alert alert-danger py-2"><?php echo htmlspecialchars($error); ?></div>
          <?php endif; ?>

          <form method="post">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
        </div>
      </div>
      <p class="text-center mt-3">
        <a href="index.php?page=home" target="_blank" class="text-decoration-none text-light">
          ← Back to Coffee Shop
        </a>
      </p>
    </div>
  </div>
</div>
</body>
</html>