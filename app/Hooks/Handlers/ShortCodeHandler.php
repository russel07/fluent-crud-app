<?php

namespace FluentCrud\App\Hooks\Handlers;

use FluentCrud\App\Services\AppHelper;
use FluentCrud\App\Hooks\Handlers\AdminMenuHandler;

class ShortCodeHandler
{
    public function renderShortCode(){
        $user = AppHelper::getLoggedInUserInfo();
        $login_page = wp_login_url();
        $needAuthentication = 'You have to log in to access portal click '. "<a href='$login_page'>Here</a> to login";

        $canAccess = apply_filters('fluent_crud_app/user_portal_access', [
            'message' => $needAuthentication
        ]);
        if(!$user){
            echo "<div id='fluent_crud_app' style='text-align: center;'><span class='fluent_crud_need_login'>".$canAccess["message"]."</span></div>";
        }else{
            add_filter('fluent_connector_base_url', function (){
                global $wp;
                $current_url = home_url(add_query_arg(array(), $wp->request));
                return $current_url."#/";
            }, 10, 2);
            return (new AdminMenuHandler())->render();
        }
    }
}
