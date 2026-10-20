<?php require __DIR__ . '/../header.php'; ?>

<div class="container py-5">
    <div class="card shadow-sm border-0 mx-auto form-card">
        <div class="card-body p-4">
            <h2 class="fw-bold mb-4"><?= $isEdit ? 'SỬA SẢN PHẨM' : 'THÊM SẢN PHẨM' ?></h2>
            <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>

            <form method="post">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Tên sản phẩm</label>
                        <input class="form-control" name="Name" required value="<?= e($product['Name'] ?? '') ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Giá sản phẩm</label>
                        <input class="form-control" type="number" name="Price" min="0" step="0.01" required value="<?= e($product['Price'] ?? 0) ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ngày nhập</label>
                        <input class="form-control" type="date" name="Date_import" required value="<?= e($product['Date_import'] ?? date('Y-m-d')) ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Số lượng</label>
                        <input class="form-control" type="number" name="Mount" min="0" step="1" required value="<?= e($product['Mount'] ?? 0) ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Giảm giá (%)</label>
                        <input class="form-control" type="number" name="Sale" min="0" max="100" step="0.01" required value="<?= e($product['Sale'] ?? 0) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Danh mục</label>
                        <select class="form-select" name="id_danhmuc" required>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= (int)$cat['id'] ?>"
                                    <?= ((int)($product['id_danhmuc'] ?? 0) === (int)$cat['id']) ? 'selected' : '' ?>>
                                    <?= e($cat['ten_danh_muc']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Đường dẫn hình ảnh</label>
                        <input class="form-control" name="image" value="<?= e($product['image'] ?? '') ?>" placeholder="Image/cpu.jpg">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea class="form-control" name="Decribe" rows="5"><?= e($product['Decribe'] ?? '') ?></textarea>
                    </div>
                </div>
                <button class="btn btn-primary"><?= $isEdit ? 'Cập nhật' : 'Thêm sản phẩm' ?></button>
                <a class="btn btn-secondary" href="index.php">Quay lại</a>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../footer.php'; ?>
