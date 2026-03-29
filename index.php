<?php
/**
 * Home Page - Trang chủ
 * Root entry point
 */

// Include required files
require_once __DIR__ . '/src/config.php';
require_once __DIR__ . '/src/Models/ProductModel.php';
require_once __DIR__ . '/src/Models/CategoryModel.php';
require_once __DIR__ . '/src/Auth.php';
require_once __DIR__ . '/src/helpers.php';

// Initialize
Auth::startSession();

// Get data
$productModel = new ProductModel();
$categoryModel = new CategoryModel();

// Get featured products
$featuredProducts = $productModel->getFeatured(8);

// Get categories with product count
$categories = $categoryModel->getCategoriesWithCount();

// Get active products
$allProducts = $productModel->getActive(ITEMS_PER_PAGE, 0);

// Set page title
$page_title = 'Trang Chủ';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Arcade Clothing Store</title>
    <link rel="stylesheet" href="<?php echo base_url('public/assets/css/main.css'); ?>">
</head>
<body>
    <?php include __DIR__ . '/templates/header.php'; ?>
    <main class="container">
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>Arcade Clothing Store</h1>
                <p>Quần áo thời trang chất lượng cao với giá tốt nhất</p>
                <a href="#products" class="btn btn-primary">Mua Sắm Ngay</a>
            </div>
        </section>
        
        <!-- Categories Section -->
        <section class="categories-section">
            <h2>Danh Mục Sản Phẩm</h2>
            <div class="categories-grid">
                <?php foreach ($categories as $category): ?>
                <a href="<?php echo APP_URL; ?>/products.php?category=<?php echo $category['id']; ?>" class="category-card">
                    <div class="category-image">
                        <?php if ($category['image_url']): ?>
                        <img src="<?php echo UPLOAD_URL . $category['image_url']; ?>" alt="<?php echo htmlspecialchars($category['name']); ?>">
                        <?php else: ?>
                        <div class="placeholder">Ảnh danh mục</div>
                        <?php endif; ?>
                    </div>
                    <h3><?php echo htmlspecialchars($category['name']); ?></h3>
                    <p><?php echo $category['product_count']; ?> sản phẩm</p>
                </a>
                <?php endforeach; ?>
            </div>
        </section>
        
        <!-- Featured Products Section -->
        <?php if ($featuredProducts): ?>
        <section class="featured-section">
            <h2>Sản Phẩm Nổi Bật</h2>
            <div class="products-grid">
                <?php foreach ($featuredProducts as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        <?php if (!empty($product['image_url'])): ?>
                        <img src="<?php echo UPLOAD_URL . htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <?php else: ?>
                        <div class="placeholder">Ảnh sản phẩm</div>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p class="product-price">
                            <?php if (!empty($product['discount_price'])): ?>
                            <span class="old-price"><?php echo formatPrice($product['price']); ?></span>
                            <span class="price"><?php echo formatPrice($product['discount_price']); ?></span>
                            <?php else: ?>
                            <span class="price"><?php echo formatPrice($product['price']); ?></span>
                            <?php endif; ?>
                        </p>
                        <a href="<?php echo APP_URL; ?>/product-detail.php?id=<?php echo $product['id']; ?>" class="btn btn-sm">Xem Chi Tiết</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>
        
        <!-- All Products Section -->
        <section class="products-section" id="products">
            <h2>Tất Cả Sản Phẩm</h2>
            <div class="products-grid">
                <?php foreach ($allProducts as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        <?php if (!empty($product['image_url'])): ?>
                        <img src="<?php echo UPLOAD_URL . htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <?php else: ?>
                        <div class="placeholder">Ảnh sản phẩm</div>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p class="product-price">
                            <?php if (!empty($product['discount_price'])): ?>
                            <span class="old-price"><?php echo formatPrice($product['price']); ?></span>
                            <span class="price"><?php echo formatPrice($product['discount_price']); ?></span>
                            <?php else: ?>
                            <span class="price"><?php echo formatPrice($product['price']); ?></span>
                            <?php endif; ?>
                        </p>
                        <a href="<?php echo APP_URL; ?>/product-detail.php?id=<?php echo $product['id']; ?>" class="btn btn-sm">Xem Chi Tiết</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    
    <?php include __DIR__ . '/templates/footer.php'; ?>
</body>
</html>
