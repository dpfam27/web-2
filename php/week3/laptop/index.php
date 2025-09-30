<?php
// Kết nối DB
include 'connection.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            $stmt = $conn->prepare("INSERT INTO laptops (brand, model, processor, ram, storage, screen_size, price, stock_quantity, image_url) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param(
                "sssissdis",
                $_POST['brand'],
                $_POST['model'],
                $_POST['processor'],
                $_POST['ram'],
                $_POST['storage'],
                $_POST['screen_size'],
                $_POST['price'],
                $_POST['stock_quantity'],
                $_POST['image_url']
            );
            $stmt->execute();
            header("Location: index.php");
            exit();
        
        case 'update':
            $stmt = $conn->prepare("UPDATE laptops 
                                    SET brand=?, model=?, processor=?, ram=?, storage=?, screen_size=?, price=?, stock_quantity=?, image_url=? 
                                    WHERE id=?");
            $stmt->bind_param(
                "sssissdisi",
                $_POST['brand'],
                $_POST['model'],
                $_POST['processor'],
                $_POST['ram'],
                $_POST['storage'],
                $_POST['screen_size'],
                $_POST['price'],
                $_POST['stock_quantity'],
                $_POST['image_url'],
                $_POST['id']
            );
            $stmt->execute();
            header("Location: index.php");
            exit();
        
        case 'delete':
            $stmt = $conn->prepare("DELETE FROM laptops WHERE id=?");
            $stmt->bind_param("i", $_POST['id']);
            $stmt->execute();
            header("Location: index.php");
            exit();
    }
}

// Fetch all laptops
$result = $conn->query("SELECT * FROM laptops ORDER BY id DESC");
$laptops = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $laptops[] = $row;
    }
}

// Get laptop for editing
$editLaptop = null;
if (isset($_GET['edit'])) {
    $stmt = $conn->prepare("SELECT * FROM laptops WHERE id=?");
    $stmt->bind_param("i", $_GET['edit']);
    $stmt->execute();
    $result = $stmt->get_result();
    $editLaptop = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptop Shop Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>🖥️ Laptop Shop Management System</h1>
        
        <!-- Add/Edit Form -->
        <div class="form-container">
            <h2><?php echo $editLaptop ? 'Edit Laptop' : 'Add New Laptop'; ?></h2>
            <form method="POST" action="">
                <input type="hidden" name="action" value="<?php echo $editLaptop ? 'update' : 'add'; ?>">
                <?php if ($editLaptop): ?>
                    <input type="hidden" name="id" value="<?php echo $editLaptop['id']; ?>">
                <?php endif; ?>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="brand">Brand *</label>
                        <input type="text" id="brand" name="brand" value="<?php echo $editLaptop['brand'] ?? ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="model">Model *</label>
                        <input type="text" id="model" name="model" value="<?php echo $editLaptop['model'] ?? ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="processor">Processor *</label>
                        <input type="text" id="processor" name="processor" value="<?php echo $editLaptop['processor'] ?? ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="ram">RAM (GB) *</label>
                        <input type="number" id="ram" name="ram" value="<?php echo $editLaptop['ram'] ?? ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="storage">Storage *</label>
                        <input type="text" id="storage" name="storage" value="<?php echo $editLaptop['storage'] ?? ''; ?>" placeholder="e.g., 512GB SSD" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="screen_size">Screen Size (inches) *</label>
                        <input type="number" step="0.1" id="screen_size" name="screen_size" value="<?php echo $editLaptop['screen_size'] ?? ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="price">Price ($) *</label>
                        <input type="number" step="0.01" id="price" name="price" value="<?php echo $editLaptop['price'] ?? ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="stock_quantity">Stock Quantity *</label>
                        <input type="number" id="stock_quantity" name="stock_quantity" value="<?php echo $editLaptop['stock_quantity'] ?? ''; ?>" required>
                    </div>
                    
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label for="image_url">Image URL</label>
                        <input type="url" id="image_url" name="image_url" value="<?php echo $editLaptop['image_url'] ?? ''; ?>" placeholder="https://example.com/image.jpg">
                    </div>
                </div>
                
                <div>
                    <button type="submit" class="btn btn-primary">
                        <?php echo $editLaptop ? 'Update Laptop' : 'Add Laptop'; ?>
                    </button>
                    <?php if ($editLaptop): ?>
                        <a href="index.php" class="btn btn-cancel">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        
        <!-- Laptop Grid -->
        <?php if (count($laptops) > 0): ?>
            <div class="laptop-grid">
                <?php foreach ($laptops as $laptop): ?>
                    <div class="laptop-card">
                        <?php if ($laptop['image_url']): ?>
                            <img src="<?php echo htmlspecialchars($laptop['image_url']); ?>" alt="<?php echo htmlspecialchars($laptop['model']); ?>" class="laptop-image">
                        <?php else: ?>
                            <div class="laptop-image">No Image</div>
                        <?php endif; ?>
                        
                        <div class="laptop-info">
                            <div class="laptop-brand"><?php echo htmlspecialchars($laptop['brand']); ?></div>
                            <div class="laptop-model"><?php echo htmlspecialchars($laptop['model']); ?></div>
                            <div class="laptop-specs">
                                <div><b>CPU:</b> <?php echo htmlspecialchars($laptop['processor']); ?></div>
                                <div><b>RAM:</b> <?php echo htmlspecialchars($laptop['ram']); ?> GB</div>
                                <div><b>Storage:</b> <?php echo htmlspecialchars($laptop['storage']); ?></div>
                                <div><b>Screen:</b> <?php echo htmlspecialchars($laptop['screen_size']); ?>"</div>
                            </div>
                            <div class="laptop-price">$<?php echo number_format($laptop['price'], 2); ?></div>
                            <div class="laptop-stock">
                                <?php 
                                    $stock = $laptop['stock_quantity'];
                                    if ($stock == 0) {
                                        echo '<span class="out-of-stock">Out of Stock</span>';
                                    } elseif ($stock < 5) {
                                        echo '<span class="low-stock">' . $stock . ' units (Low)</span>';
                                    } else {
                                        echo '<span class="in-stock">' . $stock . ' units</span>';
                                    }
                                ?>
                            </div>
                            <div class="laptop-actions">
                                <a href="?edit=<?php echo $laptop['id']; ?>">
                                    <button class="btn btn-edit">Edit</button>
                                </a>
                                <form method="POST" action="" onsubmit="return confirm('Delete this laptop?');">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $laptop['id']; ?>">
                                    <button type="submit" class="btn btn-delete">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-laptops">No laptops in the database. Add your first laptop above!</p>
        <?php endif; ?>
    </div>
</body>
</html>
