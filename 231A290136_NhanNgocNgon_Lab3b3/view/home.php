<?php require __DIR__ . '/header.php'; ?>

<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-light text-dark mb-3">LAB 3 - MVC OOP PHP</span>
                <h1 class="display-5 fw-bold">Linh kiện PC chính hãng</h1>
                <p class="lead">CPU, Card đồ họa, RAM, Mainboard, SSD và nguồn cho bộ PC của bạn.</p>
                <a href="#products" class="btn btn-primary btn-lg">Xem sản phẩm</a>
            </div>
        </div>
    </div>
</section>

<div class="container py-5" id="products">
    <?php if (!empty($message = $_SESSION['message'] ?? '')): ?>
        <?php unset($_SESSION['message']); ?>
        <div class="alert alert-success"><?= e($message) ?></div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Sản phẩm</h2>
            <p class="text-muted mb-0">Danh sách sản phẩm được lấy từ MySQL.</p>
        </div>
        <a href="index.php?action=sanpham" class="btn btn-dark">+ Thêm sản phẩm</a>
    </div>

    <div class="mb-4">
        <a href="index.php" class="btn btn-outline-primary btn-sm me-1 mb-2">Tất cả</a>
        <?php foreach ($categories as $cat): ?>
            <a href="index.php?category=<?= (int)$cat['id'] ?>"
               class="btn btn-outline-secondary btn-sm me-1 mb-2">
                <?= e($cat['ten_danh_muc']) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="row g-4">
        <?php if (!$products): ?>
            <div class="col-12"><div class="alert alert-warning">Chưa có sản phẩm.</div></div>
        <?php endif; ?>

        <?php foreach ($products as $p): ?>
            <?php
            $price = (float)$p['Price'];
            $sale = (float)$p['Sale'];
            $finalPrice = $price * (100 - $sale) / 100;
            $image = $p['image'] ?: 'Image/product.svg';
            ?>
            <div class="col-sm-6 col-lg-3">
                <div class="card product-card h-100 border-0 shadow-sm">
                    <img src="view/<?= e($image) ?>" class="card-img-top product-image"
                         alt="<?= e($p['Name']) ?>"
                         onerror="this.src='view/Image/product.svg'">
                    <div class="card-body d-flex flex-column">
                        <span class="small text-muted"><?= e($p['ten_danh_muc']) ?></span>
                        <h5 class="card-title mt-1"><?= e($p['Name']) ?></h5>
                        <p class="small text-secondary flex-grow-1"><?= e($p['Decribe']) ?></p>
                        <?php if ($sale > 0): ?>
                            <div><del class="text-muted"><?= number_format($price, 0, ',', '.') ?> đ</del>
                                <span class="badge bg-danger ms-1">-<?= e($sale) ?>%</span></div>
                        <?php endif; ?>
                        <div class="price"><?= number_format($finalPrice, 0, ',', '.') ?> đ</div>
                        <div class="small text-muted mb-2">Tồn kho: <?= (int)$p['Mount'] ?></div>
                        <div class="d-flex gap-2">
                            <a href="index.php?action=sanpham&id=<?= (int)$p['id_sp'] ?>" class="btn btn-warning btn-sm flex-fill">Sửa</a>
                            <form method="post" action="index.php?action=xoa_sanpham" class="flex-fill"
                                  onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                                <input type="hidden" name="id_sp" value="<?= (int)$p['id_sp'] ?>">
                                <button class="btn btn-danger btn-sm w-100">Xóa</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>
