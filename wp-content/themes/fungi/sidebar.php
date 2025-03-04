<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package fungi
 */
?>

<?php
$sidebar = themesflat_get_opt( 'blog_sidebar_list' );
if ( is_single() ) {
	$sidebar = themesflat_get_opt( 'blog_single_sidebar_list' );
}

if ( is_page() ) {
	$sidebar = themesflat_get_opt( 'page_sidebar_list' );
}
if ( 'services' == get_post_type() ) {
	$sidebar = themesflat_get_opt( 'services_sidebar_list' );
	if ( is_single() ) {
		$sidebar = themesflat_get_opt( 'services_single_sidebar_list' );
	}
}

if ( 'courses' == get_post_type() && is_single() ) {
	$sidebar = themesflat_get_opt( 'courses_single_sidebar_list' );
	if ( is_single() ) {
		$sidebar = themesflat_get_opt( 'courses_single_sidebar_list' );
	}
}

if ( is_search() ) {
	$sidebar = themesflat_get_opt( 'blog_sidebar_list' );
}

if ( is_active_sidebar( $sidebar ) ):
	?>
    <div id="secondary" class="col-lg-4 tf-sidebar widget-area" role="complementary">
        <div class="sidebar">
			<?php
			themesflat_dynamic_sidebar( $sidebar );
			?>
        </div>
    </div><!-- #secondary -->
<?php
endif;
?>