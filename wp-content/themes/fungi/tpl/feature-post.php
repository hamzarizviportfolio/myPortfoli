<?php
$feature_post = '';
global $themesflat_thumbnail;
global $themesflat_post_formatted;

$archive_month  = get_the_time( 'm' );
$archive_day    = get_the_time( 'd' );
$blog_layout    = themesflat_get_opt( 'blog_archive_layout' );

switch ( get_post_format() ) {
	case 'gallery':
		$size = 'themesflat-blog';
		$images = themesflat_decode( themesflat_meta( 'gallery_images' ) );

		if ( empty( $images ) ) {
			break;
		}
		?>
        <div class="featured-post">
            <div class="customizable-carousel" data-loop="true" data-items="1" data-md-items="1" data-sm-items="1"
                 data-xs-items="1" data-space="15" data-autoplay="true" data-autospeed="4000" data-nav-dots="false"
                 data-nav-arrows="true">
				<?php
				if ( ! empty( $images ) && is_array( $images ) ) {
					foreach ( $images as $image ) { ?>
                        <div class="item-gallery">
							<?php echo wp_get_attachment_image( $image, $themesflat_thumbnail ); ?>
                        </div>
					<?php }
				}
				?>
            </div>
        </div><!-- /.feature-post -->
		<?php
		break;
	case 'video':
		$video = themesflat_meta( 'video_url' );
		if ( ! $video ) {
			break;
		}
		$end        = "";
		if ( has_post_thumbnail() ) {
			echo '<div class="featured-post">';
			echo '<div class="themesflat_video_embed">';
			if ( $blog_layout == 'blog-standard' ) {
				echo get_the_post_thumbnail( null, $themesflat_thumbnail );
			} elseif ( $blog_layout == 'blog-list' ) {
				themesflat_render_thumbnail_markup( array(
					'image_size'  => '740x692',
					'image_mode'  => 'background',
					'placeholder' => ''
				) );
			} elseif ( $blog_layout == 'blog-grid' ) {
				themesflat_render_thumbnail_markup( array(
					'image_size'  => '740x740',
					'image_mode'  => 'background',
					'placeholder' => ''
				) );
			}

			echo '<div class="video-video-box-overlay">
				<div class="video-video-box-button-sm video-box-button-lg">					
					<button class="video-video-play-icon" data-izimodal-open="#format-video">
					<i class="fas fa-play"></i>
					</button>
				</div>					
			</div>';
			echo '</div>';
			echo '<div class="izimodal" id="format-video" data-izimodal-width="850px" data-iziModal-fullscreen="true">
			    <iframe height="430" src="' . esc_url( $video ) . '" class="full-width shadow-primary"></iframe>
			</div>';
			echo '</div>';
		}
		break;

	case 'audio':
		$audio_url = themesflat_meta( 'audio_url' );
		echo '<div class="themesflat_audio">' . $audio_url . '</div>';
		break;

	default:
		if ( $themesflat_post_formatted == 1 ) {
			$themesflat_thumbnail = 'themesflat-blog-formatted';
		}
		$size = is_single() ? 'themesflat-blog' : $themesflat_thumbnail;

		$thumb = get_the_post_thumbnail( get_the_ID(), $size );
		if ( empty( $thumb ) ) {
			return;
		}
		echo '<div class="featured-post">';
		if ( $blog_layout == 'blog-standard' ) {
			echo get_the_post_thumbnail( null, $themesflat_thumbnail );
		} elseif ( $blog_layout == 'blog-list' ) {
			themesflat_render_thumbnail_markup( array(
				'image_size'  => '740x692',
				'image_mode'  => 'background',
				'placeholder' => ''
			) );
		} elseif ( $blog_layout == 'blog-grid' ) {
			themesflat_render_thumbnail_markup( array(
				'image_size'  => '740x740',
				'image_mode'  => 'background',
				'placeholder' => ''
			) );
		}
		echo '</div>';
}
?>
