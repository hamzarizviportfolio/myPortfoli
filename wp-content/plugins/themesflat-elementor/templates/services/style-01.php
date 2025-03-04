<?php
/**
 * @var $settings
 */
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
        </div>
	<?php endif; ?>
	<div class="content">
		<div class="content-wrap">
			<div class="post-meta services-meta services-categories">
				<?php echo get_the_term_list( get_the_ID(), 'services_category', '', ', ', '' ); ?>
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