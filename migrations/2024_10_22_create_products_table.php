<?php

class CreateProductsTable {

    public function up() {
        return "
            CREATE TABLE IF NOT EXISTS products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                price INT NOT NULL,
                description TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";
    }

    public function down() {
        return "DROP TABLE IF EXISTS products;";
    }
}
