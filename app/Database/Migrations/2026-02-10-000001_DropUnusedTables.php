<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropUnusedTables extends Migration
{
    public function up()
    {
        $tables = [
            'active_pages',
            'bank_accounts',
            'blog_posts',
            'blog_translations',
            'confirm_links',
            'cookie_law',
            'cookie_law_translations',
            'history',
            'keys',
            'languages',
            'orders',
            'orders_clients',
            'products',
            'products_translations',
            'seo_pages',
            'seo_pages_translations',
            'shop_categories',
            'shop_categories_translations',
            'subscribed',
            'textual_pages_tanslations',
            'transactions',
            'travel',
            'users',
            'users_prev',
            'users_public',
            'value_store',
        ];

        foreach ($tables as $table) {
            if ($this->db->tableExists($table)) {
                $this->forge->dropTable($table, true);
            }
        }
    }

    public function down()
    {
        // These legacy tables are intentionally not re-created.
        // If needed, re-run scripts/mysql_to_postgres.sql for the full schema.
    }
}
