<?php
/**
 * @var $category_length
 * @var $settings
 */
?>
<div class="<?php echo esc_attr( $settings['column_class'] ) ?>">
    <div class="portfolio-post portfolio-post-<?php the_ID(); ?>">
		<?php if ( has_post_thumbnail() && $settings['show_image'] == 'yes' ) : ?>
            <div class="featured-post">
                <a class="tf-entry-portfolio-thumb" href="<?php echo esc_url( get_the_permalink() ) ?>"
                   style="background-image: url('<?php echo esc_url( wp_get_attachment_image_url( get_post_thumbnail_id(), 'full' ) ) ?>');--tf-portfolio-grid-ratio:<?php echo $settings['ratio'] ?>;">
                </a>
	            <?php if ( $settings['show_read_more_button'] ) : ?>
                    <a href="<?php echo get_the_permalink(); ?>"
                       class="portfolio-view-more">
                        <i class="fal fa-long-arrow-right"></i>
                    </a>
	            <?php endif; ?>
            </div>
		<?php endif; ?>
        <div class="content">
			<?php if ( $settings['show_title'] ): ?>
                <h2 class="title">
                    <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                </h2>
			<?php endif; ?>
			<?php if ( $settings['show_category'] == 'yes' ):
				$categories = tf_get_terms_as_list( 'category', $category_length, get_the_ID() );
				?>
                <div class="post-meta portfolio-meta portfolio-categories">
					<?php
					echo wp_kses_post( $categories );
					?>
                </div>
			<?php endif; ?>
        </div>
    </div>
</div>