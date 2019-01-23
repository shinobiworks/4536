<?php

add_filter('the_content', 'lazy_load_content_4536', 9999999999999);
add_filter('widget_text','lazy_load_content_4536', 9999999999999);
add_filter('widget_item_new','lazy_load_content_4536', 9999999999999);
function lazy_load_content_4536($html) {
    if(is_amp()) return $html;
    if(!is_lazy_load_4536()) return $html;
    if(preg_match_all('/<img.+?>/i', $html, $images)) {
        foreach($images[0] as $image) {
            preg_match('/class="(.+?)"/i', $image, $class);
            if(empty($class)) continue;
            if(strpos($class[1], 'lozad') !== false) continue;
            preg_match('/(width|height)="1"/i', $image, $tag);
            if($tag) continue;
            $new_image = str_replace('src="', 'data-src="', $image);
            $new_image = str_replace('srcset="', 'data-srcset="', $new_image);
            $new_class = substr_replace($class[1], 'lozad ', 0, 0);
            $new_image = str_replace($class[1], $new_class, $new_image);
            $noscript = '<noscript>'.$image.'</noscript>';
            $new_image = $new_image.$noscript;
            $html = str_replace($image, $new_image, $html);
        }
    }
    if(preg_match_all('/<iframe.+?><\/iframe>/i', $html, $iframes)) {
        foreach($iframes[0] as $iframe) {
            preg_match('/class="(.+?)"/i', $iframe, $class);
            if(empty($class)) {
              $new_iframe = str_replace('<iframe', '<iframe class="lozad"', $iframe);
            } else {
              if(strpos($class[1], 'lozad') !== false) continue;
              $new_class = substr_replace($class[1], 'lozad ', 0, 0);
              $new_iframe = str_replace($class[1], $new_class, $iframe);
            }
            $new_iframe = str_replace('src="', 'data-src="', $new_iframe);
            $noscript = '<noscript>'.$iframe.'</noscript>';
            $new_iframe = $new_iframe.$noscript;
            $html = str_replace($iframe, $new_iframe, $html);
        }
    }
    return $html;
};

//get_avatar
add_filter('post_thumbnail_html', 'lazy_load_media_4536', 9999999999999);
function lazy_load_media_4536($image) {
  if(is_amp()) return $image;
  if(!is_lazy_load_4536()) return $image;
  preg_match('/class="(.+?)"/i', $image, $class);
  if(empty($class)) return $image;
  if(strpos($class[1], 'lozad') !== false) return $image;
  if(strpos($class[1], 'attachment-post-thumbnail') !== false) return $image;
  $new_image = str_replace('src="', 'data-src="', $image);
  $new_image = str_replace('srcset="', 'data-srcset="', $new_image);
  $new_class = substr_replace($class[1], 'lozad ', 0, 0);
  $new_image = str_replace($class[1], $new_class, $new_image);
  $noscript = '<noscript class="lazy-load-noscript-4536">'.$image.'</noscript>';
  return $new_image.$noscript;
}
