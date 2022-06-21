<?php

namespace FluentCrud\Database\Migrations;

class BookMigrator
{
    static $tableName = 'fluent_crud_books';

    public static function migrate()
    {
        global $wpdb;

        $charsetCollate = $wpdb->get_charset_collate();

        $table = $wpdb->prefix . static::$tableName;

        if ($wpdb->get_var("SHOW TABLES LIKE '$table'") != $table) {
            $sql = "CREATE TABLE $table (
                `id` BIGINT(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `author_id` BIGINT(20) UNSIGNED NOT NULL,
                `book_title` VARCHAR(100) NOT NULL,
                `book_type` VARCHAR(50) NOT NULL,
                `book_description` TEXT NULL,
                `status` ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Active',
                `created_at` TIMESTAMP NULL,
                `updated_at` TIMESTAMP NULL
            ) $charsetCollate;";
            dbDelta($sql);
        }
    }
}
