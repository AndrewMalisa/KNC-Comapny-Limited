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

    <div class="min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Products</h1>
                <p class="text-xl text-gray-600">Fresh, organic produce straight from our farm</p>
            </div>

            <!-- Category Filter -->
            <div class="mb-8">
                <div class="flex flex-wrap gap-2">
                    <a href="products.php" 
                       class="px-4 py-2 rounded-lg font-medium transition-colors <?php echo empty($selected_category) ? 'bg-farm-green-600 text-white' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50'; ?>">
                        All Products
                    </a>
                    <?php foreach ($categories as $category): ?>
                        <a href="products.php?category=<?php echo urlencode($category['name']); ?>" 
                           class="px-4 py-2 rounded-lg font-medium transition-colors <?php echo $selected_category == $category['name'] ? 'bg-farm-green-600 text-white' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50'; ?>">
                            <?php echo htmlspecialchars($category['name']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Products Grid -->
            <?php if (empty($products)): ?>
                <div class="text-center py-12">
                    <p class="text-xl text-gray-600">No products found in this category.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php foreach ($products as $product): ?>
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
                                <p class="text-gray-600 mb-4 line-clamp-2"><?php echo htmlspecialchars(substr($product['description'], 0, 100)) . '...'; ?></p>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-2xl font-bold text-farm-green-600">Tsh<?php echo number_format($product['price'], 2); ?></span>
                                </div>
                                <button onclick="orderViaWhatsApp('<?php echo htmlspecialchars($product['name']); ?>')" 
                                        class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors">
                                    <i class="fab fa-whatsapp mr-2"></i>Order via WhatsApp
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
