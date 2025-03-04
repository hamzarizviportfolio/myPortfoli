<?php
$header_search_box         = themesflat_get_option( 'header_search_box' );
$header_sidebar_toggler    = themesflat_get_option( 'header_sidebar_toggler' );
$header_custom_html_enable = themesflat_get_option( 'header_custom_html_enable' );
$header_custom_html        = themesflat_get_option( 'header_custom_html' );
$header_style              = themesflat_get_option( 'style_header' );
$header_phone_enable       = themesflat_get_option( 'header_phone_enable' );
$header_button_enable      = themesflat_get_option( 'header_button_enable' );
$header_social_enable      = themesflat_get_option( 'header_social_icon' );
$header_email_enable       = themesflat_get_option( 'header_email_enable' );
?>

<div class="header-customize">
	<?php if ( $header_phone_enable == 1 ) : ?>
		<?php get_template_part( 'tpl/header/customize/phone' ); ?>
	<?php endif; ?>
	<?php if ( $header_email_enable == 1 ) : ?>
		<?php get_template_part( 'tpl/header/customize/email' ); ?>
	<?php endif; ?>
	<?php if ( $header_search_box == 1 ) : ?>
		<?php get_template_part( 'tpl/header/customize/search-box' ); ?>
	<?php endif; ?>
	<?php if ( $header_custom_html_enable == 1 && $header_custom_html !== '' ) : ?>
		<?php get_template_part( 'tpl/header/customize/custom-html' ); ?>
	<?php endif; ?>
	<?php if ( $header_button_enable == 1 ) : ?>
		<?php get_template_part( 'tpl/header/customize/button' ); ?>
	<?php endif; ?>
	<?php if ( $header_social_enable == 1 ) : ?>
		<?php get_template_part( 'tpl/header/customize/social-icon' ); ?>
	<?php endif; ?>
	<?php if ( $header_sidebar_toggler == 1 ) : ?>
		<?php get_template_part( 'tpl/header/customize/sidebar-toggler' ); ?>
	<?php endif; ?>
</div>
