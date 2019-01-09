<?php

function admin_4536_setting_manual() { ?>

<div class="wrap">
    
    <h2>4536マニュアル</h2>

    <div class="metabox-holder">
    <div class="postbox" >
        <h3 class="hndle">外観（色やデザイン）の設定</h3>
        <div class="inside">
            <p>見出しの色を変えたり、サイトのレイアウトを変えたり、サイトの見た目に関する設定は「<a href="customize.php">テーマカスタマイザー</a>」で行います。</p>
            <p><small>（※管理画面からアクセスする場合は「外観→カスタマイズ」と進みます）</small></p>
            <p>設定を変えることで自分のサイトがどのように変化するかをリアルタイムで確認できますので、ぜひご活用ください。</p>
            <p>画面上部の「公開」ボタンをクリックするまでは実際のサイトには設定は反映されません。</p>
            <p><i class="far fa-arrow-alt-circle-right"></i><a href="customize.php">テーマカスタマイザーで設定を変更する</a></p>
        </div>
    </div>
    </div>

    <div class="metabox-holder">
    <div class="postbox" >
        <h3 class="hndle">内部（SEOやファイル読み込みの有無）の設定</h3>
        <div class="inside">
            <p>サイトの見た目には関係しない内部の設定は専用画面で行います。</p>
            <ul>
                <?php
                $list = [
                    'seo' => 'SEOの設定はこちら',
                    'media' => 'メディア（音楽や動画）の設定はこちら',
                    'amp' => 'AMPの設定はこちら',
                    'speeding_up' => '高速化の設定はこちら',
                    'etc' => 'その他の設定はこちら',
                ];
                foreach($list as $name => $desc) { ?>
                <li><i class="far fa-arrow-alt-circle-right"></i><a href="admin.php?page=<?php echo $name; ?>"><?php echo $desc; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    </div>

    <div class="metabox-holder">
    <div class="postbox" >
        <h3 class="hndle">その他の情報</h3>
        <div class="inside">
            <p>4536の使い方やサイト運営をする上で必要な情報は「<a href="https://4536.jp/category/manual" target="_blank">4536公式サイト</a>」で随時更新しています。</p>
            <p>フォーラムでいただいた質問への回答を記事にして公開することがあるので、チェックしていただけると助かります。</p>
            <p>また、公開した記事はTwitterやFacebookでもシェアしているので、ぜひフォローをお願いします。</p>
            <p><i class="far fa-arrow-alt-circle-right"></i><a href="//twitter.com/intent/follow?screen_name=4536jp" target="_blank" rel="nofollow">Twitterアカウントはこちら</a></p>
            <p><i class="far fa-arrow-alt-circle-right"></i><a href="//www.facebook.com/4536.jp/" target="_blank" rel="nofollow">Facebookアカウントはこちら</a></p>
        </div>
    </div>
    </div>

    <div class="metabox-holder">
    <div class="postbox" >
        <h3 class="hndle">質問・要望について</h3>
        <div class="inside">
            <p>サイト運営をしていてわからないこと、4536に実装して欲しい機能など、ご質問やご要望は<a href="https://4536.jp/forums" target="_blank">フォーラム</a>にて受け付けています。</p>
            <p>あなたと同じ悩みや要望を持っている方が他にもいるはずですので、お気軽にご相談ください。</p>
        </div>
    </div>
    </div>

</div>

<style>
    .far {
        margin-right: 5px;
    }
</style>

<?php }

