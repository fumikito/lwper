<?php
/**
 * JSやCSS、画像などに関する設定
 * 
 * 
 * @since 1.0
 */

/**
 * アセットのバージョニング
 */
define('LWPER_ASSETS_VERSION', '1.0');


/**
 * JSもしくはスタイルを登録する
 */
function _lwper_register_assets(){
	//親テーマのCSS
	wp_register_style('responsive-parent-style', get_template_directory_uri().'/style.css', array(), get_responsive_theme_version());
}
add_action('init', '_lwper_register_assets', 10000);


function _lwper_load_css(){
	wp_dequeue_style('responsive-style');
	wp_enqueue_style('lwper-style', get_stylesheet_directory_uri()."/compass/stylesheets/screen.css", array('responsive-parent-style'), '1.5.9');
}
add_action('wp_print_styles', '_lwper_load_css', 1000);

/**
 * ファビコンを表示する
 */
function _lwper_favicon(){
?>
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/lwper-logo.ico" />
<?php
}
add_action('wp_head', '_lwper_favicon', 10000);
add_action('admin_head', '_lwper_favicon', 10000);