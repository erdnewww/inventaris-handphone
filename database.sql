CREATE DATABASE IF NOT EXISTS inventaris_barang;

USE inventaris_barang;

CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(20) NOT NULL UNIQUE,
    nama_barang VARCHAR(100) NOT NULL,
    jumlah INT NOT NULL,
    satuan VARCHAR(20) NOT NULL,
    lokasi VARCHAR(100) NOT NULL
);

INSERT INTO barang
(kode_barang, nama_barang, jumlah, satuan, lokasi)
VALUES
('BRG001', 'IPHONE', 10, 'unit', 'Gudang A'),
('BRG002', 'ASUS', 25, 'unit', 'Gudang A'),
('BRG003', 'INFINIX', 15, 'unit', 'Gudang B');