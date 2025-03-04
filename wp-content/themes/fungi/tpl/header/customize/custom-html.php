<?php $header_custom_html = themesflat_get_option( 'header_custom_html' ); ?>
<div class="header-customize-item header-custom-html">
	<?php echo wp_kses( $header_custom_html, themesflat_kses_allowed_html() ) ?>
</div>