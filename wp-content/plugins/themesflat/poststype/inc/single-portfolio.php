<?php
get_header();
$sidebar    = themesflat_get_opt( 'portfolio_single_sidebar_list' );
$main_class = 'col-12';
if ( themesflat_get_opt( 'portfolio_single_layout' ) == 'sidebar-left' || themesflat_get_opt( 'portfolio_single_layout' ) == 'sidebar-right' ) {
	if ( is_active_sidebar( $sidebar ) ) {
		$main_class = 'col-lg-8';
	}
}
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wrap-content-area">
                    <div id="primary" class="content-area">
                        <main id="main" class="main-content" role="main">
                            <div class="entry-content">
								<?php while ( have_posts() ) :
									the_post();
									$id    = get_the_ID();
									$class = get_post_meta( $id, 'tf_portfolio_class', true );
																	?>

                                    <div class="row">
                                        <div class="<?php echo esc_attr( $main_class ) ?> content-wrap">
                                            <div class="featured-post"><?php the_post_thumbnail( 'full' ); ?></div>
                                            <h1 class="post-title"><?php the_title(); ?></h1>
											<?php the_content(); ?>
											<?php if ( themesflat_get_opt( 'portfolio_show_post_navigator' ) == 1 ): ?>
                                                <!-- Navigation  -->
												<?php themesflat_post_navigation(); ?>
											<?php endif; ?>
                                        </div>
										<?php
										if ( themesflat_get_opt( 'portfolio_single_layout' ) == 'sidebar-left' || themesflat_get_opt( 'portfolio_single_layout' ) == 'sidebar-right' ) :
											get_sidebar();
										endif;
										?>
                                    </div>

								<?php endwhile; // end of the loop. ?>
                            </div><!-- ./entry-content -->
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div>
            </div>
        </div>
    </div>

    <!-- Related -->
<?php if ( themesflat_get_opt( 'portfolio_show_related' ) == 1 ) { ?>
    <div class="container">
		<?php
		$grid_columns = themesflat_get_opt( 'portfolio_related_grid_columns' );
		$layout       = 'portfolio-grid';

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		$terms     = get_the_terms( $post->ID, 'portfolio_category' );
		if ( $terms != '' ) :
			$term_ids = wp_list_pluck( $terms, 'term_id' );
			$args  = array(
				'post_type'           => 'portfolio',
				'tax_query'           => array(
					array(
						'taxonomy' => 'portfolio_category',
						'field'    => 'term_id',
						'terms'    => $term_ids,
						'operator' => 'IN'
					)
				),
				'posts_per_page'      => themesflat_get_opt( 'number_related_post_portfolio' ),
				'ignore_sticky_posts' => 1,
				'post__not_in'        => array( $post->ID )
			);
			$class = array();
			if ( $layout != '' ) {
				$class[] = $layout;
			}
			if ( $grid_columns != '' ) {
				$class[] = 'column-' . $grid_columns;
			}
			$slick_options   = array(
				'slidesToShow' => intval( $grid_columns ),
			);
			$tablet_settings = array(
				'slidesToShow' => 2,
			);
			$mobile_settings = array(
				'slidesToShow' => 1,
			);
			$responsive      = array(
				array(
					'breakpoint' => '768',
					'settings'   => $tablet_settings
				),
				array(
					'breakpoint' => '576',
					'settings'   => $mobile_settings
				)
			);

			$slick_options['responsive'] = $responsive;

			$query = new WP_Query( $args );
			if ( $query->have_posts() ) :
				?>
                <div class="related-post related-posts-box">
                    <div class="box-wrapper">
                        <div class="box-title-wrap">
                            <h3 class="box-title"><?php esc_html_e( 'Related Post', 'themesflat' ) ?></h3>
                        </div>
                        <div class="themesflat-portfolio-taxonomy">
                            <div class="<?php echo esc_attr( implode( ' ', $class ) ) ?> wrap-portfolio-post has-carousel portfolio-post-style-01"
                                 data-slick-options="<?php echo esc_attr( json_encode( $slick_options ) ) ?>">
								<?php
								while ( $query->have_posts() ) : $query->the_post(); ?>
                                    <div class="item <?php echo esc_attr( $item_classes ) ?>">
                                        <div class="portfolio-post portfolio-post-<?php the_ID(); ?>">
                                            <div class="featured-post">
                                                <a class="tf-entry-portfolio-thumb" href="<?php echo esc_url( get_the_permalink() ) ?>"
                                                   style="background-image: url('<?php echo esc_url( wp_get_attachment_image_url( get_post_thumbnail_id(), 'full' ) ) ?>');">
                                                </a>
                                                <a href="<?php echo get_the_permalink(); ?>"
                                                   class="portfolio-view-more">
                                                    <i class="fal fa-long-arrow-right"></i>
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h2 class="title">
                                                    <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                                </h2>
                                                <div class="post-meta portfolio-meta portfolio-categories">
													<?php echo get_the_term_list( $id, 'portfolio_category', '', ', ', '' ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								<?php
								endwhile;
								?>
                            </div>
                        </div>
                    </div>
                </div>
			<?php
			endif;
			wp_reset_postdata();
		endif; ?>
    </div>
<?php } ?>

<?php get_footer(); ?>


