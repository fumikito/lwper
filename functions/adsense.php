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


/**
 * 投稿の上に広告を出す
 * @param string $size laget, medium
 */
function lwper_ads($size = 'medium', $additional_class = ''){
	$classes = array('lwp-ad');
	if(wp_is_mobile()){
		$classes[] = 'lwp-ad-mobile';
	}
	switch($size){
		case 'large':
			$classes[] = 'lwp-ad-large';
			$ad = <<<EOS
<script type="text/javascript"><!--
google_ad_client = "ca-pub-0087037684083564";
/* LWPERコンテンツ上 */
google_ad_slot = "3467341910";
google_ad_width = 336;
google_ad_height = 280;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
EOS;
			break;
		default:
			$classes[] = 'lwp-ad-medium';
			$ad = <<<EOS
<script type="text/javascript"><!--
google_ad_client = "ca-pub-0087037684083564";
/* LWPer投稿下 */
google_ad_slot = "2636819148";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
EOS;
			break;
	}
	if(!empty($additional_class)){
		$classes[] = $additional_class;
	}
	printf('<div class="%s">%s</div>', implode(' ', $classes), $ad);
}

