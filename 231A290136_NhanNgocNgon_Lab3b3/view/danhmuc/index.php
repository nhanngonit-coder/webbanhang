<?php require __DIR__ . '/../header.php'; ?>

<div class="container py-5">
    <h1 class="fw-bold">QUẢN LÝ DANH MỤC</h1>

    <?php if ($message): ?><div class="alert alert-success"><?= e($message) ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h4><?= $edit ? 'Cập nhật danh mục' : 'Thêm danh mục mới' ?></h4>
            <form method="post" action="index.php?action=danhmuc<?= $edit ? '&edit=' . (int)$edit['id'] : '' ?>">
                <input type="hidden" name="type" value="<?= $edit ? 'edit' : 'add' ?>">
                <?php if ($edit): ?><input type="hidden" name="id" value="<?= (int)$edit['id'] ?>"><?php endif; ?>
                <label class="form-label">Tên danh mục</label>
                <input class="form-control mb-3" name="ten_danh_muc" required value="<?= e($edit['ten_danh_muc'] ?? '') ?>">
                <label class="form-label">Mô tả</label>
                <textarea class="form-control mb-3" name="mo_ta" rows="3"><?= e($edit['mo_ta'] ?? '') ?></textarea>
                <button class="btn btn-primary"><?= $edit ? 'Lưu thay đổi' : 'Thêm danh mục' ?></button>
                <?php if ($edit): ?><a href="index.php?action=danhmuc" class="btn btn-secondary">Hủy</a><?php endif; ?>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4>Danh sách danh mục</h4>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark"><tr><th>ID</th><th>Tên danh mục</th><th>Mô tả</th><th>Thao tác</th></tr></thead>
                    <tbody>
                    <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td><?= (int)$cat['id'] ?></td>
                            <td><?= e($cat['ten_danh_muc']) ?></td>
                            <td><?= e($cat['mo_ta']) ?></td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="index.php?action=danhmuc&edit=<?= (int)$cat['id'] ?>">Sửa</a>
                                <form method="post" action="index.php?action=danhmuc" class="d-inline"
                                      onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này?');">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="hidden" name="id" value="<?= (int)$cat['id'] ?>">
                                    <button class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../footer.php'; ?>
