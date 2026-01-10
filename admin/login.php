<?php
require_once "../includes/db.php";
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
  $stmt->execute([$email]);
  $admin = $stmt->fetch();

  if ($admin && password_verify($password, $admin["password"])) {
    $_SESSION["admin_id"] = $admin["id"];
    $_SESSION["admin_name"] = $admin["name"];
    header("Location: dashboard.php");
    exit;
  } else {
    $error = "Invalid credentials";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login | RESSINIQ</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{font-family:Inter,Arial;background:#0a0b10;color:#fff;display:flex;justify-content:center;align-items:center;height:100vh}
form{background:#11131a;padding:2rem;border-radius:14px;width:320px}
input,button{width:100%;padding:0.7rem;margin-top:1rem;border-radius:8px;border:none}
button{background:#4f46e5;color:#fff;font-weight:600}
.error{color:#ff6b6b;font-size:0.9rem}
</style>
</head>
<body>
<form method="post">
<h2>RESSINIQ Admin</h2>
<?php if($error): ?><p class="error"><?= $error ?></p><?php endif; ?>
<input type="email" name="email" placeholder="Admin Email" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Login</button>
</form>
</body>
</html>
