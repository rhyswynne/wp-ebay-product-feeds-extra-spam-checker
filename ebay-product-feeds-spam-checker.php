<?php

/*
Plugin Name:  WP eBay Product Feeds - Extra Spam Checker
Plugin URI:   
Description:  A stronger spam checker for WP eBay Product Feeds
Version:      0.1
Author:       Winwar Media
Author URI:   https://www.winwar.co.uk/?utm_source=author-link&utm_medium=plugin&utm_campaign=ebayfeedsforwordpress
Text Domain:  ebay-feeds-for-wordpress
*/

/**
 * Throttle the Spam Checker
 * 
 * @param  boolean $canview  If the user can or cannot view the feed
 * 
 * @return mixed           $canview (or void if die)
 */
function wpebpf_extra_spam_checker( $canview ) {
	$userip = $_SERVER['REMOTE_ADDR'];

		if ( !empty($userip) ) {
			$reverse_ip = implode(".", array_reverse(explode(".", $UserIP)));

			if ( checkdnsrr($reverse_ip.".sbl.spamhaus.org.", "A") || checkdnsrr($reverse_ip.".xbl.spamhaus.org.", "A") ) {
			return false;
		}
	}
	return $canview;
} add_filter( 'wp_ebay_product_feed_bot_blocker', 'wpebpf_extra_spam_checker', 10, 2 );