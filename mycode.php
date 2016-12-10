<?php
/*
Plugin Name: Mycode Plugin
Plugin URI:  https::/dorkulous.com/mycode
Description: A place to put my code
Version:     20161205
Author:      Andrew Schnable
Author URI:  https://schnable.org/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wporg
Domain Path: /languages
*/

class mycode
{
    public static function init()
    {
        add_action('woocommerce_payment_complete', array(__CLASS__,'process_order'), 10, 1);
        add_filter('woocommerce_login_redirect',   array(__CLASS__,'login_redirect'));
    }

    public static function activate()
    {
    }

    public static function deactivate()
    {
    }

    public static function uninstall()
    {
    }

    function login_redirect( $redirect_to )
    {
         $redirect_to = home_url();
         return $redirect_to;
    }

    function process_order($order_id)
    {
        $order = new WC_Order( $order_id );
        $myuser_id = (int)$order->user_id;
        $user_info = get_userdata($myuser_id);
        $items = $order->get_items();

        foreach ($items as $item) {
            if ($item['product_id']==24) {
              // Do something clever
            }
        }
        return $order_id;
    }
}

add_action('plugins_loaded', array('mycode', 'init'));
register_activation_hook(__FILE__, array('mycode', 'activate'));
register_deactivation_hook(__FILE__, array('mycode', 'deactivate'));
register_uninstall_hook(__FILE__, array('mycode', 'uninstall'));
