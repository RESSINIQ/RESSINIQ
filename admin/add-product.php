<?php
require_once "../includes/auth.php";
require_once "../includes/db.php";
require_once "../includes/functions.php";

$categories = $pdo->query("SELECT * FROM categories WHERE status='active'")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = clean($_POST["name"]);
  $description = clean($_POST["description"]);
  $materials = clean($_POST["materials"]);
  $category_id = $_POST["category_id"];
  $type = $_POST["type"];

  $imageName = null;
  if (!empty($_FILES["image"]["name"])) {
    $imageName = time()."_".basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], "../assets/uploads/".$imageName);
  }

  $stmt = $pdo->prepare("
    INSERT INTO products 
    (category_id, name, description, materials, type, image)
    VALUES (?,?,?,?,?,?)
  ");
  $stmt->execute([$category_id,$name,$description,$materials,$type,$imageName]);

  header("Location: products.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{font-family:Inter,Arial;background:#f6f7fb;padding:2rem}
.card{background:#fff;padding:2rem;border-radius:16px;max-width:600px;margin:auto}
input,textarea,select,button{width:100%;padding:0.7rem;margin-top:0.7rem}
</style>
</head>
<body>
<div class="card">
<h2>Add Product</h2>

<form method="post" enctype="multipart/form-data">
<input type="text" name="name" placeholder="Product Name" required>

<textarea name="description" placeholder="Description"></textarea>

<input type="text" name="materials" placeholder="Materials">

<select name="type" required>
<option value="">Select Type</option>
<option value="wood">Wood Product</option>
<option value="resin">Resin Product</option>
</select>

<select name="category_id" required>
<option value="">Select Category</option>
<?php foreach($categories as $c): ?>
<option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
<?php endforeach; ?>
</select>

<input type="file" name="image" accept="image/*">

<button>Add Product</button>
</form>

<a href="products.php">← Back</a>
</div>
</body>
</html>

