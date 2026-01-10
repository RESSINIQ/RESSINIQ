<?php
require_once "../includes/auth.php";
require_once "../includes/db.php";

$products = $pdo->query("
  SELECT products.*, categories.name AS category 
  FROM products 
  JOIN categories ON products.category_id = categories.id
  ORDER BY products.created_at DESC
")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<title>Products | Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{font-family:Inter,Arial;background:#f6f7fb;padding:2rem}
.card{background:#fff;padding:2rem;border-radius:16px;max-width:900px;margin:auto}
table{width:100%;border-collapse:collapse}
td,th{padding:0.6rem;border-bottom:1px solid #ddd;font-size:0.9rem}
.status-hidden{color:#ff6b6b;font-weight:600}
.status-visible{color:#2ecc71;font-weight:600}
</style>
</head>
<body>
<div class="card">
<h2>Manage Products</h2>
<a href="add-product.php">+ Add New Product</a>

<table>
<tr>
<th>Name</th>
<th>Category</th>
<th>Type</th>
<th>Status</th>
</tr>

<?php foreach($products as $p): ?>
<tr>
<td><?= $p['name'] ?></td>
<td><?= $p['category'] ?></td>
<td><?= strtoupper($p['type']) ?></td>
<td class="status-<?= $p['status'] ?>">
<?= $p['status'] ?>
</td>
</tr>
<?php endforeach; ?>
</table>

<a href="dashboard.php">← Back</a>
</div>
</body>
</html>
