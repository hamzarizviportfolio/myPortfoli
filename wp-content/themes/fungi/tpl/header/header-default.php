<?php
$wrap_classes = array(
	'header',
	'header-default',
	themesflat_get_opt_elementor( 'extra_classes_header' ),
);

$header_image_enable       = themesflat_get_option( 'header_image_enable' );

$wrap_class = implode( ' ', $wrap_classes );
?>
<header id="header" class="<?php echo esc_attr( $wrap_class ) ?>">
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
                        </div>
                    </div>
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
</header><!-- /.header --> 