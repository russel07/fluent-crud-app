<?php

namespace FluentCrud\App\Hooks\Handlers;

use FluentCrud\Database\DBMigrator;
use FluentCrud\Database\DBSeeder;

class ActivationHandler
{
    public function handle($network_wide = false)
    {
        DBMigrator::run($network_wide);
        DBSeeder::run();
    }
}
