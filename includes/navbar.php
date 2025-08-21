<?php
$current_user = getCurrentUser();
?>

<nav class="bg-farm-green-800 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="index.php" class="flex items-center space-x-2">
                    <i class="fas fa-shopping-bag text-2xl"></i>
                    <span class="font-bold text-xl">KNC</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="index.php" class="hover:text-farm-green-200 transition-colors">Home</a>
                <a href="products.php" class="hover:text-farm-green-200 transition-colors">Products</a>
                
                <?php if ($current_user): ?>
                    <a href="profile.php" class="hover:text-farm-green-200 transition-colors">Profile</a>
                    <?php if ($current_user['is_admin']): ?>
                        <a href="admin/index.php" class="hover:text-farm-green-200 transition-colors">Admin</a>
                    <?php endif; ?>
                    <a href="logout.php" class="hover:text-farm-green-200 transition-colors">
                        <i class="fas fa-sign-out-alt mr-1"></i>Logout
                    </a>
                <?php else: ?>
                    <a href="login.php" class="hover:text-farm-green-200 transition-colors">Login</a>
                    <a href="signup.php" class="bg-farm-green-600 hover:bg-farm-green-700 px-4 py-2 rounded-md transition-colors">
                        Sign Up
                    </a>
                <?php endif; ?>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button onclick="toggleMobileMenu()" class="text-white hover:text-farm-green-200">
                    <i class="fas fa-bars text-xl" id="menu-icon"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="index.php" class="block px-3 py-2 hover:bg-farm-green-700 rounded-md">Home</a>
                <a href="products.php" class="block px-3 py-2 hover:bg-farm-green-700 rounded-md">Products</a>
                
                <?php if ($current_user): ?>
                    <a href="profile.php" class="block px-3 py-2 hover:bg-farm-green-700 rounded-md">Profile</a>
                    <?php if ($current_user['is_admin']): ?>
                        <a href="admin/index.php" class="block px-3 py-2 hover:bg-farm-green-700 rounded-md">Admin</a>
                    <?php endif; ?>
                    <a href="logout.php" class="block px-3 py-2 hover:bg-farm-green-700 rounded-md">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="block px-3 py-2 hover:bg-farm-green-700 rounded-md">Login</a>
                    <a href="signup.php" class="block px-3 py-2 hover:bg-farm-green-700 rounded-md">Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobile-menu');
    const icon = document.getElementById('menu-icon');
    
    if (menu.classList.contains('hidden')) {
        menu.classList.remove('hidden');
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-times');
    } else {
        menu.classList.add('hidden');
        icon.classList.remove('fa-times');
        icon.classList.add('fa-bars');
    }
}
</script>
