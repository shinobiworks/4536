<?php

function sns_button_4536( $justify_content = 'j-c-c' )
{
    if (is_amp() || is_singular()) {
        $url = esc_url(get_permalink());
        $title = esc_html(get_the_title());
        $custom = get_post_custom();
        if (!empty($custom['sns_title'][0])) {
            $title = esc_html($custom['sns_title'][0]);
        }
    } else {
        $http = is_ssl() ? 'https://' : 'http://';
        $url = esc_url($http . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        $title = esc_html(wp_get_document_title());
    }

    $via = (twitter_via() && get_the_author_meta('twitter')) ? '&via='.get_the_author_meta('twitter') : '';

    if (function_exists('scc_get_share_twitter') && scc_get_share_twitter()!==0) {
        $twitter_count = '<span class="sns-count">'.scc_get_share_twitter().'</span>';
    }
    if (function_exists('scc_get_share_facebook') && scc_get_share_facebook()!==0) {
        $facebook_count = '<span class="sns-count">'.scc_get_share_facebook().'</span>';
    }
    if (function_exists('scc_get_share_hatebu') && scc_get_share_hatebu()!==0) {
        $hatebu_count = '<span class="sns-count">'.scc_get_share_hatebu().'</span>';
    }
    if (function_exists('scc_get_share_pocket') && scc_get_share_pocket()!==0) {
        $pocket_count = '<span class="sns-count">'.scc_get_share_pocket().'</span>';
    }

    $target = (is_amp()) ? ' rel="nofollow"' : ' target="blank" rel="nofollow"';

    //url

    $arr['twitter']['url'] = 'http://twitter.com/share?text=' . $title . '&url=' . $url . $via . '&tw_p=tweetbutton&related=' . get_the_author_meta('twitter');

    $arr['facebook']['url'] = 'http://www.facebook.com/sharer.php?src=bm&u=' . $url . '&t=' . $title;

    $arr['hatebu']['url'] = 'http://b.hatena.ne.jp/add?mode=confirm&url=' . $url;

    // $arr['pocket']['url'] = 'http://getpocket.com/edit?url=' . $url . '&title=' . $title;

    $arr['line']['url'] = 'http://line.me/R/msg/text/?' . $title . '%0A' . $url;

    //text

    $arr['twitter']['text'] = I_TWITTER . $twitter_count;

    $arr['facebook']['text'] = I_FACEBOOK . $facebook_count;

    $arr['hatebu']['text'] = I_HATEBU . $hatebu_count;

    // $arr['pocket']['text'] = '<i class="fab fa-get-pocket"></i>' . $pocket_count;

    $arr['line']['text'] = I_LINE;

    ?>

    <div class="d-f flex <?php echo $justify_content; ?>">
        <?php
        foreach ($arr as $key => $value) {
          echo '<span class="pa-2"><a class="d-b l-h-100 ' . $key . '" href="' . $value['url'] . '"' . $target . '>' . $value['text'] . '</a></span>';
        }
        echo $twitter.$facebook.$hatebu.$line;
        ?>
    </div>

<?php
} ?>
