<?php

use FluentCrud\Framework\Foundation\Application;
use FluentCrud\App\Hooks\Handlers\ActivationHandler;
use FluentCrud\App\Hooks\Handlers\DeactivationHandler;

return function($file) {

    register_activation_hook($file, function() {
        (new ActivationHandler)->handle();
    });

    register_deactivation_hook($file, function() {
        (new DeactivationHandler)->handle();
    });

    add_action('plugins_loaded', function() use ($file) {
        do_action('fluentcrud_loaded', new Application($file));
    });
};
