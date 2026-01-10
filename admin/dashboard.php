<?php
require_once "../includes/auth.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard | RESSINIQ</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{font-family:Inter,Arial;background:#f6f7fb;padding:2rem}
.card{background:#fff;padding:2rem;border-radius:16px;max-width:600px;margin:auto}
a{display:block;margin-top:1rem;text-decoration:none;color:#4f46e5;font-weight:600}
</style>
</head>
<body>
<div class="card">
<h2>Welcome, <?= $_SESSION["admin_name"] ?></h2>
<a href="categories.php">Manage Categories</a>
<a href="products.php">Manage Products</a>
<a href="logout.php">Logout</a>
</div>
</body>
</html>
