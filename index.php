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
