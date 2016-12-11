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
        // error_log("mycode::init");
        add_filter('woocommerce_login_redirect',    array(__CLASS__,'login_redirect'));

        // For now, log all of these so we can work out the workflow triggers

        add_action('woocommerce_payment_complete',        array(__CLASS__,'process_order'));

        add_action('woocommerce_order_status_cancelled',  array(__CLASS__,'order_status'));
        add_action('woocommerce_order_status_refunded',   array(__CLASS__,'order_status'));
        add_action('woocommerce_order_status_on-hold',     array(__CLASS__,'order_status'));
        add_action('woocommerce_order_status_processing', array(__CLASS__,'order_status'));
        add_action('woocommerce_order_status_failed',     array(__CLASS__,'order_status'));
        add_action('woocommerce_order_status_pending',    array(__CLASS__,'order_status'));
        add_action('woocommerce_order_status_completed',  array(__CLASS__,'order_status'));
        add_action('woocommerce_checkout_order_processed',array(__CLASS__,'order_status'));
    }

    public static function activate()
    {
        error_log("mycode::activate");
    }

    public static function deactivate()
    {
        error_log("mycode::deactivate");
    }

    public static function uninstall()
    {
        error_log("mycode::uninstall");
    }

    function login_redirect( $redirect_to )
    {
        error_log("mycode::login_redirect");
        $redirect_to = home_url();
        return $redirect_to;
    }

    function _log_order($order_id)
    {
        $order = new WC_Order( $order_id );
        $status = $order->status;

        $user_id = (int)$order->user_id;
        $user_info = get_userdata($user_id);
        $items = $order->get_items();

        error_log("mycode::_log_order: status: $status, user: $user_id, item count: " . count($items));

        // foreach ($items as $item) {
            // error_log("mycode::_log_order: item: " .  json_encode($item));
        // }
    }

    function order_status($order_id)
    {
        error_log("mycode::order_status");
        self::_log_order($order_id);
        return $order_id;
    }

    function process_order($order_id)
    {
        error_log("mycode::process_order");
        self::_log_order($order_id);
        return $order_id;
    }
}

add_action('plugins_loaded',         array('mycode', 'init'));
register_activation_hook(__FILE__,   array('mycode', 'activate'));
register_deactivation_hook(__FILE__, array('mycode', 'deactivate'));
register_uninstall_hook(__FILE__,    array('mycode', 'uninstall'));
