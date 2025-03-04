<?php
$header_button     = themesflat_get_option( 'header_button' );
$header_url_button = themesflat_get_option( 'header_url_button' );
$header_url_button = ! empty( $header_url_button ) ? $header_url_button : '#';

?>
<div class="header-customize-item header-btn">
    <a href="<?php echo esc_url( $header_url_button ) ?>"
       class="btn btn-primary btn-round"><?php echo wp_kses( $header_button, themesflat_kses_allowed_html() ) ?></a>
</div>