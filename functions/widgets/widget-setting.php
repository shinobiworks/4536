<?php

//h2タグの前にウィジェットを出力
add_filter('the_content', function($the_content) {

    if(is_amp()) {
        if(!empty(amp_adsense_code()) && is_amp_before_1st_h2()) {
            $ad = amp_adsense_code();
        } elseif(is_active_sidebar('amp-first-h2-ad')) {
            ob_start();
            dynamic_sidebar('amp-first-h2-ad');
            $ad = ob_get_clean();
        }
    } else {
        if(is_active_sidebar('sp-first-h2-ad')) {
            ob_start();
            dynamic_sidebar('sp-first-h2-ad');
            $ad = ob_get_clean();
        }
    }
    
    if( is_single() && !empty($ad) ) {
        $ad = '<div class="ad-wrapper text-align-center clearfix">'.$ad.'</div>';
        preg_match( '/<h2.*?>/i', $the_content, $h2 );
        $h2 = $h2[0];
        if($h2) $the_content = preg_replace('/<h2.*?>/i', $ad.$h2, $the_content, 1);
    }
    return $the_content;
});

//ウィジェットのタイトル消す
add_filter( 'widget_title', function($widget_title) {
    return (substr( $widget_title, 0, 1 )=='!') ? null : $widget_title ;
});

//ウィジェットのカラー
function widget_color_4536() {
    global $wp_registered_widgets;
    foreach(wp_get_sidebars_widgets() as $int => $ids) {
        foreach($ids as $int => $id) {
            $widget_obj = $wp_registered_widgets[$id];
            $num = preg_replace('/.*?-(\d)/', '$1', $id);
            $widget_opt = get_option($widget_obj['callback'][0]->option_name);
            $widget_font_color = $widget_opt[$num]['widget_font_color'];
            $is_widget_font_color = $widget_opt[$num]['is_widget_font_color'];
            $font_color = ($is_widget_font_color && $widget_font_color) ? 'color:'.$widget_font_color : '';
            $widget_background_color = $widget_opt[$num]['widget_background_color'];
            $is_widget_background_color = $widget_opt[$num]['is_widget_background_color'];
            $background_color = ($is_widget_background_color && $widget_background_color) ? 'background-color:'.$widget_background_color : '';
            if($background_color) echo '.'.$id.'{'.$background_color.'}';
            if($font_color) echo '.'.$id.' *{'.$font_color.'}';
        }
    }
}

//ウィジェットの記事表示数
function widget_post_count_4536() {
    global $wp_registered_widgets;
    foreach(wp_get_sidebars_widgets() as $int => $ids) {
        foreach($ids as $int => $id) {
            $widget_obj = $wp_registered_widgets[$id];
            $num = preg_replace('/.*?-(\d)/', '$1', $id);
            $widget_opt = get_option($widget_obj['callback'][0]->option_name);
            $new_post_count[] = $widget_opt[$num]['entry_count'];
            $pickup_post_count[] = $widget_opt[$num]['pickup_count'];
        }
    }
    $new_post_count = (max($new_post_count)) ? max($new_post_count) : 5;
    $pickup_post_count = (max($pickup_post_count)) ? max($pickup_post_count) : 5;
    return [
        'new_post_count' => $new_post_count,
        'pickup_post_count' => $pickup_post_count,
    ];
}

//CTA
function cta_widget_thumbnail_4536() {
    global $wp_registered_widgets;
    foreach(wp_get_sidebars_widgets() as $int => $ids) {
        foreach($ids as $int => $id) {
            $widget_obj = $wp_registered_widgets[$id];
            $num = preg_replace('/.*?-(\d)/', '$1', $id);
            $widget_opt = get_option($widget_obj['callback'][0]->option_name);
            $button_text = $widget_opt[$num]['cta_button_text'];
            $button_url = $widget_opt[$num]['cta_button_url'];
            $button_text_url = $widget_opt[$num]['cta_button_text_url'];
            if(!$button_text && !$button_url && !$button_text_url) continue;
            $pc = '';
            $style = $widget_opt[$num]['cta_image_style'];
            if(!empty($style)) $pc = '@media screen and (min-width: 768px) {.cta-image-left{float:left;width:calc(50% - -20px);margin-right:20px}.cta-image-right{float:right;width:calc(50% - 20px);margin-left:20px}}';
            $css[] = '.cta{padding:2em 0 0.1px}.cta .cta-title{text-align:center;font-size:20px;font-weight:700}.cta p,.cta-title{line-height:1.6}.cta p,.cta-thumbnail,.cta-title{margin:0 20px 20px}'.$pc;
        }
    }
    return $css;
}

add_action('admin_head-widgets.php', function() { ?>
    <style>
        .tab-item {
            width: 25%;
            border-bottom: 3px solid #5ab4bd;
            border-right: 1px solid #5ab4bd;
            background-color: #d9d9d9;
            color: #565656;
            font-size: 10px;
            text-align: center;
            display: block;
            float: left;
            font-weight: bold;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            padding: .5em;
        }
        .tab-item:last-of-type {
            border-right: none;
        }
        .tab-item:hover {
            opacity: 0.7;
        }
        input[name="tab_item"] {
            display: none;
        }
        .tab_content {
            display: none;
            padding: 0 1em;
            height: 150px;
            overflow-y: scroll;
            clear: both;
            border-left: 1px solid #ccc;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }
        .tabs input:checked + .tab-item {
            background-color: #5ab4bd;
            color: #fff;
        }
        .tab_content .category-list .children {
            margin: 6px 0 0 20px;
        }
    </style>
<?php });

