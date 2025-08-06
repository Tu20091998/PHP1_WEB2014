<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="../Css/common.css">
    <link rel="stylesheet" href="../Css/product_detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php if (!is_array($product_detail)) : ?>
        <div class="error-message">
            <h2>Không tìm thấy sản phẩm</h2>
            <p>Sản phẩm bạn tìm kiếm không tồn tại hoặc đã bị xóa.</p>
            <a href="BaseController.php?action=products_display" target="main" class="btn btn-secondary">← Quay lại danh sách</a>
        </div>
    <?php else : ?>
    <div class="product-container">
        <div class="product-hero">
            <div class="product-gallery">
                <img src="<?php echo $product_detail['image']; ?>" alt="<?php echo htmlspecialchars($product_detail['name']); ?>" class="main-image">
            </div>
            
            <div class="product-info">
                <h1 class="product-title"><?php echo htmlspecialchars($product_detail['name']); ?></h1>
                
                <div class="product-meta">
                    <span class="meta-item">
                        <i class="fas fa-star"></i>
                        <span>4.9 (128 đánh giá)</span>
                    </span>
                    <span class="meta-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Còn hàng</span>
                    </span>
                </div>
                
                <div class="price-section">
                    <div class="current-price"><?php echo number_format($product_detail['price'], 0, ',', '.') . ' ₫'; ?></div>
                </div>
                
                <div class="product-actions">
                    <form method="POST" action="../Controllers/BaseController.php?action=cart_add_confirm" style="flex: 1;">
                        <input type="hidden" name="product_id" value="<?php echo $product_detail['id']; ?>">
                        <button type="submit" name="addCart" class="btn btn-primary">
                            <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
                        </button>
                    </form>
                    <a href="BaseController.php?action=products_display" target="main" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>
        </div>

        <!-- ==== BÌNH LUẬN SẢN PHẨM ==== -->
        <div class="product-comments">
            <h2 class="section-title">Bình luận & Đánh giá</h2>

            <?php session_start();
                if (isset($_SESSION['message'])): ?>
                <p style="color: green; text-align: center;"><?= $_SESSION['message'] ?></p>
            <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <!-- Form gửi bình luận -->
            <?php
            if (isset($_SESSION['user_id'])): ?>
                <form action="../Controllers/BaseController.php?action=comment_add_confirm" method="POST" class="comment-form">
                    <input type="hidden" name="product_id" value="<?= $product_detail['id'] ?>">

                    <label for="rating">Đánh giá:</label>
                    <select name="rating" required>
                        <option value="5">5 ⭐️</option>
                        <option value="4">4 ⭐️</option>
                        <option value="3">3 ⭐️</option>
                        <option value="2">2 ⭐️</option>
                        <option value="1">1 ⭐️</option>
                    </select>
                
                    <label for="comment">Bình luận:</label>
                    <textarea name="comment" rows="4" required placeholder="Viết bình luận của bạn..."></textarea>

                    <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                </form>
            <?php else: ?>
                <p>Bạn cần <a href="BaseController.php?action=login_display" class="notice_login">đăng nhập</a> để bình luận.</p>
            <?php endif; ?>
            
            <!-- Danh sách bình luận -->
            <div class="comment-list">
                <?php foreach ($comments as $c): ?>
                    <div class="comment-item">
                        <small><?= $c['created_at'] ?></small>
                        <strong><?= htmlspecialchars($c["fullname"]) ?></strong>
                        <p class="rating">Đã đánh giá <?= $c['rating'] ?>/5 ★</p>
                        <p><?= nl2br(htmlspecialchars($c['comment'])) ?></p>
                    </div>
                <?php endforeach; ?>
                <?php if (empty($comments)): ?>
                    <p>Chưa có bình luận nào. Hãy là người đầu tiên!</p>
                <?php endif; ?>
            </div>
        </div>
            
        
        <div class="product-details">
            <h2 class="section-title">Thông tin sản phẩm</h2>
            <div class="product-description">
                <?php echo nl2br(htmlspecialchars($product_detail['description'])); ?>
            </div>

            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-shield-alt feature-icon"></i>
                    <div>
                        <h4>Bảo hành chính hãng</h4>
                        <p>12 tháng tại các trung tâm bảo hành trên toàn quốc</p>
                    </div>
                </div>
                <div class="feature-item">
                    <i class="fas fa-truck feature-icon"></i>
                    <div>
                        <h4>Miễn phí vận chuyển</h4>
                        <p>Cho đơn hàng từ 500.000đ trong nội thành</p>
                    </div>
                </div>
                <div class="feature-item">
                    <i class="fas fa-undo feature-icon"></i>
                    <div>
                        <h4>Đổi trả dễ dàng</h4>
                        <p>Trong vòng 7 ngày nếu có lỗi từ nhà sản xuất</p>
                    </div>
                </div>
                <div class="feature-item">
                    <i class="fas fa-headset feature-icon"></i>
                    <div>
                        <h4>Hỗ trợ 24/7</h4>
                        <p>Hotline: 1900 1234 - luôn sẵn sàng hỗ trợ</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>