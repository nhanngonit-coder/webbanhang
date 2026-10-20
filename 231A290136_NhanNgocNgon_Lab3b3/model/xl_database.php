<?php
require_once __DIR__ . '/csdl.php';

class xl_database extends csdl {
    public function layDanhSach(): array {
        $result = $this->conn->query("SELECT * FROM danhmuc ORDER BY id DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function timTheoId(int $id): ?array {
        $stmt = $this->conn->prepare("SELECT * FROM danhmuc WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }
    public function them(string $ten, string $moTa): bool {
        $stmt = $this->conn->prepare("INSERT INTO danhmuc(ten_danh_muc,mo_ta) VALUES(?,?)");
        $stmt->bind_param("ss", $ten, $moTa);
        $ok = $stmt->execute(); $stmt->close(); return $ok;
    }
    public function capNhat(int $id, string $ten, string $moTa): bool {
        $stmt = $this->conn->prepare("UPDATE danhmuc SET ten_danh_muc=?,mo_ta=? WHERE id=?");
        $stmt->bind_param("ssi", $ten, $moTa, $id);
        $ok = $stmt->execute(); $stmt->close(); return $ok;
    }
    public function xoa(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM danhmuc WHERE id=?");
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute(); $stmt->close(); return $ok;
    }
}
