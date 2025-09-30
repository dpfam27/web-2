-- Tạo database
CREATE DATABASE IF NOT EXISTS laptop_shop;
USE laptop_shop;

-- Tạo bảng laptops
CREATE TABLE IF NOT EXISTS laptops (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(100) NOT NULL,
    model VARCHAR(100) NOT NULL,
    processor VARCHAR(100) NOT NULL,
    ram INT NOT NULL,
    storage VARCHAR(100) NOT NULL,
    screen_size DECIMAL(4,1) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock_quantity INT NOT NULL,
    image_url VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Dữ liệu mẫu
INSERT INTO laptops (brand, model, processor, ram, storage, screen_size, price, stock_quantity, image_url)
VALUES
('Dell', 'XPS 13', 'Intel Core i7', 16, '512GB SSD', 13.3, 1200.00, 5, 'images/dell-xps13.webp'),
('Apple', 'MacBook Pro', 'M1', 16, '1TB SSD', 14.0, 2000.00, 3, 'images/macbook-pro.webp'),
('Lenovo', 'ThinkPad X1 Carbon', 'Intel Core i5', 8, '256GB SSD', 14.0, 999.99, 7, 'images/thinkpad.webp');
