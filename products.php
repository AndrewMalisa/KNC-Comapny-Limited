<?php
require_once 'config/session.php';
require_once 'includes/products.php';

$products_obj = new Products();
$categories = $products_obj->getCategories();

$selected_category = isset($_GET['category']) ? $_GET['category'] : '';
$category_id = null;

if ($selected_category) {
    foreach ($categories as $category) {
        if ($category['name'] == $selected_category) {
            $category_id = $category['id'];
            break;
        }
    }
}

$products = $products_obj->getAllProducts($category_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - KNC</title>
    <link href="styles.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
</head>
<body class="body-bg">
    <!-- Navigation -->
    <?php include 'includes/navbar.php'; ?>

    <div class="page-section">
        <div class="container">
            <div class="section-header">
                <h1 class="section-title">Our Products</h1>
                <p class="section-subtitle">Fresh, organic produce straight from our farm</p>
            </div>

            <!-- Category Filter -->
            <div class="category-filter">
                <div class="filter-buttons">
                    <a href="products.php" 
                       class="filter-btn <?php echo empty($selected_category) ? 'filter-btn-active' : ''; ?>">
                        All Products
                    </a>
                    <?php foreach ($categories as $category): ?>
                        <a href="products.php?category=<?php echo urlencode($category['name']); ?>" 
                           class="filter-btn <?php echo $selected_category == $category['name'] ? 'filter-btn-active' : ''; ?>">
                            <?php echo htmlspecialchars($category['name']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Products Grid -->
            <?php if (empty($products)): ?>
                <div class="empty-products">
                    <p>No products found in this category.</p>
                </div>
            <?php else: ?>
                <div class="products-grid">
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <div class="product-image">
                                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" 
                                     alt="<?php echo htmlspecialchars($product['name']); ?>">
                                <div class="product-category">
                                    <span><?php echo htmlspecialchars($product['category_name']); ?></span>
                                </div>
                            </div>
                            <div class="product-details">
                                <h3 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h3>
                                <p class="product-desc"><?php echo htmlspecialchars(substr($product['description'], 0, 100)) . '...'; ?></p>
                                <div class="product-meta">
                                    <span class="product-price">Tsh<?php echo number_format($product['price'], 2); ?></span>
                                </div>
                                <button onclick="orderViaWhatsApp('<?php echo htmlspecialchars($product['name']); ?>')" 
                                        class="btn-whatsapp">
                                    <i class="fab fa-whatsapp"></i> Order via WhatsApp
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script>
        function orderViaWhatsApp(productName) {
            const message = `Welcome to our store! I'm interested in ${productName}.`;
            const whatsappUrl = `https://wa.me/1234567890?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        }
    </script>
</body>
</html>
