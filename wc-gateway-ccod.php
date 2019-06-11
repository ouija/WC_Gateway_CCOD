<?php
/*
 * Plugin Name: WooCommerce Credit Card on Delivery
 * Plugin URI: https://github.com/ouija/WC_Gateway_CCOD
 * Description: Extends WooCommerce by adding a payment option of credit card on delivery.
 * Version: 1.3
 * Requires at least: 4.0
 * Tested up to: 5.0
 * WC requires at least: 2.5
 * WC tested up to: 3.6
 * Author: ouija
 * Author URI: http://ouija.xyz
 * License: GPLv2 or later
 * Text Domain: ccod
 */

/* Initalization */
add_action( 'plugins_loaded', 'ccod_init', 0 );
function ccod_init() {

	/* Checks if WooCommerce is installed and activated */
	if ( ! class_exists( 'WC_Payment_Gateway' ) ) return;
	
	/* Inlcude payment gateway class */
	include_once( 'class-wc-gateway-ccod.php' );

	/* Adds ccod payment gateway */
	add_filter( 'woocommerce_payment_gateways', 'ccod_add_gateway' );
	function ccod_add_gateway( $methods ) {
		$methods[] = 'WC_Gateway_CCOD';
		return $methods;
	}
}

/* Plugin action links */
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'ccod_action_links' );
function ccod_action_links( $links ) {
	$plugin_links = array(
		'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout&section=ccod' ) . '">' . __( 'Settings', 'ccod' ) . '</a>',
	);
	return array_merge( $plugin_links, $links );	
}