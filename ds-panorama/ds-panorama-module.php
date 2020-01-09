<?php

function ds_panorama()
{
    if (class_exists('JT_Builder_Module_1_0')) {

        class ET_Builder_Module_DS_Panorama extends JT_Builder_Module_1_0
        {
            public function init()
            {
                $this->name = esc_html__('Panorama', 'et_builder');
                $this->slug = 'et_pb_ds_panorama';
                $this->main_css_element = '%%order_class%%.et_pb_ds_panorama';

                //Add module "default" fields like background, margin, padding, border, module_id, module_class
                $this->jt_add_module_default_options();

                /* Panorama Section */
                $this->jt_add_general_options_toggle('panorama', 'Panorama');

                $this->jt_add_field(
                    'image',
                    array(
                        'label' => esc_html__('Image', 'et_builder'),
                        'type' => 'upload',
                        'option_category' => 'basic_option',
                        'upload_button_text' => esc_attr__('Upload an image', 'et_builder'),
                        'choose_text' => esc_attr__('Choose an Image', 'et_builder'),
                        'update_text' => esc_attr__('Set As Image', 'et_builder'),
                        'description' => esc_html__('Upload an image to display in the item.', 'et_builder'),
                        'toggle_slug' => 'panorama',
                    )
                );

                $this->jt_add_field(
                    'image_alt',
                    array(
                        'label' => esc_html__('Image Alt Text', 'et_builder'),
                        'type' => 'text',
                        'option_category' => 'basic_option',
                        'description' => esc_html__('Define the HTML ALT text for the image.', 'et_builder'),
                        'toggle_slug' => 'panorama',
                    )
                );

                $this->jt_add_field(
                    'height',
                    array(
                        'label' => esc_html__('Image Height', 'et_builder'),
                        'type' => 'range',
                        'option_category' => 'layout',
                        'default' => '500',
                        'range_settings' => array(
                            'min' => '100',
                            'max' => '1000',
                            'step' => '10',
                        ),
                        'toggle_slug' => 'panorama',
                        'validate_unit' => false,
                        'description' => esc_html__(".", 'et_builder'),
                    ),
                    array('500')
                );

                $this->jt_add_field(
                    'direction',
                    array(
                        'label' => 'Content Direction',
                        'type' => 'select',
                        'option_category' => 'basic_option',
                        'options' => array(
                            'horizontal' => 'Horizontal',
                            'vertical' => 'Vertical',
                        ),
                        'toggle_slug' => 'panorama',
                        'default' => 'horizontal',
                        'description' => esc_html__('The direction of the panorama.', 'et_builder'),
                    ),
                    array('horizontal')
                );

                $this->jt_add_field(
                    'repeat', array(
                        'label' => 'Repeat Content',
                        'type' => 'yes_no_button',
                        'option_category' => 'configuration',
                        'options' => array(
                            'off' => esc_html__('Off', 'et_builder'),
                            'on' => esc_html__('On', 'et_builder'),
                        ),
                        'toggle_slug' => 'panorama',
                        'description' => esc_html__('.', 'et_builder'),
                    ), array('off')
                );

                $this->jt_add_field(
                    'overlay', array(
                        'label' => 'Show Overlay',
                        'type' => 'yes_no_button',
                        'option_category' => 'configuration',
                        'options' => array(
                            'off' => esc_html__('Off', 'et_builder'),
                            'on' => esc_html__('On', 'et_builder'),
                        ),
                        'toggle_slug' => 'panorama',
                        'description' => esc_html__('.', 'et_builder'),
                    ), array('off')
                );

                $this->jt_add_field(
                    'animation_time',
                    array(
                        'label' => esc_html__('Animation Time', 'et_builder'),
                        'type' => 'range',
                        'option_category' => 'layout',
                        'default' => '0',
                        'range_settings' => array(
                            'min' => '0',
                            'max' => '1000',
                            'step' => '100',
                        ),
                        'toggle_slug' => 'panorama',
                        'validate_unit' => false,
                        'description' => esc_html__(".", 'et_builder'),
                    ),
                    array('0')
                );

                $this->jt_add_field(
                    'easing',
                    array(
                        'label' => 'Easing Function',
                        'type' => 'select',
                        'option_category' => 'basic_option',
                        'options' => array(
                            'linear' => 'Linear',
                            'ease-in-out' => 'Ease In Out',
                            'ease-out' => 'Ease Out',
                            'ease-in' => 'Ease In',
                        ),
                        'toggle_slug' => 'panorama',
                        'default' => 'horizontal',
                        'description' => esc_html__('The direction of the panorama.', 'et_builder'),
                    ),
                    array('linear')
                );

                $this->jt_add_advanced_options_toggle('panorama', 'Panorama');

                $this->jt_add_field(
                    'overlay_color',
                    array(
                        'label' => esc_html__('Overlay Color ', 'et_builder'),
                        'toggle_slug' => 'panorama',
                        'option_category' => 'layout',
                        'tab_slug' => 'advanced',
                        'type' => 'color-alpha',
                        'custom_color' => true,
                        'default' => 'rgba(0,0,0,0.2)',
                        'description' => esc_html__('Color of the overlay.', 'et_builder'),
                    ),
                    array('rgba(0,0,0,0.2)')
                );

                parent::init();
            }

            public function shortcode_callback($atts, $content = null, $function_name)
            {
                wp_enqueue_style('ds_panorama_jquery_css');
                wp_enqueue_script('ds_panorama_jquery_js');

                wp_enqueue_style('ds_panorama_css');
                wp_enqueue_script('ds_panorama');

                $additional_css_classes = array('et_pb_module');

                $image = sprintf(
                    '<img src="%1$s" alt="%2$s" style="max-width: none;">',
                    $this->shortcode_atts['image'],
                    $this->shortcode_atts['image_alt']
                );

                $repeat = 'on' === $this->shortcode_atts['repeat'];
                $direction = $this->shortcode_atts['direction'];
                $overlay = 'on' === $this->shortcode_atts['overlay'];

                $animationTime = $this->shortcode_atts['animation_time'];
                $easing = $this->shortcode_atts['easing'];

                ET_Builder_Element::set_style($function_name, array(
                    'selector' => '%%order_class%% .et_pb_ds_panorama_wrapper',
                    'declaration' => sprintf(
                        'height: %1$spx;',
                        $this->shortcode_atts['height']
                    ),
                ));

                ET_Builder_Element::set_style($function_name, array(
                    'selector' => '%%order_class%% .pv-container .pv-overlay',
                    'declaration' => sprintf(
                        'background: %1$s;',
                        $this->shortcode_atts['overlay_color']
                    ),
                ));


                return sprintf(
                    '<div%1$s%2$s data-repeat="%4$s" data-direction="%5$s" data-animation-time="%6$s" data-easing="%7$s" data-overlay="%8$s">
                        <div class="et_pb_ds_panorama_wrapper" >%3$s</div>
                    </div>',
                    $this->jt_get_module_id(),
                    $this->jt_get_module_classes($function_name, $additional_css_classes),
                    $image,
                    $repeat,
                    $direction,
                    $animationTime,
                    $easing,
                    $overlay
                );
            }
        }

        add_shortcode('ds_panorama', array(new ET_Builder_Module_DS_Panorama(), '_shortcode_callback'));
    }
}
add_action('et_builder_ready', 'ds_panorama', 10);
