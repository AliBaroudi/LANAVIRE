<?php


//-option_category
//--basic_option
//--configuration
//--layout
//--color_option
//--font_option
  if ( !function_exists('jt_builder_module_1_0')) {
    function jt_builder_module_1_0() {
      if ( class_exists('ET_Builder_Module') && !class_exists('JT_Builder_Module_1_0') ) {
        class JT_Builder_Module_1_0 extends ET_Builder_Module {

          public $jt_whitelisted_fields = array();
          public $jt_fields_defaults    = array();
          public $jt_fields             = array();
          public $jt_options_toggles    = array(
            'general'     => array( 'toggles' => array() ),
            'advanced'    => array( 'toggles' => array() ),
            'custom_css'  => array( 'toggles' => array() ),
          );
          public $jt_advanced_options   = array();
          public $jt_custom_css_options = array();


          /* Check if video backgrounds are available */
          static function jt_is_video_background_available() {
            return method_exists('ET_Builder_Module', 'video_background') &&
                    is_callable( array( 'ET_Builder_Module', 'video_background' ) );
          }

          /* Check if parallax image backgrounds are available */
         static function jt_is_parallax_image_background_available() {
            return method_exists('ET_Builder_Module', 'get_parallax_image_background') &&
                    is_callable( array( 'ET_Builder_Module', 'get_parallax_image_background' ) );
          }


          function init() {
            $this->whitelisted_fields = $this->jt_whitelisted_fields;
            $this->fields_defaults    = $this->jt_fields_defaults;
            $this->options_toggles    = $this->jt_options_toggles;
            $this->advanced_options   = $this->jt_advanced_options;
            $this->custom_css_options = $this->jt_custom_css_options;
          }

          //TODO: Functions to add fields, then add fields to whitelisted fields, field defaults and fields
          function jt_add_field( $slug, $settings, $default = NULL ) {
            if ( isset( $default ) && is_array( $default ) && !empty( $default ) ) {
              $this->jt_fields_defaults[$slug] = $default;
            }

            $this->jt_whitelisted_fields[]  = $slug;
            $this->jt_fields[$slug]         = $settings;
          }

          function jt_add_module_default_options() {
            $this->jt_add_background_option();
            $this->jt_add_border_option();
            $this->jt_add_margin_padding_option();
            $this->jt_add_module_id_option();
            $this->jt_add_module_class_option();
            $this->jt_add_admin_label_option();
            $this->jt_add_disabled_on_option();
          }

          function jt_add_disabled_on_option() {
            $this->jt_whitelisted_fields[] = 'disabled_on';
            $this->jt_fields['disabled_on'] = array(
              'label'           => esc_html__( 'Disable on', 'et_builder' ),
              'type'            => 'multiple_checkboxes',
              'options'         => array(
                'phone'   => esc_html__( 'Phone', 'et_builder' ),
                'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
                'desktop' => esc_html__( 'Desktop', 'et_builder' ),
              ),
              'additional_att'  => 'disable_on',
              'option_category' => 'configuration',
              'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
              'tab_slug'        => 'custom_css',
              'toggle_slug'     => 'visibility',
            );
          }

          function jt_add_admin_label_option() {
            $this->jt_whitelisted_fields[] = 'admin_label';
            $this->jt_fields['admin_label'] = array(
              'label'       => esc_html__( 'Admin Label', 'et_builder' ),
              'type'        => 'text',
              'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
              'toggle_slug' => 'admin_label',
              'option_category' => 'configuration',
            );
          }

          function jt_add_module_id_option() {
            $this->jt_whitelisted_fields[] = 'module_id';
            $this->jt_fields['module_id'] = array(
              'label'           => esc_html__( 'CSS ID', 'et_builder' ),
              'type'            => 'text',
              'option_category' => 'configuration',
              'tab_slug'        => 'custom_css',
              'toggle_slug'     => 'classes',
              'option_class'    => 'et_pb_custom_css_regular',
            );
          }

          function jt_add_module_class_option() {
            $this->jt_whitelisted_fields[] = 'module_class';
            $this->jt_fields['module_class'] = array(
              'label'           => esc_html__( 'CSS Class', 'et_builder' ),
              'type'            => 'text',
              'option_category' => 'configuration',
              'tab_slug'        => 'custom_css',
              'toggle_slug'     => 'classes',
              'option_class'    => 'et_pb_custom_css_regular',
            );
          }

          function jt_add_background_layout_option( $settings = array() ) {

            $defaults = array(
              'toggle_slug'   => 'text',
              'default'       => array( 'light' ),
            );
            $settings = wp_parse_args( $settings, $defaults );

            $this->jt_fields_defaults['background_layout'] = $settings['default'];
            $this->jt_whitelisted_fields[]                 = 'background_layout';
            $this->jt_fields['background_layout']          = array(
              'label'             => esc_html__( 'Text Color', 'et_builder' ),
              'type'              => 'select',
              'option_category'   => 'color_option',
              'options'           => array(
                'light' => esc_html__( 'Dark', 'et_builder' ),
                'dark'  => esc_html__( 'Light', 'et_builder' ),
              ),
              'tab_slug'          => 'advanced',
              'toggle_slug'       => $settings['toggle_slug'],
            );
          }

          function jt_add_background_option( $settings = array() ) {
            $this->jt_add_advanced_option( 'background', $settings );
            // array(
            //   'css' => array(
            //     'main' => "{$css_element}",
            //   ),
            //   'settings' => array(
            //     'color' => 'alpha',
            //   )
            // ) );
          }

          function jt_add_border_option( $settings = array( 'settings' => array('color' => 'alpha') ) ) {
            $this->jt_add_advanced_option( 'border', $settings );
            //   'border' => array(
            //    'label'    => esc_html__( 'Field border', 'et_builder' ),
        		// 		'css' => array(
        		// 			'main' => sprintf(
            //        '%1$s .input,
            //        %1$s .input[type="checkbox"] + label i,
            //        %1$s .input[type="radio"] + label i',
            //        $this->main_css_element
            //      ),
            //      'important' => 'plugin_only', //Nur im builder? muss mal ausprobieren
            // 			'important' => 'all',
        		// 		),
        		// 		'additional_elements' => array(
        		// 			"{$this->main_css_element} .et_pb_pricing_content_top" => array( 'bottom' ), //direction oder "all" um alle zusätzlchen elemente so zu stlyen
        		// 		),
        		// 'settings' => array(
      			// 	'color' => 'alpha', //alpha sorgt für "color-alpha" feld. ansonsten wird immer "color" feld genutzt
      			// ),
        		// 	),
          }

          function jt_add_margin_padding_option( $use_margin = true, $use_padding = true ) {
            $this->jt_add_advanced_option( 'custom_margin_padding', array(
              'use_margin' => $use_margin,
              'use_padding' => $use_padding,
              'css' => array(
                'important' => 'all',
              )
            ) );
          }

          function jt_add_general_options_toggle( $slug, $label, $priority = 10 ) {
            $this->jt_options_toggles['general']['toggles'][$slug] = array(
              'title'    => esc_html__( $label, 'et_builder' ),
              'priority' => $priority,
            );
          }

          function jt_add_advanced_options_toggle( $slug, $label, $priority = 10 ) {
            $this->jt_options_toggles['advanced']['toggles'][$slug] = array(
              'title'    => esc_html__( $label, 'et_builder' ),
              'priority' => $priority,
            );
          }

          function jt_add_css_options_toggle( $slug, $label, $priority = 10 ) {
            $this->jt_options_toggles['custom_css']['toggles'][$slug] = array(
              'title'    => esc_html__( $label, 'et_builder' ),
              'priority' => $priority,
            );
          }

          function jt_add_advanced_option( $slug = '', $settings = array() ) {
            $this->jt_advanced_options[$slug] = $settings;
          }

          function jt_add_advanced_fonts_option( $slug = '', $settings = array() ){

            if ( !isset($this->jt_advanced_options['fonts']) ) {
              $this->jt_advanced_options['fonts'] = array();
            }

            $this->jt_advanced_options['fonts'][$slug] = $settings;
          }

          function get_fields() {
            return $this->jt_fields;
          }

          /*
          Get the modules CSS ID including the id tag.

          return: ' id="..."'

          */
          function jt_get_module_id() {
            $module_id = $this->shortcode_atts['module_id'];
            if ( isset( $module_id ) && '' !== $module_id ) {
              return sprintf( ' id="%1$s"', esc_attr( $module_id ) );
            } else {
              return '';
            }
          }


          /*
          Get the modules CSS classes. Additional classes can be provided as well as video and parallax image background can be disbaled
          params:
          -$function_name
          -$additional_module_classes: string
          -$include_background_classes: bool

          return: ' class="..."'

          */
          function jt_get_module_classes( $function_name, $additional_module_classes = array(), $include_background_layout = true, $include_video_parallax = true ) {

            //Get custom css classes for module
            $module_class = $this->shortcode_atts['module_class'];

            //Get module order class
            $module_order_class = self::get_module_order_class( $function_name );

            //get video and/or parallax image background
            $video_background          = self::jt_is_video_background_available() && $include_video_parallax && '' !== $this->video_background() ? 'et_pb_section_video et_pb_preload' : '';
            $parallax_image_background = self::jt_is_parallax_image_background_available() && $include_video_parallax && '' !== $this->get_parallax_image_background() ? 'et_pb_section_parallax' : '';

            //Create class string from additional classes array
            $additional_module_classes = is_array( $additional_module_classes ) && !empty( $additional_module_classes ) ? implode( ' ', $additional_module_classes ) : '';

            $background_layout = isset($this->shortcode_atts['background_layout']) ? $this->shortcode_atts['background_layout'] : '';
            $background_layout = '' !== $background_layout ? esc_attr( "et_pb_bg_layout_{$background_layout}" ) : '';

            //Construct css class string
            return sprintf(' class="%1$s %2$s%3$s%4$s%5$s%6$s%7$s"',
              $this->slug,
              $module_order_class,
              '' !== esc_attr( $additional_module_classes ) ? sprintf( ' %s', esc_attr( $additional_module_classes ) ) : '',
              '' !== esc_attr( $module_class ) ? sprintf( ' %s', esc_attr( $module_class ) ) : '',
              '' !== $video_background ? sprintf( ' %s', $video_background ) : '',
              '' !== $parallax_image_background  ? sprintf( ' %s', $parallax_image_background ) : '',
              '' !== $background_layout  ? sprintf( ' %s', $background_layout ) : ''
            );
          }

        }
      }
    }
    if ( !has_action('jt_builder_module_1_0') ) {
      add_action('et_builder_ready', 'jt_builder_module_1_0', 9);
    }
  }
