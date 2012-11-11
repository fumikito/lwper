<?php
/**
 * 管理バー
 */

/**
 * アドミンバーを常に表示
 * @return boolean
 */
function _lwper_show_admin_bar(){
	return true;
}
add_filter( 'show_admin_bar', '_lwper_show_admin_bar' , 1000 );


/**
 * アドミンバーの表示を修正
 * @global array $hametuha_userpage_slug
 * @param WP_Admin_Bar $wp_adminb_bar
 */
function _lwper_adminbar_fix($wp_admin_bar){
	//ログインしていないユーザー
	if(!is_user_logged_in()){
		$wp_admin_bar->add_menu(array(
			'parent' => 'top-secondary',
			'id' => 'my-account',
			'title' => 'こんにちはゲストさん！'
		));
		$wp_admin_bar->add_group(array(
			'parent' => 'my-account',
			'id' => 'user-actions'
		));
		if(is_singular()){
			$url = wp_login_url(get_permalink());
		}else{
			$url = wp_login_url();
		}
		$wp_admin_bar->add_menu(array(
			'id' => 'adminbar-login',
			'parent' => 'user-actions',
			'title' => 'ログイン',
			'href' => $url
		));
		$wp_admin_bar->add_menu(array(
			'id' => 'adminbar-register',
			'parent' => 'user-actions',
			'title' => '新規登録',
			'href' => preg_replace("/^.*href=\"([^\"]+)\".*$/", "$1", wp_register('', '', false))
		));
	}
}
add_action( 'admin_bar_menu', '_lwper_adminbar_fix', 10000);