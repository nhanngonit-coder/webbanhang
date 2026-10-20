<?php
class Database {
    private PDO $conn;

    public function __construct() {
        $host = 'localhost';
        $dbname = 'lab1';
        $user = 'root';
        $password = '';

        $this->conn = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
            $user,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }

    public function getCategories(): array {
        return $this->conn->query(
            "SELECT * FROM danhmuc ORDER BY id DESC"
        )->fetchAll();
    }

    public function getCategory(int $id): ?array {
        $stmt = $this->conn->prepare("SELECT * FROM danhmuc WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function addCategory(string $name, string $desc): bool {
        $stmt = $this->conn->prepare(
            "INSERT INTO danhmuc (ten_danh_muc, mo_ta) VALUES (?, ?)"
        );
        return $stmt->execute([$name, $desc]);
    }

    public function updateCategory(int $id, string $name, string $desc): bool {
        $stmt = $this->conn->prepare(
            "UPDATE danhmuc SET ten_danh_muc = ?, mo_ta = ? WHERE id = ?"
        );
        return $stmt->execute([$name, $desc, $id]);
    }

    public function deleteCategory(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM danhmuc WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getProducts(?int $category = null): array {
        if ($category) {
            $stmt = $this->conn->prepare(
                "SELECT s.*, d.ten_danh_muc
                 FROM sanpham s
                 JOIN danhmuc d ON s.id_danhmuc = d.id
                 WHERE s.id_danhmuc = ?
                 ORDER BY s.id_sp DESC"
            );
            $stmt->execute([$category]);
            return $stmt->fetchAll();
        }

        return $this->conn->query(
            "SELECT s.*, d.ten_danh_muc
             FROM sanpham s
             JOIN danhmuc d ON s.id_danhmuc = d.id
             ORDER BY s.id_sp DESC"
        )->fetchAll();
    }

    public function getProduct(int $id): ?array {
        $stmt = $this->conn->prepare(
            "SELECT s.*, d.ten_danh_muc
             FROM sanpham s
             JOIN danhmuc d ON s.id_danhmuc = d.id
             WHERE s.id_sp = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function addProduct(array $p): bool {
        $stmt = $this->conn->prepare(
            "INSERT INTO sanpham
            (Name, Price, Date_import, Viewsp, Decribe, Mount, Sale, image, id_danhmuc)
            VALUES (?, ?, ?, 0, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $p['Name'], $p['Price'], $p['Date_import'], $p['Decribe'],
            $p['Mount'], $p['Sale'], $p['image'], $p['id_danhmuc']
        ]);
    }

    public function updateProduct(int $id, array $p): bool {
        $stmt = $this->conn->prepare(
            "UPDATE sanpham SET
             Name=?, Price=?, Date_import=?, Decribe=?, Mount=?, Sale=?, image=?, id_danhmuc=?
             WHERE id_sp=?"
        );
        return $stmt->execute([
            $p['Name'], $p['Price'], $p['Date_import'], $p['Decribe'],
            $p['Mount'], $p['Sale'], $p['image'], $p['id_danhmuc'], $id
        ]);
    }

    public function deleteProduct(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM sanpham WHERE id_sp = ?");
        return $stmt->execute([$id]);
    }
}
