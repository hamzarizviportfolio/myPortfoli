<?php
$wrap_classes              = array(
	'header',
	'header-style-01',
	themesflat_get_opt_elementor( 'extra_classes_header' ),
);
$wrap_class                = implode( ' ', $wrap_classes );
$header_custom_html_enable = themesflat_get_option( 'header_custom_html_enable' );
$header_custom_html        = themesflat_get_option( 'header_custom_html' );
$header_phone_enable       = themesflat_get_option( 'header_phone_enable' );
$header_email_enable       = themesflat_get_option( 'header_email_enable' );
$header_sidebar_toggler    = themesflat_get_option( 'header_sidebar_toggler' );
$header_search_box         = themesflat_get_option( 'header_search_box' );

$header_button_enable      = themesflat_get_option( 'header_button_enable' );
$header_social_enable      = themesflat_get_option( 'header_social_icon' );
$header_image_enable       = themesflat_get_option( 'header_image_enable' );
$menu              = themesflat_get_opt_elementor( 'select_page_menu' );
?>

<header id="header" class="header-template-menu <?php echo esc_attr( $wrap_class ) ?>">
	<?php get_template_part( 'tpl/topbar' ); ?>
    <div class="inner-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="header-wrap">
                        <div class="header-ct-left">
							<?php get_template_part( 'tpl/header/brand' ); ?>
                            <?php if ( $header_image_enable == 1 ) : ?>
                                <?php get_template_part( 'tpl/header/image-nav' ); ?>
                            <?php endif; ?>
                        </div>
                        <div class="header-ct-right">
	                        <?php get_template_part( 'tpl/header/navigator' ); ?>
							<?php if ( $header_button_enable == 1 ) : ?>
								<?php get_template_part( 'tpl/header/customize/button' ); ?>
							<?php endif; ?>
                        </div>
                    </div>
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
</header><!-- /.header --> 