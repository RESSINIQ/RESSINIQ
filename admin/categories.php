<?php
require_once "../includes/auth.php";
require_once "../includes/db.php";
require_once "../includes/functions.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = clean($_POST["name"]);
  $slug = slugify($name);

  $stmt = $pdo->prepare("INSERT INTO categories (name, slug) VALUES (?,?)");
  $stmt->execute([$name, $slug]);
}

$categories = $pdo->query("SELECT * FROM categories ORDER BY created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<title>Categories | Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{font-family:Inter,Arial;background:#f6f7fb;padding:2rem}
.card{background:#fff;padding:2rem;border-radius:16px;max-width:700px;margin:auto}
input,button{padding:0.6rem;width:100%;margin-top:0.6rem}
table{width:100%;margin-top:1.5rem;border-collapse:collapse}
td,th{padding:0.6rem;border-bottom:1px solid #ddd}
</style>
</head>
<body>
<div class="card">
<h2>Manage Categories</h2>

<form method="post">
<input type="text" name="name" placeholder="Category Name (Wood / Resin)" required>
<button>Add Category</button>
</form>

<table>
<tr><th>Name</th><th>Status</th></tr>
<?php foreach($categories as $c): ?>
<tr>
<td><?= $c['name'] ?></td>
<td><?= $c['status'] ?></td>
</tr>
<?php endforeach; ?>
</table>

<a href="dashboard.php">← Back</a>
</div>
</body>
</html>
