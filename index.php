<<<<<<< HEAD
<?php
include 'config.php';

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$sql = "SELECT 
 p.id,
 p.name,
 p.description,
 p.price,
 p.stock,
 c.name AS category,
 s.name AS supplier,
 p.created_at
 FROM products p
 JOIN categories c ON p.category_id = c.id
 JOIN suppliers s ON p.supplier_id = s.id
 WHERE 1=1";

if (!empty($search)) {
 $search = $conn->real_escape_string($search);
 $sql .= " AND (p.name LIKE '%$search%' 
 OR p.description LIKE '%$search%')";
}

if (!empty($category)) {
 $category = $conn->real_escape_string($category);
 $sql .= " AND c.name = '$category'";
}

$sql .= " ORDER BY p.id DESC";

$result = $conn->query($sql);

$stats_sql = "SELECT 
 COUNT(*) AS total_products,
 SUM(stock) AS total_stock,
 SUM(price * stock) AS total_value,
 SUM(CASE WHEN stock < 20 THEN 1 ELSE 0 END) AS low_stock
 FROM products p
 JOIN categories c ON p.category_id = c.id
 WHERE 1=1";

if (!empty($search)) {
 $stats_sql .= " AND (p.name LIKE '%$search%' 
 OR p.description LIKE '%$search%')";
}

if (!empty($category)) {
 $stats_sql .= " AND c.name = '$category'";
}

$stats = $conn->query($stats_sql)->fetch_assoc();

$categories = $conn->query("SELECT DISTINCT name FROM categories ORDER BY name");
?>

<!DOCTYPE html>
<html>
<head>
<title>Inventory System</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Product Inventory</h2>

<form method="GET">
 <input type="text" name="search" placeholder="Search..."
 value="<?= htmlspecialchars($search) ?>">

 <select name="category">
 <option value="">All Categories</option>
 <?php while ($c = $categories->fetch_assoc()): ?>
 <option value="<?= $c['name'] ?>"
 <?= ($category == $c['name']) ? 'selected' : '' ?>>
 <?= $c['name'] ?>
 </option>
 <?php endwhile; ?>
 </select>

 <button type="submit">Filter</button>
</form>

<div class="cards">
 <div class="card">
 <strong>Total Products</strong>
 <p><?= $stats['total_products'] ?? 0 ?></p>
 </div>

 <div class="card">
 <strong>Total Stock</strong>
 <p><?= $stats['total_stock'] ?? 0 ?></p>
 </div>

 <div class="card">
 <strong>Total Inventory Value</strong>
 <p>₱<?= number_format($stats['total_value'] ?? 0, 2) ?></p>
 </div>

 <div class="card">
 <strong>Low Stock Items</strong>
 <p><?= $stats['low_stock'] ?? 0 ?></p>
 </div>
</div>

<a href="add.php" class="add-btn">+ Add Product</a>

<table>
<tr>
<th>Name</th>
<th>Description</th>
<th>Price</th>
<th>Stock</th>
<th>Category</th>
<th>Supplier</th>
<th>Created</th>
<th>Actions</th>
</tr>

<?php
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {

$lowStockClass = ($row['stock'] < 20) ? 'low-stock' : '';

echo "<tr class='$lowStockClass'>
<td>{$row['name']}</td>
<td>{$row['description']}</td>
<td>₱" . number_format($row['price'],2) . "</td>
<td>{$row['stock']}</td>
<td>{$row['category']}</td>
<td>{$row['supplier']}</td>
<td>{$row['created_at']}</td>
<td><a href='edit.php?id={$row['id']}'>Edit</a></td>
</tr>";
}
} else {
echo "<tr><td colspan='8'>No products found</td></tr>";
}
?>

</table>

</div>

</body>
</html>
=======
<?php
include 'config.php';
$sql = "SELECT 
            p.name,
            p.description,
            p.price,
            p.stock,
            c.name AS category,
            s.name AS supplier,
            p.created_at
        FROM products p
        JOIN categories c ON p.category_id = c.id
        JOIN suppliers s ON p.supplier_id = s.id
        ORDER BY p.id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Product Inventory</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Stock</th>  
        <th>Category</th>
        <th>Supplier</th>
        <th>Created</th>
    </tr>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['description']}</td>
                <td>₱{$row['price']}</td>
                <td>{$row['stock']}</td>
                <td>{$row['category']}</td>
                <td>{$row['supplier']}</td>
                <td>{$row['created_at']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No products found</td></tr>";
}
?>

</table>

</body>
</html>
>>>>>>> a507a2d203d371159d304771578a19304c8fd5d3
