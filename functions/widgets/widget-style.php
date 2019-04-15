<?php

class Widget_Style_Setting_4536 {

  public $widget_color_list = [
    'widget_background_color' => '背景色',
    'widget_font_color' => '文字の色',
  ];

  public $is_widget_color = [
    'is_widget_background_color' => '',
    'is_widget_font_color' => '',
  ];

  public $widget_style = [
    null => 'デフォルト',
    'widget-style-box-4536' => 'ボックス',
  ];

  public $margin_padding_setting = [
    'margin' => '',
    'padding' => '',
  ];

  function __construct() {
		add_filter( 'in_widget_form_4536', [ $this, 'form' ], 10, 4 );
    add_filter( 'widget_update_callback', [ $this, 'save' ], 20, 4 );
    add_filter( 'dynamic_sidebar_params', [ $this, 'style' ] );
    add_filter( 'inline_style_4536', [ $this, 'css' ] );
	}

  function form( $form, $widget, $return, $instance ) { ?>
    <p>
      <label for="<?php echo $widget->get_field_id('widget_style'); ?>"><?php _e('ウィジェットのスタイル'); ?></label>
      <select class='widefat' id="<?php echo $widget->get_field_id('widget_style'); ?>" name="<?php echo $widget->get_field_name('widget_style'); ?>" type="text">
        <?php
        $widget_style = $this->widget_style;
        foreach($widget_style as $display => $description) { ?>
          <option value='<?php echo $display; ?>'<?php echo ($instance['widget_style']==$display)?'selected':''; ?>>
            <?php echo $description; ?>
          </option>
        <?php } ?>
      </select>
    </p>
    <?php foreach( $this->widget_color_list as $name => $description ) { //ウィジェットの色設定 ?>
      <p>
        <input type="checkbox" class="widefat" id="<?php echo $widget->get_field_id('is_'.$name); ?>" name="<?php echo $widget->get_field_name('is_'.$name); ?>" <?php checked($instance['is_'.$name], 1);?> value="1" />
        <label for="<?php echo $widget->get_field_id('is_'.$name); ?>"><?php _e($description.'を指定する'); ?></label>
        <input type="color" class="widefat" id="<?php echo $widget->get_field_id($name); ?>" name="<?php echo $widget->get_field_name($name); ?>" value="<?php echo $instance[$name]; ?>" />
      </p>
    <?php }
    foreach( $this->margin_padding_setting as $key => $value ) { //ウィジェットの余白設定 ?>
      <p>
        <label for="<?php echo $widget->get_field_id( $key ); ?>"><?php _e( $key . '（余白）の設定' ); ?></label>
        <input pattern="^[0-9A-Za-z]+$" type="text" class="widefat" id="<?php echo $widget->get_field_id( $key ); ?>" name="<?php echo $widget->get_field_name( $key ); ?>" value="<?php echo $instance[$key]; ?>" placeholder="例：10px 1em 30px 2.6em" />
      </p>
    <?php }
  }

  function save( $instance, $new_instance, $old_instance, $object ) {
    $list = $this->widget_color_list;
    $list += $this->is_widget_color;
    $list['widget_style'] = '';
    foreach( $list as $type => $name ) {
      $instance[$type] = !empty($new_instance[$type]) ? $new_instance[$type] : '';
    }
    foreach( $this->margin_padding_setting as $type => $name ) {
      $instance[$type] = $new_instance[$type];
    }
    return $instance;
  }

  function css( $css ) {
    global $wp_registered_widgets;
    foreach(wp_get_sidebars_widgets() as $int => $ids) {
      foreach($ids as $int => $id) {
        $widget_obj = $wp_registered_widgets[$id];
        $num = preg_replace('/.*?-(\d)/', '$1', $id);
        $widget_opt = get_option($widget_obj['callback'][0]->option_name);
        $widget_font_color = $widget_opt[$num]['widget_font_color'];
        $is_widget_font_color = $widget_opt[$num]['is_widget_font_color'];
        $font_color = ($is_widget_font_color && $widget_font_color) ? 'color:'.$widget_font_color.';border-color:'.$widget_font_color : '';
        $widget_background_color = $widget_opt[$num]['widget_background_color'];
        $is_widget_background_color = $widget_opt[$num]['is_widget_background_color'];
        $margin = $widget_opt[$num]['margin'];
        $padding = $widget_opt[$num]['padding'];
        $background_color = ($is_widget_background_color && $widget_background_color) ? 'background-color:'.$widget_background_color : '';
        $class = '.'.$id;
        if( !empty( $background_color ) ) $css[] = $class.'{'.$background_color.'}';
        if( $margin !== '' && !is_null( $margin )  ) $css[] = $class.'{margin:'.$margin.'}';
        if( $padding !== '' && !is_null( $padding ) ) $css[] = $class.'{padding:'.$padding.'}';
        if( !empty( $font_color ) ) {
          $classes = [];
          $classes[] = $class;
          $classes[] = $class.' a';
          $classes[] = $class.' .widget-title';
          $classes[] = $class.' .widget-title::before';
          $classes[] = $class.' .widget-title::after';
          $classes = implode( ',', $classes );
          $css[] = $classes.'{'.$font_color.'}';
        }
      }
    }
    return $css;
  }

  //参考：https://gist.github.com/CEscorcio/5669905
  function style( $params ) {
    global $wp_registered_widgets;
    $widget_id = $params[0]['widget_id'];
    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number'];
    $widget_style = $widget_opt[$widget_num]['widget_style'];
    if($widget_style) $params[0]['before_widget'] = preg_replace( '/class="(.*?)"/', 'class="$1 '.$widget_style.'"', $params[0]['before_widget'], 1 );
    return $params;
  }

}
new Widget_Style_Setting_4536();