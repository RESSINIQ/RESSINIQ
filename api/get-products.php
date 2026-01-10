<?php
require_once "../includes/db.php";

$stmt = $pdo->query("
  SELECT products.*, categories.name AS category_name 
  FROM products 
  JOIN categories ON products.category_id = categories.id
  WHERE products.status = 'visible'
  AND categories.status = 'active'
  ORDER BY products.created_at DESC
");

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($products);
