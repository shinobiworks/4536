<?php

add_action( 'admin_menu', function() {
  add_menu_page( '4536設定', '4536設定', 'manage_options', '4536-setting', '', '', 4);
  add_submenu_page( '4536-setting', 'マニュアル', 'マニュアル', 'manage_options', '4536-setting', 'admin_4536_setting_manual');
  $list = [
    'SEO' => 'seo',
    'メディア' => 'media',
    'その他' => 'etc',
  ];
  foreach($list as $name => $key) {
    add_submenu_page( '4536-setting', $name, $name, 'manage_options', $key, 'admin_'.$key.'_setting_form_4536' );
  }
});

add_action( 'admin_init', function() {
    //メディア設定
    $list = [
        'admin_main_media',
        'main_media_slug',
        'main_media_name',
        'admin_sub_media',
        'sub_media_slug',
        'sub_media_name',
    ];
    foreach($list as $name) {
        register_setting( 'media_group', $name );
    }
    $list = [
        'google_analytics_tracking_id',
        'google_analytics_preview_count',
        'google_analytics_logged_in_user_count',
        'admin_seo_home',
        'admin_home_keyword',
        'admin_home_description',
        'admin_ogp',
        'admin_seo_post',
        'admin_seo_archive',
        'admin_get_aio',
        'admin_canonical',
        'admin_next_prev',
    ];
    foreach($list as $name) {
        register_setting( 'seo_group', $name );
    }
    $list = [
        'admin_comment',
        'admin_comment_mail',
        'admin_comment_website',
        'admin_comment_mail_address_private',
        'admin_add_html_js_head',
        'admin_add_html_js_body',
        'admin_wordpress_major_update',
        'admin_wordpress_minor_update',
        'admin_wordpress_dev_update',
        'admin_wordpress_plugin_update_setting',
        'admin_wordpress_theme_update',
        'wordpress_translation_update',
        'mce_button_searchreplace',
        'mce_button_source_code',
        'mce_button_balloon_left',
        'mce_button_balloon_right',
        'mce_button_balloon_think_left',
        'mce_button_balloon_think_right',
        'mce_button_point',
        'mce_button_caution',
        'is_enable_child_stylesheet',
        'disenable_wp_emoji',
        'first_tinymce_active_editor',
        'is_enable_jquery_lib',
    ];
    foreach($list as $name) {
        register_setting( 'etc_group', $name );
    }
});

add_action( 'init', function() {
  $list = [
    'mce_button_balloon_left',
    'mce_button_balloon_right',
    'mce_button_balloon_think_left',
    'mce_button_balloon_think_right',
    'mce_button_point',
    'mce_button_caution',
    'admin_wordpress_minor_update',
    'wordpress_translation_update',
    'google_analytics_logged_in_user_count',
    'admin_seo_post',
    'admin_seo_archive',
    'admin_ogp',
    'admin_canonical',
    'admin_next_prev',
    'is_enable_jquery_lib',
    'is_enable_child_stylesheet',
    'first_tinymce_active_editor',
  ];
  foreach($list as $name) {
    if( get_option($name) === false ) update_option($name, 1);
  }
  $list = [
    'admin_main_media' => 'ミュージック',
    'main_media_slug' => 'music',
    'main_media_name' => 'Music',
    'admin_sub_media' => 'ムービー',
    'sub_media_slug' => 'movie',
    'sub_media_name' => 'Movie',
    'embed_cache_delete' => 'all',
    'theme_color_4536' => 'default',
  ];
  foreach($list as $name => $val) {
    if( get_option($name) === false ) update_option($name, $val);
  }
});

function update_option_4536( $option ) {
  $val = ( isset($_POST[$option]) ) ? $_POST[$option] : '' ;
  update_option( $option, $val );
}

//ファイル読み込み
require_once('4536-manual.php');
require_once('easy-settings.php');
require_once('media-setting-form.php');
require_once('seo-setting-form.php');
require_once('amp-setting-form.php');
require_once('htaccess-setting.php');
require_once('etc-setting-form.php');
require_once('database-setting.php');
