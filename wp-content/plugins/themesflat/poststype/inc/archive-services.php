<?php
/**
 * The template for displaying archive practise area.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package zoyot
 */

get_header();
$services_number_post = themesflat_get_opt( 'services_number_post' ) ? themesflat_get_opt( 'services_number_post' ) : 9;
$columns              = themesflat_get_opt( 'services_grid_columns' );
$columns_tb           = themesflat_get_opt( 'services_grid_columns_tablet' );
$columns_mb           = themesflat_get_opt( 'services_grid_columns_mobile' );
$orderby              = themesflat_get_opt( 'services_order_by' );
$order                = themesflat_get_opt( 'services_order_direction' );
$exclude              = themesflat_get_opt( 'services_exclude' );
$terms_slug           = wp_list_pluck( get_terms( 'services_category', 'hide_empty=0' ), 'slug' );

$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

$args = array(
	'post_type'      => 'services',
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => $paged,
	'posts_per_page' => $services_number_post,
);
if ( $terms_slug ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'services_category',
			'field'    => 'slug',
			'terms'    => $terms_slug,
		),
	);
}

if ( ! empty( $exclude ) ) {
	if ( ! is_array( $exclude ) ) {
		$exclude = explode( ',', $exclude );
	}

	$args['post__not_in'] = $exclude;
}

$query        = new WP_Query( $args );
$item_classes = themesflat_create_columns( $columns, $columns_tb, $columns_mb );
$sidebar      = themesflat_get_opt( 'services_sidebar_list' );
$main_class   = 'col-12';
if ( themesflat_get_opt( 'services_layout' ) == 'sidebar-left' || themesflat_get_opt( 'services_layout' ) == 'sidebar-right' ) {
	if ( is_active_sidebar( $sidebar ) ) {
		$main_class = 'col-lg-8';
	}
}
$themesflat_paging_style = themesflat_get_opt( 'services_archive_pagination_style' );
?>
    <div class="themesflat-services-taxonomy">
        <div class="container">
            <div class="wrap-content-area">
                <div class="row">
                    <div class="<?php echo esc_attr( $main_class ) ?> content-wrap">
                        <div id="primary" class="content-area">
                            <main id="main" class="main-content" role="main">

                                <div class="wrap-services-post tf-services-style-01 row column-<?php echo esc_attr( $columns ); ?>">
									<?php
									if ( $query->have_posts() ) {
										while ( $query->have_posts() ) : $query->the_post();
											global $post;
											$id                 = $post->ID;
											?>
                                            <div class="item <?php echo esc_attr( $item_classes ) ?>">
                                                <div class="tf-services-post tf-services-post-<?php the_ID(); ?>">
                                                    <div class="featured-post">
		                                                <?php
		                                                themesflat_render_thumbnail_markup( array(
			                                                'image_size'  => '540x540',
			                                                'image_mode'  => 'background',
		                                                ) );
		                                                ?>
                                                    </div>
                                                    <div class="content">
                                                        <div class="content-wrap">
                                                            <div class="post-meta services-meta services-categories">
		                                                        <?php echo get_the_term_list( $id, 'services_category', '', ', ', '' ); ?>
                                                            </div>
	                                                        <?php $title = get_the_title();
	                                                        ?>
                                                            <h2 class="title">
                                                                <a href="<?php echo get_the_permalink(); ?>"><?php echo esc_html( $title ) ?></a>
                                                            </h2>
                                                        </div>
                                                        <a href="<?php echo get_the_permalink(); ?>"
                                                           class="services-view-more">
                                                            <i class="fal fa-long-arrow-right"></i>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
										<?php
										endwhile;
									} else {
										get_template_part( 'template-parts/content', 'none' );
									}
									?>
                                </div>
								<?php
								themesflat_pagination_posttype( $query, $themesflat_paging_style );
								wp_reset_postdata();
								?>
                            </main><!-- #main -->
                        </div><!-- #primary -->
                    </div>
					<?php
					if ( themesflat_get_opt( 'services_layout' ) == 'sidebar-left' || themesflat_get_opt( 'services_layout' ) == 'sidebar-right' ) :
						get_sidebar();
					endif;
					?>

                </div>
            </div>
        </div>
    </div><!-- /.themesflat-services-taxonomy -->
<?php get_footer(); ?>