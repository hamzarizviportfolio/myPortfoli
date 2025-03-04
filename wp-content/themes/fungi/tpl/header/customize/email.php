<?php
$header_email = themesflat_get_option( 'header_email' );
?>
<div class="header-customize-item email-info">
	<div class="icon">
        <i class="far fa-envelope"></i>
	</div>
	<div class="info-content">
		<?php echo wp_kses( $header_email, themesflat_kses_allowed_html() ) ?>
	</div>
</div>