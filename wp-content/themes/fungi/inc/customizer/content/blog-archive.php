<?php
$wp_customize->add_setting(
	'sidebar_layout',
	array(
		'default'           => themesflat_customize_default( 'sidebar_layout' ),
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	'sidebar_layout',
	array(
		'type'     => 'select',
		'section'  => 'section_content_blog_archive',
		'priority' => 1,
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
	'blog_archive_layout',
	array(
		'default'           => themesflat_customize_default( 'blog_archive_layout' ),
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	'blog_archive_layout',
	array(
		'type'     => 'select',
		'section'  => 'section_content_blog_archive',
		'priority' => 2,
		'label'    => esc_html__( 'Blog Layout', 'fungi' ),
		'choices'  => array(
			'blog-standard' => esc_html__( 'Blog Standard', 'fungi' ),
			'blog-list'     => esc_html__( 'Blog List', 'fungi' ),
			// 'blog-grid'     => esc_html__( 'Blog Grid', 'fungi' ),
		)
	)
);

// Gird columns Posts
$wp_customize->add_setting(
	'blog_grid_columns',
	array(
		'default'           => themesflat_customize_default( 'blog_grid_columns' ),
		'sanitize_callback' => 'themesflat_sanitize_grid_post_related',
	)
);
$wp_customize->add_control(
	'blog_grid_columns',
	array(
		'type'            => 'select',
		'section'         => 'section_content_blog_archive',
		'priority'        => 3,
		'label'           => esc_html__( 'Post Grid Columns', 'fungi' ),
		'choices'         => array(
			1 => esc_html__( '1 Columns', 'fungi' ),
			2 => esc_html__( '2 Columns', 'fungi' ),
			3 => esc_html__( '3 Columns', 'fungi' ),
			4 => esc_html__( '4 Columns', 'fungi' ),
		),
		'active_callback' => function () use ( $wp_customize ) {
			return 'blog-grid' === $wp_customize->get_setting( 'blog_archive_layout' )->value();
		},
	)
);

// Gird columns Posts tablet
$wp_customize->add_setting(
	'blog_grid_columns_tablet',
	array(
		'default'           => themesflat_customize_default( 'blog_grid_columns_tablet' ),
		'sanitize_callback' => 'themesflat_sanitize_grid_post_related',
	)
);
$wp_customize->add_control(
	'blog_grid_columns_tablet',
	array(
		'type'            => 'select',
		'section'         => 'section_content_blog_archive',
		'priority'        => 3,
		'label'           => esc_html__( 'Post Grid Columns Tablet', 'fungi' ),
		'choices'         => array(
			1 => esc_html__( '1 Columns', 'fungi' ),
			2 => esc_html__( '2 Columns', 'fungi' ),
			3 => esc_html__( '3 Columns', 'fungi' ),
			4 => esc_html__( '4 Columns', 'fungi' ),
		),
		'active_callback' => function () use ( $wp_customize ) {
			return 'blog-grid' === $wp_customize->get_setting( 'blog_archive_layout' )->value();
		},
	)
);

$wp_customize->add_setting(
	'blog_sidebar_list',
	array(
		'default'           => themesflat_customize_default( 'blog_sidebar_list' ),
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new themesflat_DropdownSidebars( $wp_customize,
		'blog_sidebar_list',
		array(
			'type'            => 'dropdown',
			'section'         => 'section_content_blog_archive',
			'priority'        => 4,
			'label'           => esc_html__( 'List Sidebar', 'fungi' ),
			'active_callback' => function () use ( $wp_customize ) {
				return 'sidebar-left' === $wp_customize->get_setting( 'sidebar_layout' )->value() || 'sidebar-right' === $wp_customize->get_setting( 'sidebar_layout' )->value();
			},
		) )
);

// Entry Content Elements
$wp_customize->add_setting(
	'post_content_elements',
	array(
		'sanitize_callback' => 'themesflat_sanitize_text',
		'default'           => themesflat_customize_default( 'post_content_elements' ),
	)
);
$wp_customize->add_control( new themesflat_Control_Drag_And_Drop( $wp_customize,
		'post_content_elements',
		array(
			'type'        => 'draganddrop-controls',
			'label'       => esc_html__( 'Post Content Elements', 'fungi' ),
			'description' => esc_html__( 'Drag and drop elements to re-order.', 'fungi' ),
			'section'     => 'section_content_blog_archive',
			'priority'    => 5,
			'choices'     => array(
				'meta'            => esc_html__( 'Meta', 'fungi' ),
				'title'           => esc_html__( 'Title', 'fungi' ),
				'excerpt_content' => esc_html__( 'Excerpt', 'fungi' ),
				'readmore'        => esc_html__( 'Read More', 'fungi' ),
			),
		) )
);

// Excerpt
$wp_customize->add_setting(
	'blog_archive_post_excepts_length',
	array(
		'default'           => themesflat_customize_default( 'blog_archive_post_excepts_length' ),
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( new themesflat_Slide_Control( $wp_customize,
		'blog_archive_post_excepts_length',
		array(
			'type'        => 'slide-control',
			'section'     => 'section_content_blog_archive',
			'label'       => 'Post Excepts Length',
			'priority'    => 6,
			'input_attrs' => array(
				'min'  => 0,
				'max'  => 500,
				'step' => 1,
			),
		)

	)
);

// Read More Text
$wp_customize->add_setting(
	'blog_archive_readmore_text',
	array(
		'default'           => themesflat_customize_default( 'blog_archive_readmore_text' ),
		'sanitize_callback' => 'themesflat_sanitize_text'
	)
);
$wp_customize->add_control(
	'blog_archive_readmore_text',
	array(
		'type'     => 'text',
		'label'    => esc_html__( 'Read More Text', 'fungi' ),
		'section'  => 'section_content_blog_archive',
		'priority' => 7
	)
);

// Meta Elements
$wp_customize->add_setting(
	'meta_elements',
	array(
		'sanitize_callback' => 'themesflat_sanitize_text',
		'default'           => themesflat_customize_default( 'meta_elements' ),
	)
);
$wp_customize->add_control( new themesflat_Control_Drag_And_Drop( $wp_customize,
		'meta_elements',
		array(
			'type'        => 'draganddrop-controls',
			'label'       => esc_html__( 'Meta Elements', 'fungi' ),
			'description' => esc_html__( 'Drag and drop elements to re-order.', 'fungi' ),
			'section'     => 'section_content_blog_archive',
			'priority'    => 8,
			'choices'     => array(
				'author'   => esc_html__( 'Author', 'fungi' ),
				'date'     => esc_html__( 'Date', 'fungi' ),
				'category' => esc_html__( 'Category', 'fungi' ),
				'comment'  => esc_html__( 'Comment', 'fungi' ),
			),
		) )
);

// Pagination
$wp_customize->add_setting(
	'blog_archive_pagination_style',
	array(
		'default'           => themesflat_customize_default( 'blog_archive_pagination_style' ),
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	'blog_archive_pagination_style',
	array(
		'type'     => 'select',
		'section'  => 'section_content_blog_archive',
		'priority' => 9,
		'label'    => esc_html__( 'Pagination Style', 'fungi' ),
		'choices'  => array(
			'pager'         => esc_html__( 'Pager', 'fungi' ),
			'numeric'       => esc_html__( 'Numeric', 'fungi' ),
			'pager-numeric' => esc_html__( 'Pager & Numeric', 'fungi' ),
			'loadmore'      => esc_html__( 'Load More', 'fungi' )
		),
	)
);