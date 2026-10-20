CREATE DATABASE IF NOT EXISTS lab1
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE lab1;

DROP TABLE IF EXISTS sanpham;
DROP TABLE IF EXISTS danhmuc;

CREATE TABLE danhmuc (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ten_danh_muc VARCHAR(150) NOT NULL,
    mo_ta TEXT NULL
);

CREATE TABLE sanpham (
    id_sp INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Price DECIMAL(15,2) NOT NULL DEFAULT 0,
    Date_import DATE NOT NULL,
    Viewsp INT NOT NULL DEFAULT 0,
    Decribe TEXT NULL,
    Mount INT NOT NULL DEFAULT 0,
    Sale DECIMAL(5,2) NOT NULL DEFAULT 0,
    image VARCHAR(255) NULL,
    id_danhmuc INT NOT NULL,
    CONSTRAINT fk_sanpham_danhmuc
        FOREIGN KEY (id_danhmuc) REFERENCES danhmuc(id)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

INSERT INTO danhmuc (ten_danh_muc, mo_ta) VALUES
('CPU', 'Bộ vi xử lý cho máy tính'),
('Card đồ họa', 'GPU phục vụ chơi game và đồ họa'),
('RAM', 'Bộ nhớ trong máy tính'),
('Mainboard', 'Bo mạch chủ'),
('Ổ cứng', 'SSD và HDD'),
('Nguồn', 'Bộ nguồn máy tính');

INSERT INTO sanpham
(Name, Price, Date_import, Viewsp, Decribe, Mount, Sale, image, id_danhmuc) VALUES
('Intel Core i5-12400F', 2890000, '2026-10-01', 125, 'CPU Intel Core i5-12400F, 6 nhân 12 luồng.', 10, 5, 'Image/cpu.jpg', 1),
('AMD Ryzen 5 5600', 2390000, '2026-10-02', 98, 'CPU AMD Ryzen 5 5600 dành cho gaming và làm việc.', 8, 0, 'Image/cpu.jpg', 1),
('NVIDIA RTX 4060 8GB', 8490000, '2026-10-03', 210, 'Card đồ họa RTX 4060 8GB hiệu năng tốt cho gaming.', 6, 10, 'Image/gpu.jpg', 2),
('AMD RX 7600 8GB', 7290000, '2026-10-04', 76, 'Card đồ họa AMD RX 7600 8GB.', 5, 5, 'Image/gpu.jpg', 2),
('Kingston Fury 16GB DDR4', 1190000, '2026-10-05', 88, 'RAM DDR4 16GB tốc độ cao.', 15, 0, 'Image/ram.jpg', 3),
('ASUS PRIME B660M-A', 2990000, '2026-10-06', 65, 'Mainboard chipset B660 hỗ trợ CPU Intel thế hệ 12.', 7, 8, 'Image/mainboard.jpg', 4),
('Samsung 980 1TB NVMe', 1890000, '2026-10-07', 143, 'SSD NVMe 1TB tốc độ cao.', 12, 5, 'Image/ssd.jpg', 5),
('Corsair CV650 650W', 1490000, '2026-10-08', 52, 'Nguồn 650W phù hợp PC gaming tầm trung.', 9, 0, 'Image/psu.jpg', 6);
