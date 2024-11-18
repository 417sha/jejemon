<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "db_sdshoppe");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch product details
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $sql = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE products SET product_name = ?, price = ?, quantity = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdii", $product_name, $price, $quantity, $product_id);

    if ($stmt->execute()) {
        echo "Product updated successfully.";
        header("Location: product_list.php");
        exit;
    } else {
        echo "Error updating product: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<link rel="stylesheet" href="edit_product.css">
<html>
   

<head>
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST">
        <label>Product Name:</label>
        <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required><br>
        <label>Price:</label>
        <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required><br>
        <label>Quantity:</label>
        <input type="number" name="quantity" value="<?= $product['quantity'] ?>" required><br>
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>
