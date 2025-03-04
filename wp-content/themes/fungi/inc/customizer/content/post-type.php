<?php
if ( function_exists( 'themesflat_register_services_post_type' ) ) {

	/* Service Archive
	=================================================*/
	$wp_customize->add_control( new themesflat_Info( $wp_customize, 'services', array(
			'label'    => esc_html__( 'SERVICES ARCHIVE', 'fungi' ),
			'section'  => 'section_content_post_type',
			'settings' => 'themesflat_options[info]',
			'priority' => 115
		) )
	);

	// Service Slug
	$wp_customize->add_setting(
		'services_slug',
		array(
			'default'           => themesflat_customize_default( 'services_slug' ),
			'sanitize_callback' => 'themesflat_sanitize_text'
		)
	);
	$wp_customize->add_control(
		'services_slug',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Service Slug', 'fungi' ),
			'section'  => 'section_content_post_type',
			'priority' => 120
		)
	);

	// services Name
	$wp_customize->add_setting(
		'services_name',
		array(
			'default'           => themesflat_customize_default( 'services_name' ),
			'sanitize_callback' => 'themesflat_sanitize_text'
		)
	);
	$wp_customize->add_control(
		'services_name',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Service Name', 'fungi' ),
			'section'  => 'section_content_post_type',
			'priority' => 125
		)
	);

	$wp_customize->add_setting(
		'services_layout',
		array(
			'default'           => themesflat_customize_default( 'services_layout' ),
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'services_layout',
		array(
			'type'     => 'select',
			'section'  => 'section_content_post_type',
			'priority' => 130,
			'label'    => esc_html__( 'Sidebar Position', 'fungi' ),
			'choices'  => array(
				'sidebar-right'    => esc_html__( 'Sidebar Right', 'fungi' ),
				'sidebar-left'     => esc_html__( 'Sidebar Left', 'fungi' ),
				'fullwidth'        => esc_html__( 'Full Width', 'fungi' ),
				'fullwidth-small'  => esc_html__( 'Full Width Small', 'fungi' ),
				'fullwidth-center' => esc_html__( 'Full Width Center', 'fungi' ),
			),
		)
	);

	$wp_customize->add_setting(
		'services_sidebar_list',
		array(
			'default'           => themesflat_customize_default( 'services_sidebar_list' ),
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control( new themesflat_DropdownSidebars( $wp_customize,
			'services_sidebar_list',
			array(
				'type'            => 'dropdown',
				'section'         => 'section_content_post_type',
				'priority'        => 135,
				'label'           => esc_html__( 'List Sidebar', 'fungi' ),
				'active_callback' => function () use ( $wp_customize ) {
					return 'sidebar-right' === $wp_customize->get_setting( 'services_layout' )->value() || 'sidebar-left' === $wp_customize->get_setting( 'services_layout' )->value();
				},

			) )
	);

	// Number Posts services
	$wp_customize->add_setting(
		'services_number_post',
		array(
			'default'           => themesflat_customize_default( 'services_number_post' ),
			'sanitize_callback' => 'themesflat_sanitize_text'
		)
	);
	$wp_customize->add_control(
		'services_number_post',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Show Number Posts', 'fungi' ),
			'section'  => 'section_content_post_type',
			'priority' => 140
		)
	);

	// Gird columns services
	$wp_customize->add_setting(
		'services_grid_columns',
		array(
			'default'           => themesflat_customize_default( 'services_grid_columns' ),
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'services_grid_columns',
		array(
			'type'     => 'select',
			'section'  => 'section_content_post_type',
			'priority' => 145,
			'label'    => esc_html__( 'Grid Columns', 'fungi' ),
			'choices'  => array(
				2 => esc_html__( '2 Columns', 'fungi' ),
				3 => esc_html__( '3 Columns', 'fungi' ),
				4 => esc_html__( '4 Columns', 'fungi' )
			)
		)
	);

	// Gird columns services tablet
	$wp_customize->add_setting(
		'services_grid_columns_tablet',
		array(
			'default'           => themesflat_customize_default( 'services_grid_columns_tablet' ),
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'services_grid_columns_tablet',
		array(
			'type'     => 'select',
			'section'  => 'section_content_post_type',
			'priority' => 150,
			'label'    => esc_html__( 'Grid Columns Tablet', 'fungi' ),
			'choices'  => array(
				1 => esc_html__( '1 Columns', 'fungi' ),
				2 => esc_html__( '2 Columns', 'fungi' ),
				3 => esc_html__( '3 Columns', 'fungi' ),
				4 => esc_html__( '4 Columns', 'fungi' )
			)
		)
	);

	// Gird columns services mobile
	$wp_customize->add_setting(
		'services_grid_columns_mobile',
		array(
			'default'           => themesflat_customize_default( 'services_grid_columns_mobile' ),
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'services_grid_columns_mobile',
		array(
			'type'     => 'select',
			'section'  => 'section_content_post_type',
			'priority' => 155,
			'label'    => esc_html__( 'Grid Columns Mobile', 'fungi' ),
			'choices'  => array(
				1 => esc_html__( '1 Columns', 'fungi' ),
				2 => esc_html__( '2 Columns', 'fungi' ),
				3 => esc_html__( '3 Columns', 'fungi' ),
				4 => esc_html__( '4 Columns', 'fungi' )
			)
		)
	);

	// Order By services
	$wp_customize->add_setting(
		'services_order_by',
		array(
			'default'           => themesflat_customize_default( 'services_order_by' ),
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'services_order_by',
		array(
			'type'     => 'select',
			'label'    => esc_html__( 'Order By', 'fungi' ),
			'section'  => 'section_content_post_type',
			'priority' => 160,
			'choices'  => array(
				'date'          => esc_html__( 'Date', 'fungi' ),
				'id'            => esc_html__( 'Id', 'fungi' ),
				'author'        => esc_html__( 'Author', 'fungi' ),
				'title'         => esc_html__( 'Title', 'fungi' ),
				'modified'      => esc_html__( 'Modified', 'fungi' ),
				'comment_count' => esc_html__( 'Comment Count', 'fungi' ),
				'menu_order'    => esc_html__( 'Menu Order', 'fungi' )
			)
		)
	);

	// Order Direction services
	$wp_customize->add_setting(
		'services_order_direction',
		array(
			'default'           => themesflat_customize_default( 'services_order_direction' ),
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'services_order_direction',
		array(
			'type'     => 'select',
			'label'    => esc_html__( 'Order Direction', 'fungi' ),
			'section'  => 'section_content_post_type',
			'priority' => 165,
			'choices'  => array(
				'DESC' => esc_html__( 'Descending', 'fungi' ),
				'ASC'  => esc_html__( 'Assending', 'fungi' )
			)
		)
	);

	// services Exclude Post
	$wp_customize->add_setting(
		'services_exclude',
		array(
			'default'           => themesflat_customize_default( 'services_exclude' ),
			'sanitize_callback' => 'themesflat_sanitize_text'
		)
	);
	$wp_customize->add_control(
		'services_exclude',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Post Ids Will Be Inorged. Ex: 1,2,3', 'fungi' ),
			'section'  => 'section_content_post_type',
			'priority' => 170
		)
	);
	// Pagination
	$wp_customize->add_setting(
		'services_archive_pagination_style',
		array(
			'default'           => themesflat_customize_default( 'services_archive_pagination_style' ),
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'services_archive_pagination_style',
		array(
			'type'     => 'select',
			'section'  => 'section_content_post_type',
			'priority' => 172,
			'label'    => esc_html__( 'Pagination Style', 'fungi' ),
			'choices'  => array(
				'pager'         => esc_html__( 'Pager', 'fungi' ),
				'numeric'       => esc_html__( 'Numeric', 'fungi' ),
				'pager-numeric' => esc_html__( 'Pager & Numeric', 'fungi' ),
				'loadmore'      => esc_html__( 'Load More', 'fungi' )
			),
		)
	);

	/* Service Single
	=================================================*/
	$wp_customize->add_control( new themesflat_Info( $wp_customize, 'services_single', array(
			'label'    => esc_html__( 'SERVICES SINGLE', 'fungi' ),
			'section'  => 'section_content_post_type',
			'settings' => 'themesflat_options[info]',
			'priority' => 175
		) )
	);

	// Customize Service Featured Title
	$wp_customize->add_setting(
		'services_featured_title',
		array(
			'default'           => themesflat_customize_default( 'services_featured_title' ),
			'sanitize_callback' => 'themesflat_sanitize_text'
		)
	);
	$wp_customize->add_control(
		'services_featured_title',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Customize Service Featured Title', 'fungi' ),
			'section'  => 'section_content_post_type',
			'priority' => 180
		)
	);
	$wp_customize->add_setting(
		'services_single_layout',
		array(
			'default'           => themesflat_customize_default( 'services_single_layout' ),
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control(
		'services_single_layout',
		array(
			'type'     => 'select',
			'section'  => 'section_content_post_type',
			'priority' => 185,
			'label'    => esc_html__( 'Sidebar Position', 'fungi' ),
			'choices'  => array(
				'sidebar-right' => esc_html__( 'Sidebar Right', 'fungi' ),
				'sidebar-left'  => esc_html__( 'Sidebar Left', 'fungi' ),
				'fullwidth'     => esc_html__( 'Full Width', 'fungi' ),
			),
		)
	);

	$wp_customize->add_setting(
		'services_single_sidebar_list',
		array(
			'default'           => themesflat_customize_default( 'services_single_sidebar_list' ),
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control( new themesflat_DropdownSidebars( $wp_customize,
			'services_single_sidebar_list',
			array(
				'type'            => 'dropdown',
				'section'         => 'section_content_post_type',
				'priority'        => 190,
				'label'           => esc_html__( 'List Sidebar', 'fungi' ),
				'active_callback' => function () use ( $wp_customize ) {
					return 'sidebar-right' === $wp_customize->get_setting( 'services_single_layout' )->value() || 'sidebar-left' === $wp_customize->get_setting( 'services_single_layout' )->value();
				},
			) )
	);

	// Show Post Navigator Service
	$wp_customize->add_setting(
		'services_show_post_navigator',
		array(
			'sanitize_callback' => 'themesflat_sanitize_checkbox',
			'default'           => themesflat_customize_default( 'services_show_post_navigator' ),
		)
	);
	$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
			'services_show_post_navigator',
			array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Single Navigator ( OFF | ON )', 'fungi' ),
				'section'  => 'section_content_post_type',
				'priority' => 195
			) )
	);

	// Show Related services
	$wp_customize->add_setting(
		'services_show_related',
		array(
			'sanitize_callback' => 'themesflat_sanitize_checkbox',
			'default'           => themesflat_customize_default( 'services_show_related' ),
		)
	);
	$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
			'services_show_related',
			array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Related services ( OFF | ON )', 'fungi' ),
				'section'  => 'section_content_post_type',
				'priority' => 200
			) )
	);

	// Gird columns Service related
	$wp_customize->add_setting(
		'services_related_grid_columns',
		array(
			'default'           => themesflat_customize_default( 'services_related_grid_columns' ),
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'services_related_grid_columns',
		array(
			'type'     => 'select',
			'section'  => 'section_content_post_type',
			'priority' => 205,
			'label'    => esc_html__( 'Columns Related', 'fungi' ),
			'choices'  => array(
				2 => esc_html__( '2 Columns', 'fungi' ),
				3 => esc_html__( '3 Columns', 'fungi' ),
				4 => esc_html__( '4 Columns', 'fungi' )
			)
		)
	);

	// Number Of Related Posts services
	$wp_customize->add_setting(
		'number_related_post_services',
		array(
			'default'           => themesflat_customize_default( 'number_related_post_services' ),
			'sanitize_callback' => 'themesflat_sanitize_text'
		)
	);
	$wp_customize->add_control(
		'number_related_post_services',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Number Of Related Posts', 'fungi' ),
			'section'  => 'section_content_post_type',
			'priority' => 210
		)
	);
}

if ( function_exists( 'themesflat_register_portfolio_post_type' ) ) {

	/* Portfolio Archive
	=================================================*/
	$wp_customize->add_control( new themesflat_Info( $wp_customize, 'portfolio', array(
			'label'    => esc_html__( 'PORTFOLIO ARCHIVE', 'fungi' ),
			'section'  => 'section_content_post_type',
			'settings' => 'themesflat_options[info]',
			'priority' => 215
		) )
	);

	// portfolio Slug
	$wp_customize->add_setting(
		'portfolio_slug',
		array(
			'default'           => themesflat_customize_default( 'portfolio_slug' ),
			'sanitize_callback' => 'themesflat_sanitize_text'
		)
	);
	$wp_customize->add_control(
		'portfolio_slug',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Courses Slug', 'fungi' ),
			'section'  => 'section_content_post_type',
			'priority' => 220
		)
	);

	// Attorney Name
	$wp_customize->add_setting(
		'portfolio_name',
		array(
			'default'           => themesflat_customize_default( 'portfolio_name' ),
			'sanitize_callback' => 'themesflat_sanitize_text'
		)
	);
	$wp_customize->add_control(
		'portfolio_name',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Courses Name', 'fungi' ),
			'section'  => 'section_content_post_type',
			'priority' => 225
		)
	);

	$wp_customize->add_setting(
		'portfolio_layout',
		array(
			'default'           => themesflat_customize_default( 'portfolio_layout' ),
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'portfolio_layout',
		array(
			'type'     => 'select',
			'section'  => 'section_content_post_type',
			'priority' => 230,
			'label'    => esc_html__( 'Sidebar Position', 'fungi' ),
			'choices'  => array(
				'sidebar-right'    => esc_html__( 'Sidebar Right', 'fungi' ),
				'sidebar-left'     => esc_html__( 'Sidebar Left', 'fungi' ),
				'fullwidth'        => esc_html__( 'Full Width', 'fungi' ),
				'fullwidth-small'  => esc_html__( 'Full Width Small', 'fungi' ),
				'fullwidth-center' => esc_html__( 'Full Width Center', 'fungi' ),
			),
		)
	);

	$wp_customize->add_setting(
		'portfolio_sidebar_list',
		array(
			'default'           => themesflat_customize_default( 'portfolio_sidebar_list' ),
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control( new themesflat_DropdownSidebars( $wp_customize,
			'portfolio_sidebar_list',
			array(
				'type'            => 'dropdown',
				'section'         => 'section_content_post_type',
				'priority'        => 235,
				'label'           => esc_html__( 'List Sidebar', 'fungi' ),
				'active_callback' => function () use ( $wp_customize ) {
					return 'sidebar-right' === $wp_customize->get_setting( 'portfolio_layout' )->value() || 'sidebar-left' === $wp_customize->get_setting( 'portfolio_layout' )->value();
				},

			) )
	);

	// Number Posts portfolio
	$wp_customize->add_setting(
		'portfolio_number_post',
		array(
			'default'           => themesflat_customize_default( 'portfolio_number_post' ),
			'sanitize_callback' => 'themesflat_sanitize_text'
		)
	);
	$wp_customize->add_control(
		'portfolio_number_post',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Show Number Posts', 'fungi' ),
			'section'  => 'section_content_post_type',
			'priority' => 240
		)
	);

	// Gird columns portfolio
	$wp_customize->add_setting(
		'portfolio_grid_columns',
		array(
			'default'           => themesflat_customize_default( 'portfolio_grid_columns' ),
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'portfolio_grid_columns',
		array(
			'type'     => 'select',
			'section'  => 'section_content_post_type',
			'priority' => 245,
			'label'    => esc_html__( 'Grid Columns', 'fungi' ),
			'choices'  => array(
				2 => esc_html__( '2 Columns', 'fungi' ),
				3 => esc_html__( '3 Columns', 'fungi' ),
				4 => esc_html__( '4 Columns', 'fungi' )
			)
		)
	);

	// Gird columns portfolio tablet
	$wp_customize->add_setting(
		'portfolio_grid_columns_tablet',
		array(
			'default'           => themesflat_customize_default( 'portfolio_grid_columns_tablet' ),
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'portfolio_grid_columns_tablet',
		array(
			'type'     => 'select',
			'section'  => 'section_content_post_type',
			'priority' => 250,
			'label'    => esc_html__( 'Grid Columns Tablet', 'fungi' ),
			'choices'  => array(
				1 => esc_html__( '1 Columns', 'fungi' ),
				2 => esc_html__( '2 Columns', 'fungi' ),
				3 => esc_html__( '3 Columns', 'fungi' ),
				4 => esc_html__( '4 Columns', 'fungi' )
			)
		)
	);

	// Gird columns portfolio mobile
	$wp_customize->add_setting(
		'portfolio_grid_columns_mobile',
		array(
			'default'           => themesflat_customize_default( 'portfolio_grid_columns_mobile' ),
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'portfolio_grid_columns_mobile',
		array(
			'type'     => 'select',
			'section'  => 'section_content_post_type',
			'priority' => 255,
			'label'    => esc_html__( 'Grid Columns Mobile', 'fungi' ),
			'choices'  => array(
				1 => esc_html__( '1 Columns', 'fungi' ),
				2 => esc_html__( '2 Columns', 'fungi' ),
				3 => esc_html__( '3 Columns', 'fungi' ),
				4 => esc_html__( '4 Columns', 'fungi' )
			)
		)
	);

	// Order By portfolio
	$wp_customize->add_setting(
		'portfolio_order_by',
		array(
			'default'           => themesflat_customize_default( 'portfolio_order_by' ),
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'portfolio_order_by',
		array(
			'type'     => 'select',
			'label'    => esc_html__( 'Order By', 'fungi' ),
			'section'  => 'section_content_post_type',
			'priority' => 260,
			'choices'  => array(
				'date'          => esc_html__( 'Date', 'fungi' ),
				'id'            => esc_html__( 'Id', 'fungi' ),
				'author'        => esc_html__( 'Author', 'fungi' ),
				'title'         => esc_html__( 'Title', 'fungi' ),
				'modified'      => esc_html__( 'Modified', 'fungi' ),
				'comment_count' => esc_html__( 'Comment Count', 'fungi' ),
				'menu_order'    => esc_html__( 'Menu Order', 'fungi' )
			)
		)
	);

	// Order Direction portfolio
	$wp_customize->add_setting(
		'portfolio_order_direction',
		array(
			'default'           => themesflat_customize_default( 'portfolio_order_direction' ),
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'portfolio_order_direction',
		array(
			'type'     => 'select',
			'label'    => esc_html__( 'Order Direction', 'fungi' ),
			'section'  => 'section_content_post_type',
			'priority' => 265,
			'choices'  => array(
				'DESC' => esc_html__( 'Descending', 'fungi' ),
				'ASC'  => esc_html__( 'Assending', 'fungi' )
			)
		)
	);

	// portfolio Exclude Post
	$wp_customize->add_setting(
		'portfolio_exclude',
		array(
			'default'           => themesflat_customize_default( 'portfolio_exclude' ),
			'sanitize_callback' => 'themesflat_sanitize_text'
		)
	);
	$wp_customize->add_control(
		'portfolio_exclude',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Post Ids Will Be Inorged. Ex: 1,2,3', 'fungi' ),
			'section'  => 'section_content_post_type',
			'priority' => 270
		)
	);
	// Pagination
	$wp_customize->add_setting(
		'portfolio_archive_pagination_style',
		array(
			'default'           => themesflat_customize_default( 'portfolio_archive_pagination_style' ),
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'portfolio_archive_pagination_style',
		array(
			'type'     => 'select',
			'section'  => 'section_content_post_type',
			'priority' => 271,
			'label'    => esc_html__( 'Pagination Style', 'fungi' ),
			'choices'  => array(
				'pager'         => esc_html__( 'Pager', 'fungi' ),
				'numeric'       => esc_html__( 'Numeric', 'fungi' ),
				'pager-numeric' => esc_html__( 'Pager & Numeric', 'fungi' ),
				'loadmore'      => esc_html__( 'Load More', 'fungi' )
			),
		)
	);

	/* Courses Single
	=================================================*/
	$wp_customize->add_control( new themesflat_Info( $wp_customize, 'portfolio_single', array(
			'label'    => esc_html__( 'PORTFOLIO SINGLE', 'fungi' ),
			'section'  => 'section_content_post_type',
			'settings' => 'themesflat_options[info]',
			'priority' => 275
		) )
	);

	// Customize portfolio Featured Title
	$wp_customize->add_setting(
		'portfolio_featured_title',
		array(
			'default'           => themesflat_customize_default( 'portfolio_featured_title' ),
			'sanitize_callback' => 'themesflat_sanitize_text'
		)
	);
	$wp_customize->add_control(
		'portfolio_featured_title',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Customize Courses Featured Title', 'fungi' ),
			'section'  => 'section_content_post_type',
			'priority' => 280
		)
	);
	$wp_customize->add_setting(
		'portfolio_single_layout',
		array(
			'default'           => themesflat_customize_default( 'portfolio_single_layout' ),
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control(
		'portfolio_single_layout',
		array(
			'type'     => 'select',
			'section'  => 'section_content_post_type',
			'priority' => 285,
			'label'    => esc_html__( 'Sidebar Position', 'fungi' ),
			'choices'  => array(
				'sidebar-right' => esc_html__( 'Sidebar Right', 'fungi' ),
				'sidebar-left'  => esc_html__( 'Sidebar Left', 'fungi' ),
				'fullwidth'     => esc_html__( 'Full Width', 'fungi' ),
			),
		)
	);

	$wp_customize->add_setting(
		'portfolio_single_sidebar_list',
		array(
			'default'           => themesflat_customize_default( 'portfolio_single_sidebar_list' ),
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control( new themesflat_DropdownSidebars( $wp_customize,
			'portfolio_single_sidebar_list',
			array(
				'type'            => 'dropdown',
				'section'         => 'section_content_post_type',
				'priority'        => 290,
				'label'           => esc_html__( 'List Sidebar', 'fungi' ),
				'active_callback' => function () use ( $wp_customize ) {
					return 'sidebar-right' === $wp_customize->get_setting( 'portfolio_single_layout' )->value() || 'sidebar-left' === $wp_customize->get_setting( 'portfolio_single_layout' )->value();
				},

			) )
	);

	// Show Post Navigator portfolio
	$wp_customize->add_setting(
		'portfolio_show_post_navigator',
		array(
			'sanitize_callback' => 'themesflat_sanitize_checkbox',
			'default'           => themesflat_customize_default( 'portfolio_show_post_navigator' ),
		)
	);
	$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
			'portfolio_show_post_navigator',
			array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Single Navigator ( OFF | ON )', 'fungi' ),
				'section'  => 'section_content_post_type',
				'priority' => 295
			) )
	);

	// Show Related portfolio
	$wp_customize->add_setting(
		'portfolio_show_related',
		array(
			'sanitize_callback' => 'themesflat_sanitize_checkbox',
			'default'           => themesflat_customize_default( 'portfolio_show_related' ),
		)
	);
	$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
			'portfolio_show_related',
			array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Related Courses ( OFF | ON )', 'fungi' ),
				'section'  => 'section_content_post_type',
				'priority' => 300
			) )
	);

	// Gird columns portfolio related
	$wp_customize->add_setting(
		'portfolio_related_grid_columns',
		array(
			'default'           => themesflat_customize_default( 'portfolio_related_grid_columns' ),
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'portfolio_related_grid_columns',
		array(
			'type'     => 'select',
			'section'  => 'section_content_post_type',
			'priority' => 305,
			'label'    => esc_html__( 'Columns Related', 'fungi' ),
			'choices'  => array(
				2 => esc_html__( '2 Columns', 'fungi' ),
				3 => esc_html__( '3 Columns', 'fungi' ),
				4 => esc_html__( '4 Columns', 'fungi' )
			)
		)
	);

	// Number Of Related Posts portfolio
	$wp_customize->add_setting(
		'number_related_post_portfolio',
		array(
			'default'           => themesflat_customize_default( 'number_related_post_portfolio' ),
			'sanitize_callback' => 'themesflat_sanitize_text'
		)
	);
	$wp_customize->add_control(
		'number_related_post_portfolio',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Number Of Related Courses', 'fungi' ),
			'section'  => 'section_content_post_type',
			'priority' => 310
		)
	);
}