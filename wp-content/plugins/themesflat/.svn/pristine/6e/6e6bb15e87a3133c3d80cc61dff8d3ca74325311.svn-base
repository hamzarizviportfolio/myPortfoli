<?php
get_header();
$custom_layout = '';
$sidebar       = themesflat_get_opt( 'services_single_sidebar_list' );
$main_class    = 'col-12';
if ( themesflat_get_opt( 'services_single_layout' ) == 'sidebar-left' || themesflat_get_opt( 'services_single_layout' ) == 'sidebar-right' || $custom_layout == 'sidebar-right' || $custom_layout == 'sidebar-left' ) {
	if ( is_active_sidebar( $sidebar ) ) {
		$main_class = 'col-lg-8';
	}
}
?>
    <div class="container">
        <div class="wrap-content-area">
            <div id="primary" class="content-area">
                <main id="main" class="main-content" role="main">
                    <div class="entry-content">
						<?php while ( have_posts() ) : the_post(); ?>
                            <div class="row tf-wrap-content">
                                <div class="<?php echo esc_attr( $main_class ) ?> content-wrap tf-content-wrap">
									<?php if ( has_post_thumbnail() ): ?>
                                        <div class="featured-post">
                                            <div class="image">
												<?php the_post_thumbnail( 'themesflat-services-image' ); ?>
                                            </div>
                                        </div>
									<?php endif; ?>
                                    <div class="services-content-top">
                                        <div class="service-content-wrap">
											<?php $service_post_icon = \Elementor\Addon_Elementor_Icon_manager_zoyot::render_icon( themesflat_get_opt_elementor( 'services_post_icon' ), [ 'aria-hidden' => 'true' ] );
											?>
											<?php if ( ! empty( $service_post_icon ) ):
												?>
                                                <div class="tf-service-icon">
                                                    <span class="icon">
                                                        <?php echo $service_post_icon; ?>
                                                    </span>
                                                </div>
											<?php endif; ?>
                                            <div class="service-content">
                                                <div class="post-meta services-meta services-categories">
													<?php echo get_the_term_list( $id, 'services_category', '', ', ', '' ); ?>
                                                </div>
                                                <h1 class="post-title">
													<?php echo esc_html( get_the_title() ); ?>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
									<?php the_content(); ?>
									<?php
									if ( themesflat_get_opt( 'show_entry_footer_content' ) == 1 ) :
										?>
										<?php
										$terms = wp_get_post_terms( get_the_ID(), 'services_tag' );
										if ( ! empty( $terms ) && empty( $terms->errors ) ) :
											?>
                                            <div class="entry-footer">
                                                <div class="divider"></div>
												<?php
												$terms_list = array();
												foreach ( $terms as $term ) {
													$term_name    = $term->name;
													$term_url     = get_term_link( $term );
													$terms_list[] = '<a href="' . esc_attr( $term_url ) . '" rel="tag">' . esc_html( $term_name ) . '</a>';
												}
												$terms_list = implode( '', $terms_list );
												echo sprintf( __( '<div class="tags-links"><span class="themesflat-tags-lable">Tags : </span> %1$s</div>', 'themesflat' ), $terms_list );
												?>
                                            </div>
										<?php
										endif;
										?>

									<?php

									endif;
									?>
									<?php
									// If comments are open or we have at least one comment, load up the comment template
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;
									?>
									<?php if ( themesflat_get_opt( 'services_show_post_navigator' ) == 1 ): ?>
                                        <!-- Navigation  -->
										<?php themesflat_post_navigation(); ?>
									<?php endif; ?>
                                </div>
								<?php
								if ( themesflat_get_opt( 'services_single_layout' ) == 'sidebar-left' || themesflat_get_opt( 'services_single_layout' ) == 'sidebar-right' || $custom_layout == 'sidebar-right' || $custom_layout == 'sidebar-left' ) :
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
    <!-- Related -->
<?php if ( themesflat_get_opt( 'services_show_related' ) == 1 ) { ?>
    <div class="container">
		<?php
		$grid_columns = themesflat_get_opt( 'services_related_grid_columns' );
		$layout       = 'services-grid';

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		$terms = get_the_terms( $post->ID, 'services_category' );
		if ( $terms != '' ) {
			$term_ids = wp_list_pluck( $terms, 'term_id' );
			$args     = array(
				'post_type'           => 'services',
				'tax_query'           => array(
					array(
						'taxonomy' => 'services_category',
						'field'    => 'term_id',
						'terms'    => $term_ids,
						'operator' => 'IN'
					)
				),
				'posts_per_page'      => themesflat_get_opt( 'number_related_post_services' ),
				'ignore_sticky_posts' => 1,
				'post__not_in'        => array( $post->ID )
			);

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
			?>
            <div class="related-post related-posts-box">
                <div class="box-wrapper">
                    <div class="box-title-wrap">
                        <div class="box-sub-title"><span><?php esc_html_e( 'Our Services', 'themesflat' ) ?></span>
                        </div>
                        <h3 class="box-title"><?php esc_html_e( 'Related Post', 'themesflat' ) ?></h3>
                    </div>
                    <div class="themesflat-services-taxonomy">
                        <div class="<?php echo esc_attr( implode( ' ', $class ) ) ?> wrap-services-post has-carousel"
                             data-slick-options="<?php echo esc_attr( json_encode( $slick_options ) ) ?>">
							<?php
							$query = new WP_Query( $args );
							if ( $query->have_posts() ) {
								while ( $query->have_posts() ) : $query->the_post();
									$services_post_icon = \Elementor\Addon_Elementor_Icon_manager_zoyot::render_icon( themesflat_get_opt_elementor( 'services_post_icon' ), [ 'aria-hidden' => 'true' ] );
									?>
                                    <div class="item tf-services-style-01">
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
							}
							wp_reset_postdata();
							?>
                        </div>
                    </div>
                </div>
            </div>
		<?php } ?>
    </div>
<?php } ?>

<?php get_footer(); ?>