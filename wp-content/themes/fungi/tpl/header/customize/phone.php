<?php
$header_phone = themesflat_get_option( 'header_phone' );
?>
<div class="header-customize-item phone-info">
    <div class="icon">
        <i class="fungi-icon-phone"></i>
    </div>
    <div class="info-content">
		<?php echo wp_kses( $header_phone, themesflat_kses_allowed_html() ) ?>
    </div>
</div>