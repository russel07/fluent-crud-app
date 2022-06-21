<?php

namespace FluentCrud\Database\Migrations;

class AuthorMigrator
{
    static $tableName = 'fluent_crud_authors';

    public static function migrate()
    {
        global $wpdb;

        $charsetCollate = $wpdb->get_charset_collate();

        $table = $wpdb->prefix . static::$tableName;

        if ($wpdb->get_var("SHOW TABLES LIKE '$table'") != $table) {
            $sql = "CREATE TABLE $table (
                `id` BIGINT(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `first_name` VARCHAR(100) NOT NULL,
                `last_name` VARCHAR(100) NOT NULL,
                `contact_no` VARCHAR(15) NOT NULL,
                `address` TEXT NULL,
                `status` ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Active',
                `created_at` TIMESTAMP NULL,
                `updated_at` TIMESTAMP NULL
            ) $charsetCollate;";
            dbDelta($sql);
        }
    }

}
