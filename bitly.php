<?php
/*
Plugin Name: Bit.ly Shortlinks
Version: 0.2
Plugin URI: http://yoast.com/wordpress/bitly-shortlinks/
Description: Use Bit.ly shortlinks instead of the shortlink WP generates. Works with Bit.ly Pro too, so you can immediately use the right URL.
Author: Joost de Valk
Author URI: http://yoast.com/
*/

function yoast_bitly_shortlink($url, $id, $context, $allow_slugs) {
	if ( ( is_singular() && !is_preview() ) || $context == 'post' ) {
		$short = get_post_meta($id, '_yoast_bitlylink', true);
		if ( !$short || $short == '' ) {
			if ( !defined('BITLY_USERNAME') || !defined('BITLY_APIKEY') ) {
				$short = 'http://yoast.com/wordpress/bitly-shortlinks/configure-bitly/';
			} else {
				$url = get_permalink( $id );
				$req = 'http://api.bit.ly/v3/shorten?format=txt&longUrl='.$url.'&login='.BITLY_USERNAME.'&apiKey='.BITLY_APIKEY;
				if ( defined('BITLY_JMP') && BITLY_JMP )
					$req .= '&domain=j.mp';
				$resp = wp_remote_get( $req );
				if ( !is_wp_error( $resp ) && is_array( $resp['response'] ) && 200 == $resp['response']['code'] ) {
					$short = trim( $resp['body'] );
					update_post_meta( $id, '_yoast_bitlylink', $short);
				}
			}
		}
		return $short;
	}
	return false;
}
add_filter( 'pre_get_shortlink', 'yoast_bitly_shortlink', 99, 4 );

function yoast_bitly_admin_bar_menu() {
	global $wp_admin_bar, $post;

	if ( !isset($post->ID) )
		return;
		
	$short = wp_get_shortlink( $post->ID, 'query' );
	
	if ( is_singular() && !is_preview() ) {
		if ( $short != 'http://yoast.com/wordpress/bitly-shortlinks/configure-bitly/' )
			$shortstats = $short.'+';

		// Remove the old shortlink menu, because it has some weird JS issues with admin bar when giving it submenu's.
		$wp_admin_bar->remove_menu('get-shortlink');
		$wp_admin_bar->add_menu( array( 'id' => 'shortlink', 'title' => __( 'Bit.ly' ), 'href' => 'javascript:prompt(&#39;Short Link:&#39;, &#39;'.$short.'&#39;); return false;' ) );
		$wp_admin_bar->add_menu( array( 'parent' => 'shortlink', 'id' => 'yoast_bitly-link', 'title' => __( 'Bit.ly Link' ), 'href' => 'javascript:prompt(&#39;Short Link:&#39;, &#39;'.$short.'&#39;); return false;' ) );
		$wp_admin_bar->add_menu( array( 'parent' => 'shortlink', 'id' => 'yoast_bitly-twitterlink', 'title' => __( 'Share on Twitter' ), 'href' => 'http://twitter.com/?status='.str_replace('+','%20', urlencode( $post->post_title.' - '.$short) ) ) );
		$wp_admin_bar->add_menu( array( 'parent' => 'shortlink', 'id' => 'yoast_bitly-stats', 'title' => __( 'Bit.ly Stats' ), 'href' => $shortstats, 'meta' => array('target' => '_blank') ) );
	}
}
add_action( 'admin_bar_menu', 'yoast_bitly_admin_bar_menu', 95 );