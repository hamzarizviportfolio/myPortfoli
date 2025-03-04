<?php
/**
 * Return the default options of the theme
 *
 * @return  void
 */

function themesflat_customize_default( $key ) {
	$primary_font = 'Poppins';
	$body_font    = 'Open Sans';

	$primary_color   = '#fd562a';
	$secondary_color = '';
	$accent_color    = '#222';
	$default         = array(
		'social_links'                       => array(
			"facebook-f" => '#',
			"twitter"  => '#',
			"linkedin"   => '#',
			"instagram"  => '#',
		),
		'show_social_share'                  => 0,
		'go_top'                             => 1,
		'enable_smooth_scroll'               => 0,
		'enable_preload'                     => 1,
		'preload'                            => 'preload-6',
		//topbar
		'topbar_background_color'            => '',
		'topbar_textcolor'                   => '',
		'topbar_link_color'                  => '',
		'topbar_link_color_hover'            => $secondary_color,
		'social_topbar'                      => 0,
		'topbar_enabled'                     => 0,
		'infoLeft_topbar_enabled'            => 1,
		'infoLeft_topbar'                    => __( 'Welcome Drop The Card. <span class="tf-secondary-color">Free Case Evaluation.</span>', 'fungi' ),
		'infoRight_topbar_enabled'           => 1,
		'infoRight_topbar'                   => esc_html__( 'Phone: +55 (121) 234 444', 'fungi' ),
		'typography_topbar'                  => array(
			'family'         => $primary_font,
			'style'          => '700',
			'size'           => '16',
			'line_height'    => '',
			'letter_spacing' => '',
		),
		'topbar_controls'                    => array( 'padding-top' => '', 'padding-bottom' => '' ),

		//topbar_mobile
		'enable_topbar_mobile'               => 0,
		'menu_topbar_mobile'                 => 0,
		'social_topbar_mobile'               => 0,
		'topbar_mobile_background_color'     => '',
		'topbar_mobile_textcolor'            => '#fff',
		'topbar_mobile_link_color'           => '#fff',
		'topbar_mobile_link_color_hover'     => $accent_color,

		//Header
		'style_header'                       => 'header-default',
		'header_sticky'                      => 1,
		'header_sticky_mode'                 => 'header-show-on-scroll-up',
		'header_search_box'                  => 0,
		'header_custom_html_enable'          => 0,
		'header_custom_html'                 => '<div class="dropdown demo-language">
    <span class="label">FR</span>
    <a href="#" class="btn btn-outline btn-demo-language dropdown-toggle" data-bs-toggle="dropdown"
       aria-expanded="false">En <i class="fas fa-chevron-down"></i></a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item tf-main-color" href="#">French</a></li>
        <li><a class="dropdown-item tf-main-color" href="#">Japanese</a></li>
        <li><a class="dropdown-item tf-main-color" href="#">Vietnamese</a></li>
    </ul>
</div>',
		'header_absolute'                    => 1,
		'header_height'                      => 100,
		'header_height_sticky'               => 80,
		'header_sidebar_toggler'             => 0,
		'show_post_navigator'                => 0,
		'show_entry_footer_content'          => 0,
		'logo_width'                         => 164,
		'menu_location_primary'              => 'primary',
		'site_logo'                          => THEMESFLAT_LINK . 'images/logo.png',
		'site_logo_sticky'                   => '',
		'site_logo_mobile'                   => THEMESFLAT_LINK . 'images/logo-mobile.png',

		'header_image_enable'				 => 0,
		'site_image_menu'                    => THEMESFLAT_LINK . 'images/sidenav-photo.jpg',

		'show_bottom'                        => 1,
		'header_backgroundcolor'             => '',
		'header_backgroundcolor_sticky'      => '',
		'header_color_main_nav'              => '',
		'header_color_hover_main_nav'        => '',
		'header_sticky_color_main_nav'       => '',
		'header_sticky_color_hover_main_nav' => '',
		'primary_color'                      => $primary_color,
		'secondary_color'                    => $secondary_color,
		'accent_color'                       => $accent_color,
		'typography_body'                    => array(
			'family'         => $body_font,
			'style'          => 'regular',
			'size'           => '18',
			'line_height'    => '1.5',
			'letter_spacing' => '',
		),

		//Phone
		'header_phone_enable'                => 0,
		'header_phone'                       => '(1)245-45678 Call',
		//email
		'header_email_enable'                => 0,
		'header_email'                       => 'Help.info@gmail.com',

		'header_social_icon'            => 1,
		'header_button_enable'          => 1,
		'header_button'                 => __( 'DOWNLOAD CV', 'fungi' ),
		'header_url_button'             => '#',


		//header info
		'header_info_time_label'        => esc_html__( 'Sat - Sun Off Day.', 'fungi' ),
		'header_info_time'              => esc_html__( 'Mon - Fri 8:00 - 19:00', 'fungi' ),
		'header_info_phone_number'      => '00 121 211 222',
		'header_info_email_label'       => esc_html__( 'Zoyot Gmail Here', 'fungi' ),
		'header_info_email'             => 'info.fungi@gmail.com',

		//header mobile
		'enable_search_box_mobile'      => 0,
		//menu
		'menu_distance_between'         => 19.2,
		'typography_sub_menu'           => array(
			'family'         => $primary_font,
			'style'          => '500',
			'size'           => '16',
			'line_height'    => '1.3',
			'letter_spacing' => '',
		),
		'sub_nav_color'                 => '',
		'sub_nav_color_hover'           => '',
		'sub_nav_background'            => '#ffffff',
		'sub_nav_border_color'          => '#E8E8E8',

		'body_text_color'         => '#666666',
		'body_background_color'   => '#fff',
		'page_sidebar_layout'     => 'fullwidth',
		'layout_version'          => 'wide',
		'content_controls'        => array( 'padding-top' => 120, 'padding-bottom' => 120 ),
		'content_controls_mobile' => array( 'padding-top' => 80, 'padding-bottom' => 80 ),
		'typography_menu'         => array(
			'family'         => $primary_font,
			'style'          => '700',
			'size'           => '18',
			'letter_spacing' => '',
		),

		'typography_headings'        => array(
			'family'         => $primary_font,
			'style'          => '700',
			'line_height'    => '1.2',
			'letter_spacing' => ''
		),
		'h1_size'                    => 72,
		'h2_size'                    => 48,
		'h3_size'                    => 32,
		'h4_size'                    => 24,
		'h5_size'                    => 20,
		'h6_size'                    => 18,
		'typography_blog_post_title' => array(
			'family'         => $primary_font,
			'style'          => '',
			'size'           => '',
			'line_height'    => '',
			'letter_spacing' => '',
		),
		'typography_blog_post_meta'  => array(
			'family'         => $body_font,
			'style'          => '',
			'size'           => '',
			'line_height'    => '',
			'letter_spacing' => '',
		),

		'typography_blog_single_title'         => array(
			'family'         => $primary_font,
			'style'          => '',
			'size'           => '',
			'line_height'    => '',
			'letter_spacing' => '',
		),
		'typography_blog_single_comment_title' => array(
			'family'         => $primary_font,
			'style'          => '',
			'size'           => '',
			'line_height'    => '',
			'letter_spacing' => '',
		),
		'typography_sidebar_widget_title'      => array(
			'family'         => $primary_font,
			'style'          => '700',
			'size'           => '20',
			'line_height'    => '1.25',
			'letter_spacing' => '',
		),
		//Page Title
		'page_title_styles'                    => 'default',
		'page_title_alignment'                 => 'text-center',
		'page_title_video_url'                 => THEMESFLAT_PROTOCOL . '://www.youtube.com/watch?v=JyMeGpvpjas',
		'typography_page_title'                => array(
			'family'         => $primary_font,
			'style'          => '700',
			'size'           => '40',
			'line_height'    => '1',
			'letter_spacing' => '',
		),
		'typography_page_title_mobile'         => array(
			'family'         => $primary_font,
			'style'          => '700',
			'size'           => '30',
			'line_height'    => '1',
			'letter_spacing' => '',
		),
		'page_title_background_color'          => '',
		'page_title_background_color_opacity'  => '100',
		'page_title_text_color'                => '#fff',
		'page_title_controls'                  => array( 'padding-top' => 150, 'padding-bottom' => 100 ),
		'page_title_controls_mobile'           => array( 'padding-top' => 70, 'padding-bottom' => 70 ),
		'page_title_background_image'          => '',
		'page_title_image_size'                => 'cover',
		'page_title_bg_fix_enabled'            => 0,
		'page_title_heading_enabled'           => 1,
		'typography_breadcrumb'                => array(
			'family'         => $primary_font,
			'style'          => '500',
			'size'           => '18',
			'line_height'    => '1.66',
			'letter_spacing' => '0',
		),

		'bread_crumb_prefix'   => '',
		'breadcrumb_separator' => wp_kses( '/', themesflat_kses_allowed_html() ),
		'breadcrumb_color'     => '#fff',

		'sub_title_enabled'    => 0,
		'sub_title'            => 'Welcome to Zoyot',
		'sub_title_color'      => 'rgba(255, 255, 255, 0.4)',
		'typography_sub_title' => array(
			'family'         => $primary_font,
			'style'          => '700',
			'size'           => '24',
			'line_height'    => '1',
			'letter_spacing' => '',
		),

		'typography_pagination'              => array(
			'family'         => $body_font,
			'style'          => '500',
			'size'           => '16',
			'line_height'    => '1.4',
			'letter_spacing' => '',
		),
		'typography_bottom_menu'             => array(
			'family'         => $primary_font,
			'style'          => '400',
			'size'           => '14',
			'line_height'    => '1.5',
			'letter_spacing' => '',
		),
		'breadcrumb_type'                    => 'breadcrumb-01',
		//Blog
		'show_post_paginator'                => 0,
		'blog_grid_columns'                  => 1,
		'blog_grid_columns_tablet'           => 1,
		'blog_grid_columns_mobile'           => 1,
		'post_content_elements'              => 'meta,title,excerpt_content,readmore',
		'meta_elements'                      => 'author,date,comment',
		'blog_archive_exclude'               => '',
		'blog_featured_title'                => '',
		'sidebar_layout'                     => 'sidebar-right',
		'blog_archive_layout'                => 'blog-standard',
		'related_post_style'                 => 'blog-grid',
		'grid_columns_post_related'          => 3,
		'number_related_post'                => 9,
		'blog_sidebar_list'                  => 'blog-sidebar',
		'blog_archive_readmore'              => 1,
		'blog_archive_post_excepts_length'   => 27,
		'blog_archive_readmore_text'         => esc_html__( 'Read More', 'fungi' ),
		'blog_archive_pagination_style'      => 'pager-numeric',
		'blog_posts_per_page'                => 9,
		'blog_order_by'                      => 'date',
		'blog_order_direction'               => 'DESC',
		'page_sidebar_list'                  => 'blog-sidebar',
		'single_sidebar_layout'              => 'sidebar-right',
		'blog_single_sidebar_list'           => 'blog-sidebar',
		//Services
		'services_slug'                      => '',
		'services_name'                      => '',
		'services_show_filter'               => 0,
		'services_grid_columns'              => 3,
		'services_grid_columns_tablet'       => 1,
		'services_grid_columns_mobile'       => 1,
		'services_number_post'               => 9,
		'services_order_by'                  => 'date',
		'services_order_direction'           => 'DESC',
		'services_exclude'                   => '',
		'services_layout'                    => 'fullwidth',
		'services_single_layout'             => 'sidebar-right',
		'services_show_post_navigator'       => 0,
		'services_archive_pagination_style'  => 'pager-numeric',
		'services_show_related'              => 0,
		'services_related_grid_columns'      => 3,
		'services_sidebar_list'              => 'services-sidebar',
		'services_single_sidebar_list'       => 'services-sidebar',
		'services_featured_title'            => esc_html__( 'Service Details', "fungi" ),
		'number_related_post_services'       => 3,
		//Portfolio
		'portfolio_slug'                     => 'portfolio',
		'portfolio_name'                     => esc_html__( "Portfolio", 'fungi' ),
		'portfolio_grid_columns'             => 3,
		'portfolio_grid_columns_tablet'      => 1,
		'portfolio_grid_columns_mobile'      => 1,
		'portfolio_number_post'              => 6,
		'portfolio_archive_pagination_style' => 'pager-numeric',
		'portfolio_order_by'                 => 'date',
		'portfolio_order_direction'          => 'DESC',
		'portfolio_exclude'                  => '',
		'portfolio_layout'                   => 'fullwidth',
		'portfolio_sidebar_list'             => 'blog-sidebar',
		'portfolio_show_post_navigator'      => 0,
		'portfolio_show_related'             => 0,
		'portfolio_related_grid_columns'     => 3,
		'number_related_post_portfolio'      => 3,
		'portfolio_featured_title'           => '',
		'portfolio_single_layout'            => 'fullwidth',
		'portfolio_single_sidebar_list'      => 'blog-sidebar',
	);

	return $default[ $key ];
}