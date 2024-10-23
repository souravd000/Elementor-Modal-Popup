<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class My_Custom_Widget extends \Elementor\Widget_Base {

    // Return the name of your widget.
    public function get_name() {
        return 'Modal Popup';
    }

    // Return the title of your widget.
    public function get_title() {
        return __( 'Modal Popup', 'my-elementor-widget' );
    }

    // Return the icon of your widget.
    public function get_icon() {
        return 'eicon-lightbox-expand';
    }

    // Return the category your widget will appear in.
    public function get_categories() {
        return [ 'general' ];
    }

    // Register the widget controls.
    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'my-elementor-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Button text control
        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'my-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Open Modal', 'my-elementor-widget' ),
            ]
        );

        // Dropdown control for modal content type selection
        $this->add_control(
            'modal_content_type',
            [
                'label' => __( 'Content Type', 'my-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'button_group',
                'options' => [
                    'button_group' => __( 'Button Group', 'my-elementor-widget' ),
                    'text_editor' => __( 'Text Editor', 'my-elementor-widget' ),
                ],
            ]
        );

        // Modal title typography and color controls
        $this->add_control(
            'modal_title',
            [
                'label' => __( 'Modal Title', 'my-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Modal Title', 'my-elementor-widget' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'modal_title_typography',
                'label' => __( 'Title Typography', 'my-elementor-widget' ),
                'selector' => '{{WRAPPER}} .my-modal-header h2',
            ]
        );

        $this->add_control(
            'modal_title_color',
            [
                'label' => __( 'Title Color', 'my-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .my-modal-header h2' => 'color: {{VALUE}};',
                ],
            ]
        );


        // Button alignment control
        $this->add_responsive_control(
            'button_alignment',
            [
                'label' => __( 'Button Alignment', 'my-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'my-elementor-widget' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'my-elementor-widget' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'my-elementor-widget' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .my-modal-trigger-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        // Button width control
        $this->add_responsive_control(
            'button_width',
            [
                'label' => __( 'Button Width', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 50,
                        'max' => 600,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .my-modal-trigger' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Modal size control
        $this->add_control(
            'modal_size',
            [
                'label' => __( 'Modal Size', 'my-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'medium',
                'options' => [
                    'small' => __( 'Small', 'my-elementor-widget' ),
                    'medium' => __( 'Medium', 'my-elementor-widget' ),
                    'large' => __( 'Large', 'my-elementor-widget' ),
                ],
            ]
        );

        $this->end_controls_section();

        // New "Item" section for the Button Group
        $this->start_controls_section(
            'item_section',
            [
                'label' => __( 'Item', 'my-elementor-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        // Button group (repeater control)
        $this->add_control(
            'button_group',
            [
                'label' => __( 'Button Group', 'my-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'button_group_text',
                        'label' => __( 'Button Text', 'my-elementor-widget' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __( 'Button', 'my-elementor-widget' ),
                    ],
                    // URL field for each button
                    [
                        'name' => 'button_group_url',
                        'label' => __( 'URL', 'my-elementor-widget' ),
                        'type' => \Elementor\Controls_Manager::URL,
                        'placeholder' => __( 'https://your-link.com', 'my-elementor-widget' ),
                        'default' => [
                            'url' => '',
                            'is_external' => false,
                            'nofollow' => false,
                        ],
                    ],
                ],
                'title_field' => '{{{ button_group_text }}}',
                'condition' => [
                    'modal_content_type' => 'button_group',
                ],
            ]
        );

        // Button group alignment control (for aligning buttons inside the modal)
        $this->add_responsive_control(
            'button_group_alignment',
            [
                'label' => __( 'Button Group Alignment', 'my-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'my-elementor-widget' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'my-elementor-widget' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'my-elementor-widget' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .my-button-group' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'modal_content_type' => 'button_group',
                ],
            ]
        );


        // Text editor control (visible only if 'Text Editor' is selected)
        $this->add_control(
            'modal_text_editor',
            [
                'label' => __( 'Text Editor', 'my-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( 'This is the default text.', 'my-elementor-widget' ),
                'condition' => [
                    'modal_content_type' => 'text_editor',
                ],
            ]
        );

        // Text editor typography and color controls
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_editor_typography',
                'label' => __( 'Text Editor Typography', 'my-elementor-widget' ),
                'selector' => '{{WRAPPER}} .my-modal-editor-content',
                'condition' => [
                    'modal_content_type' => 'text_editor',
                ],
            ]
        );

        $this->add_control(
            'text_editor_color',
            [
                'label' => __( 'Text Editor Color', 'my-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .my-modal-editor-content' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'modal_content_type' => 'text_editor',
                ],
            ]
        );



        $this->end_controls_section();

        // Style section for Button and Icon
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Button Styles', 'my-elementor-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        // Button text color control
        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Button Text Color', 'my-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .my-modal-trigger' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Button background color control
        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Button Background Color', 'my-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .my-modal-trigger' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Responsive border radius control
        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'my-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .my-modal-trigger' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Box shadow control
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'label' => __( 'Button Box Shadow', 'my-elementor-widget' ),
                'selector' => '{{WRAPPER}} .my-modal-trigger',
            ]
        );



        // Typography control for button text
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __( 'Typography', 'my-elementor-widget' ),
                'selector' => '{{WRAPPER}} .my-modal-trigger',
            ]
        );

        // Border type control
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => __( 'Button Border', 'my-elementor-widget' ),
                'selector' => '{{WRAPPER}} .my-modal-trigger',
            ]
        );

        // Padding control
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Button Padding', 'my-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .my-modal-trigger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();
        


    }

    // Render the widget output on the frontend.
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Add size class based on user selection
        $modal_size_class = 'my-modal-' . $settings['modal_size'];

        echo '<div class="my-modal-trigger-wrapper">';
        echo '<button class="my-modal-trigger">';

        echo ' ' . $settings['button_text'];
        echo '</button>';
        echo '</div>';

        echo '<div id="my-modal" class="my-modal ' . esc_attr($modal_size_class) . '">';
        echo '<div class="my-modal-content">';
        // Create header section with Flexbox alignment
        echo '<div class="my-modal-header">';
        echo '<h2>' . esc_html( $settings['modal_title'] ) . '</h2>';
        echo '<button class="my-modal-close">&times;</button>';
        echo '</div>'; // End my-modal-header

        // Conditionally render Button Group or Text Editor
        if ( $settings['modal_content_type'] === 'button_group' ) {

            // Render the Item section with the button group
            echo '<div class="my-item-section">';
            
            echo '<div class="my-button-group">';
            

            foreach ( $settings['button_group'] as $button ) {
                $link_attributes = '';

                // If a URL is set for the button, add the link attributes
                if ( ! empty( $button['button_group_url']['url'] ) ) {
                    $link_attributes = ' href="' . esc_url( $button['button_group_url']['url'] ) . '"';
                    if ( $button['button_group_url']['is_external'] ) {
                        $link_attributes .= ' target="_blank"';
                    }
                    if ( $button['button_group_url']['nofollow'] ) {
                        $link_attributes .= ' rel="nofollow"';
                    }
                }

                echo '<a' . $link_attributes . ' class="my-group-button">';
                echo ' ' . $button['button_group_text'];
                echo '</a>';
            }
            echo '</div>'; // End Button Group
            echo '</div>'; // End Item Section
        } elseif ( $settings['modal_content_type'] === 'text_editor' ) {
            echo '<div class="my-item-section">';
            echo '<div class="my-modal-editor-content">';
            echo $settings['modal_text_editor'];
            echo '</div>';
            echo '</div>';
        }
        
        echo '</div>'; // End Modal Content
        echo '</div>'; // End Modal
    }
}

// Register the widget.
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \My_Custom_Widget() );
