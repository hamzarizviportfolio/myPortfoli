<?php
/**
 * The template for displaying all single posts.
 *
 * @package fungi
 */

get_header();
$custom_layout = '';
if ( isset( $_GET['blog_layout'] ) ) {
	$custom_layout = $_GET['blog_layout'];
}
$sidebar       = themesflat_get_opt( 'blog_single_sidebar_list' );
$content_class = 'col-12';
if ( ( themesflat_get_opt( 'single_sidebar_layout' ) == 'sidebar-left' || themesflat_get_opt( 'single_sidebar_layout' ) == 'sidebar-right' || $custom_layout == 'sidebar-right' || $custom_layout == 'sidebar-left' ) && is_active_sidebar( $sidebar ) ) {
	$content_class = 'col-lg-8';
}
$main_class = 'col';
if ( themesflat_get_opt( 'single_sidebar_layout' ) == 'fullwidth' && ( $custom_layout == '' || $custom_layout == 'fullwidth' ) ) {
	$main_class = 'col-lg-8 mx-auto';
}
?>
<div class="container">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
        <div class="row tf-wrap-content">
            <div class="tf-content-single-wrap tf-content-wrap <?php echo esc_attr( $content_class ) ?>">
                <div id="primary" class="content-area">
                    <main id="main" class="post-wrap" role="main">
						<?php
						get_template_part( 'tpl/feature-post-single' );
						?>
                        <div class="main-single row">
                            <div class="<?php echo esc_attr( $main_class ) ?>">
								<?php
								get_template_part( 'content', 'single' );
								if ( 'post' == get_post_type() && themesflat_get_opt( 'show_post_navigator' ) != 0 ):
									themesflat_post_navigation();
								endif;
								?>


								<?php
								get_template_part( 'tpl/related-post' );
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
								?>
                            </div>
                        </div><!-- /.main-single -->
                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
			<?php

			if ( themesflat_get_opt( 'single_sidebar_layout' ) == 'sidebar-left' || themesflat_get_opt( 'single_sidebar_layout' ) == 'sidebar-right' || $custom_layout == 'sidebar-right' || $custom_layout == 'sidebar-left' ) :
				get_sidebar();
			endif;
			?>
        </div>
	<?php endwhile; // end of the loop. ?>
</div><!-- /.container -->
<?php get_footer(); ?>
