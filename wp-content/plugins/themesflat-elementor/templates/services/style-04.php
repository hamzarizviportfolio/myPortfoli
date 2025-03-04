<?php
/**
 * @var $settings
 */
$id                 = get_the_ID();
$services_post_icon = \Elementor\Addon_Elementor_Icon_manager_zoyot::render_icon( themesflat_get_opt_elementor( 'services_post_icon' ), [ 'aria-hidden' => 'true' ] );
?>
<div class="tf-services-post tf-services-post-<?php the_ID(); ?>">
	<?php if ( has_post_thumbnail() && $settings['show_image'] == 'yes' ): ?>
        <div class="featured-post">
			<?php
			themesflat_render_thumbnail_markup( array(
				'image_size' => $settings['image_size'],
				'image_mode' => 'background',
			) );
			?>
            <a href="<?php echo get_the_permalink(); ?>"
               class="services-view-more">
                <i class="fal fa-long-arrow-right"></i>
            </a>
        </div>
	<?php endif; ?>
    <div class="content">
        <div class="content-wrap">
            <h2 class="title">
                <a href="<?php echo get_the_permalink(); ?>"><?php echo esc_html( get_the_title() ) ?></a>
            </h2>
	        <?php if ( ! empty( $services_post_icon ) ):
		        ?>
                <div class="tf-service-icon">
			        <?php echo $services_post_icon; ?>
                </div>
	        <?php endif; ?>
        </div>

    </div>
</div>