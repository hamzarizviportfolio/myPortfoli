<?php
/**
 * @var $settings
 */
$id                 = get_the_ID();
$services_post_icon = \Elementor\Addon_Elementor_Icon_manager_zoyot::render_icon( themesflat_get_opt_elementor( 'services_post_icon' ), [ 'aria-hidden' => 'true' ] );
?>
<div class="tf-services-post tf-services-post-<?php the_ID(); ?>">
	<?php if ( ! empty( $services_post_icon ) ):
		?>
        <div class="tf-service-icon">
            <span class="icon">
                <?php echo $services_post_icon; ?>
            </span>
        </div>
	<?php endif; ?>
    <div class="content">
        <h2 class="title">
            <a href="<?php echo get_the_permalink(); ?>"><?php echo esc_html( get_the_title() ) ?></a>
        </h2>
        <div class="desc"><?php echo wp_trim_words( get_the_content(), 18, '' ); ?></div>
        <a href="<?php echo get_the_permalink(); ?>"
           class="services-view-more">
            <i class="fal fa-long-arrow-right"></i>
        </a>
    </div>
</div>