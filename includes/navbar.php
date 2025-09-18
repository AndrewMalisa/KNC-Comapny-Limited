<?php
$current_user = getCurrentUser();
?>

<nav class="navbar">
    <div class="container">
        <div class="nav-content">
            <div class="logo">
                <a href="index.php" class="logo-link">
                    <img src="assets/logo.png" alt="KNC Logo" class="logo-image">
                    <!-- <span class="logo-text">KNC</span> -->
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="nav-links">
                <a href="index.php" class="nav-item">Home</a>
                <a href="products.php" class="nav-item">Products</a>
                
                <?php if ($current_user): ?>
                    <a href="profile.php" class="nav-item">Profile</a>
                    <?php if ($current_user['is_admin']): ?>
                        <a href="admin/index.php" class="nav-item">Admin</a>
                    <?php endif; ?>
                    <a href="logout.php" class="nav-item">
                        <i class="fas fa-sign-out-alt mr-1"></i>Logout
                    </a>
                <?php else: ?>
                    <a href="login.php" class="nav-item">Login</a>
                    <a href="signup.php" class="btn-signup">Sign Up</a>
                <?php endif; ?>
            </div>

            <!-- Mobile menu button -->
            <div class="mobile-menu-btn">
                <button onclick="toggleMobileMenu()" class="menu-btn">
                    <i class="fas fa-bars" id="menu-icon"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="mobile-menu hidden">
            <div class="mobile-links">
                <a href="index.php" class="mobile-item">Home</a>
                <a href="products.php" class="mobile-item">Products</a>
                
                <?php if ($current_user): ?>
                    <a href="profile.php" class="mobile-item">Profile</a>
                    <?php if ($current_user['is_admin']): ?>
                        <a href="admin/index.php" class="mobile-item">Admin</a>
                    <?php endif; ?>
                    <a href="logout.php" class="mobile-item">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="mobile-item">Login</a>
                    <a href="signup.php" class="mobile-item">Sign Up</a>
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
