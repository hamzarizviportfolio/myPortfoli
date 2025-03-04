<?php
// ADD SECTION PAGE TITLE
$wp_customize->add_section( 'section_page_title', array(
	'title'    => 'Page Title',
	'priority' => 1,
	'panel'    => 'page_title_panel',
) );
require THEMESFLAT_DIR . "inc/customizer/page-title/page-title.php";

// ADD SECTION BREADCRUMB
$wp_customize->add_section( 'section_breadcrumb', array(
	'title'    => 'Breadcrumb',
	'priority' => 3,
	'panel'    => 'page_title_panel',
) );
require THEMESFLAT_DIR . "inc/customizer/page-title/breadcrumb.php";


// ADD SECTION Sub l
// $wp_customize->add_section( 'section_subtitle', array(
// 	'title'    => 'Sub Title',
// 	'priority' => 3,
// 	'panel'    => 'page_title_panel',
// ) );
// require THEMESFLAT_DIR . "inc/customizer/page-title/sub-title.php";