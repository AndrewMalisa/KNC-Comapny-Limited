<?php
require_once 'config/session.php';
require_once 'includes/products.php';

$products = new Products();
$featured_products = array_slice($products->getAllProducts(), 0, 3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm Fresh Store - Organic Products Direct from Farm</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
</head>
<body class="body-bg">
    <!-- Navigation -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-container">
            <div class="hero-grid">
                <div>
                    <h1 class="hero-title">
                        Fresh From Farm
                        <span class="hero-highlight">To Your Table</span>
                    </h1>
                    <p class="hero-subtitle">
                        Discover the finest organic vegetables, pure honey, and fresh produce grown with love and care on our sustainable farm.
                    </p>
                    <div class="hero-buttons">
                        <a href="products.php" class="btn-primary">Shop Now</a>
                        <a href="#about" class="btn-secondary">Learn More</a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=600&h=500&fit=crop" 
                         alt="Fresh organic produce">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="features-container">
            <div class="section-header">
                <h2 class="section-title">Why Choose Farm Fresh Store?</h2>
                <p class="section-subtitle">
                    We're committed to providing you with the highest quality organic produce while supporting sustainable farming practices.
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-leaf"></i></div>
                    <h3 class="feature-title">100% Organic</h3>
                    <p class="feature-text">All our products are certified organic and grown without harmful pesticides</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-heart"></i></div>
                    <h3 class="feature-title">Farm Fresh</h3>
                    <p class="feature-text">Harvested daily and delivered fresh to ensure maximum nutrition and taste</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-truck"></i></div>
                    <h3 class="feature-title">Fast Delivery</h3>
                    <p class="feature-text">Quick and reliable delivery straight from our farm to your doorstep</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3 class="feature-title">Quality Guaranteed</h3>
                    <p class="feature-text">We stand behind our products with a 100% satisfaction guarantee</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="products-section">
        <div class="products-container">
            <div class="section-header">
                <h2 class="section-title">Featured Products</h2>
                <p class="section-subtitle">Discover our most popular organic products</p>
            </div>

            <div class="products-grid">
                <?php foreach ($featured_products as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" 
                             alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="product-category">
                            <?php echo htmlspecialchars($product['category_name']); ?>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p class="product-desc"><?php echo htmlspecialchars(substr($product['description'], 0, 100)) . '...'; ?></p>
                        <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                        <button onclick="orderViaWhatsApp('<?php echo htmlspecialchars($product['name']); ?>')" 
                                class="btn-whatsapp">
                            <i class="fab fa-whatsapp"></i> Order via WhatsApp
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="products-footer">
                <a href="products.php" class="btn-primary">View All Products</a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-container">
            <h2 class="cta-title">Ready to Experience Farm Fresh Quality?</h2>
            <p class="cta-subtitle">
                Join thousands of satisfied customers who trust us for their organic produce needs.
            </p>
            <a href="signup.php" class="btn-primary">Get Started Today</a>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script>
        function orderViaWhatsApp(productName) {
            const message = `Welcome to our store! I'm interested in ${productName}.`;
            const whatsappUrl = `https://wa.me/255767561957?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        }
    </script>
</body>
</html>
