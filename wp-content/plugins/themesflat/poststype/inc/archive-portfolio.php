<?php
/**
 * The template for displaying archive course.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package zoyot
 */

get_header(); ?>
<?php
$portfolio_number_post   = themesflat_get_opt( 'portfolio_number_post' ) ? themesflat_get_opt( 'portfolio_number_post' ) : 6;
$columns                 = themesflat_get_opt( 'portfolio_grid_columns' );
$columns_tb              = themesflat_get_opt( 'portfolio_grid_columns_tablet' );
$columns_mb              = themesflat_get_opt( 'portfolio_grid_columns_mobile' );
$themesflat_paging_style = themesflat_get_opt( 'portfolio_archive_pagination_style' );
$orderby                 = themesflat_get_opt( 'portfolio_order_by' );
$order                   = themesflat_get_opt( 'portfolio_order_direction' );
$exclude                 = themesflat_get_opt( 'portfolio_exclude' );
$terms_slug              = wp_list_pluck( get_terms( 'portfolio_category', 'hide_empty=0' ), 'slug' );

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$query_args = array(
	'post_type'      => 'portfolio',
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => $paged,
	'posts_per_page' => $portfolio_number_post
);
if ( ! empty( $terms_slug ) ) {
	$query_args['tax_query'] = array(
		array(
			'taxonomy' => 'portfolio_category',
			'field'    => 'slug',
			'terms'    => $terms_slug,
		),
	);
}

if ( ! empty( $exclude ) ) {
	if ( ! is_array( $exclude ) ) {
		$exclude = explode( ',', $exclude );
	}

	$query_args['post__not_in'] = $exclude;
}
$query        = new WP_Query( $query_args );
$item_classes = themesflat_create_columns( $columns, $columns_tb, $columns_mb );
$sidebar      = themesflat_get_opt( 'portfolio_sidebar_list' );
$main_class   = 'col-12';
if ( themesflat_get_opt( 'portfolio_layout' ) == 'sidebar-left' || themesflat_get_opt( 'portfolio_layout' ) == 'sidebar-right' ) {
	if ( is_active_sidebar( $sidebar ) ) {
		$main_class = 'col-lg-8';
	}
}
$themesflat_paging_style = themesflat_get_opt( 'portfolio_archive_pagination_style' );
?>
    <div class="themesflat-portfolio-taxonomy">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wrap-content-area">
                        <div class="row">
                            <div class="<?php echo esc_attr( $main_class ) ?> content-wrap">
                                <div id="primary" class="content-area">
                                    <main id="main" class="main-content" role="main">
                                        <div class="tf-wrap-portfolio-post portfolio-post-style-01 row column-<?php echo esc_attr( $columns ); ?>">
											<?php

											if ( $query->have_posts() ) {
												while ( $query->have_posts() ) : $query->the_post();
													$id = $post->ID;
													?>
                                                    <div class="item <?php echo esc_attr( $item_classes ) ?>">
                                                        <div class="portfolio-post portfolio-post-<?php the_ID(); ?>">
                                                            <div class="featured-post">
                                                                <a class="tf-entry-portfolio-thumb" href="<?php echo esc_url( get_the_permalink() ) ?>"
                                                                   style="background-image: url('<?php echo esc_url( wp_get_attachment_image_url( get_post_thumbnail_id(), 'full' ) ) ?>');--tf-portfolio-grid-ratio:100%;">
                                                                </a>
                                                            </div>
                                                            <div class="portfolio-icon">
                                                                <a href="<?php echo get_the_permalink(); ?>"
                                                                   class="portfolio-view-more">
                                                                    <i class="bi bi-plus-lg"></i>
                                                                </a>
                                                            </div>

                                                            <div class="content">
                                                                <div class="post-meta portfolio-meta portfolio-categories">
		                                                            <?php echo get_the_term_list( $id, 'portfolio_category', '', ', ', '' ); ?>
                                                                </div>
                                                                <h2 class="title">
                                                                    <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                                                </h2>
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
							if ( themesflat_get_opt( 'portfolio_layout' ) == 'sidebar-left' || themesflat_get_opt( 'portfolio_layout' ) == 'sidebar-right' ) :
								get_sidebar();
							endif;
							?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.themesflat-portfolio-taxonomy -->

<?php get_footer(); ?>