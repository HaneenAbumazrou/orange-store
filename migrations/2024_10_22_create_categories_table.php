<?php

class CreateCategoriesTable {

    public function up() {
        return "
            CREATE TABLE IF NOT EXISTS categories (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";
    }

    public function down() {
        return "DROP TABLE IF EXISTS categories;";
    }
}
