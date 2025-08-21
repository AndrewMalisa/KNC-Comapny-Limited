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
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'farm-green': {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d'
                        },
                        'earth-brown': {
                            50: '#fdf8f6',
                            100: '#f2e8e5',
                            200: '#eaddd7',
                            300: '#e0cec7',
                            400: '#d2bab0',
                            500: '#bfa094',
                            600: '#a18072',
                            700: '#977669',
                            800: '#846358',
                            900: '#43302b'
                        },
                        'cream': {
                            50: '#fefcfb',
                            100: '#fef7f0',
                            200: '#f7fafc'
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-cream-50">
    <!-- Navigation -->
    <?php include 'includes/navbar.php'; ?>
bg-gradient-to-r from-farm-green-800 to-farm-green-600  
    <!-- Hero Section -->
    <section class="bg-[url(background.jpg)] bg-center bg-cover relative  text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        Fresh From Farm
                        <span class="block text-farm-green-200">To Your Table</span>
                    </h1>
                    <p class="text-xl mb-8 text-farm-green-100">
                        Discover the finest organic vegetables, pure honey, and fresh produce grown with love and care on our sustainable farm.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="products.php" class="bg-earth-brown-600 hover:bg-earth-brown-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors text-center">
                            Shop Now
                        </a>
                        <a href="#about" class="border-2 border-white text-white hover:bg-white hover:text-farm-green-800 px-8 py-3 rounded-lg font-semibold transition-colors text-center">
                            Learn More
                        </a>
                    </div>
                </div>
                <div class="relative md:hidden">
                    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=600&h=500&fit=crop" 
                         alt="Fresh organic produce" 
                         class="rounded-lg shadow-2xl w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-cream-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Why Choose Farm Fresh Store?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    We're committed to providing you with the highest quality organic produce while supporting sustainable farming practices.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex justify-center mb-4">
                        <i class="fas fa-leaf text-4xl text-farm-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">100% Organic</h3>
                    <p class="text-gray-600">All our products are certified organic and grown without harmful pesticides</p>
                </div>

                <div class="text-center bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex justify-center mb-4">
                        <i class="fas fa-heart text-4xl text-farm-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Farm Fresh</h3>
                    <p class="text-gray-600">Harvested daily and delivered fresh to ensure maximum nutrition and taste</p>
                </div>

                <div class="text-center bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex justify-center mb-4">
                        <i class="fas fa-truck text-4xl text-farm-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Fast Delivery</h3>
                    <p class="text-gray-600">Quick and reliable delivery straight from our farm to your doorstep</p>
                </div>

                <div class="text-center bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex justify-center mb-4">
                        <i class="fas fa-shield-alt text-4xl text-farm-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Quality Guaranteed</h3>
                    <p class="text-gray-600">We stand behind our products with a 100% satisfaction guarantee</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Featured Products</h2>
                <p class="text-xl text-gray-600">Discover our most popular organic products</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <?php foreach ($featured_products as $product): ?>
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow overflow-hidden">
                    <div class="aspect-square relative">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" 
                             alt="<?php echo htmlspecialchars($product['name']); ?>" 
                             class="w-full h-full object-cover">
                        <div class="absolute top-2 left-2">
                            <span class="bg-farm-green-600 text-white px-2 py-1 rounded text-sm">
                                <?php echo htmlspecialchars($product['category_name']); ?>
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p class="text-gray-600 mb-4"><?php echo htmlspecialchars(substr($product['description'], 0, 100)) . '...'; ?></p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-2xl font-bold text-farm-green-600">$<?php echo number_format($product['price'], 2); ?></span>
                        </div>
                        <button onclick="orderViaWhatsApp('<?php echo htmlspecialchars($product['name']); ?>')" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors">
                            <i class="fab fa-whatsapp mr-2"></i>Order via WhatsApp
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center">
                <a href="products.php" class="bg-earth-brown-600 hover:bg-earth-brown-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                    View All Products
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-farm-green-800 text-white py-20">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Experience Farm Fresh Quality?</h2>
            <p class="text-xl mb-8 text-farm-green-100">
                Join thousands of satisfied customers who trust us for their organic produce needs.
            </p>
            <a href="signup.php" class="bg-earth-brown-600 hover:bg-earth-brown-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                Get Started Today
            </a>
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
