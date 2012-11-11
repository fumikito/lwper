<?php
/**
 * 投稿の順序を変更する
 * @param WP_Query $wp_query
 */
function _lwper_preg_get_posts($wp_query){
	if($wp_query->is_main_query() && is_category(array('関数リファレンス', 'アクションフック', 'フィルターフック', 'APIリファレンス'))){
		add_filter('posts_orderby', '_lwper_post_order');
	}
}
add_action('pre_get_posts', '_lwper_preg_get_posts');

/**
 * 投稿の順序を名前順にする
 * @global wpdb $wpdb
 * @param string $order
 * @return string
 */
function _lwper_post_order($order){
	global $wpdb;
	remove_filter('posts_orderby', '_lwper_post_order');
	return " {$wpdb->posts}.post_title ASC";
}