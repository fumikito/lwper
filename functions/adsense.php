<?php

/**
 * ヘッダーにGoogle Adsenseを出力する
 */
function _lwper_echo_header(){
	if(!(function_exists('wp_is_mobile') && wp_is_mobile())){
		echo '<div class="lwper-header-ad">';
		dynamic_sidebar('sidebar-header-ads');
		echo '</div><!-- -->';
	}
}
add_action('responsive_in_header', '_lwper_echo_header');


/**
 * 広告用サイドバーを追加
 */
register_sidebar(array(
	'name' => 'ヘッダー右広告',
	'description' => '広告用ウィジェットを一つだけ追加してください。サイズは468x60を想定しています。モバイルのときは表示されません。',
	'id' => 'sidebar-header-ads',	
	'before_widget' => '',
	'after_widget'  => '',
	'before_title' => '',
	'after_title' => '',
));
add_action('init', '_lwper_adsense_sidebar');