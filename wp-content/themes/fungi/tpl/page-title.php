<?php
if ( is_page() && is_page_template( 'tpl/front-page.php' ) ) {
	return;
}

$titles = themesflat_get_page_titles();
ob_start();
if ( $titles['title'] ) {
	printf( '%s', wp_kses_post( $titles['title'] ) );
}
$title = ob_get_clean();

?>
<!-- Page title -->
<?php
$page_title_styles    = themesflat_get_opt( 'page_title_styles' );
$page_title_alignment = themesflat_get_opt( 'page_title_alignment' );
$page_title_parallax  = themesflat_get_opt( 'page_title_bg_fix_enabled' );
$page_title_video_url = themesflat_get_opt( 'page_title_video_url' );
$breadcrumb_type      = themesflat_get_opt( 'breadcrumb_type' );
$sub_title            = themesflat_get_opt( 'sub_title' );

$wrap_classes = array(
	'page-title',
	$page_title_styles,
	$page_title_alignment,
	themesflat_get_opt_elementor( 'extra_classes_pagetitle' ),
);

if ( $page_title_parallax === 1 ) {
	$wrap_classes[] = 'bg-attachment-fixed';
}

$wrap_class = implode( ' ', $wrap_classes );

?>
<header class="page-header">
    <div class="<?php echo esc_attr( $wrap_class ) ?>">
        <div id="ptbgVideo" class="player"
             data-property="{videoURL:'<?php echo esc_url( $page_title_video_url ); ?>',containment:'.page-title', showControls:false, autoPlay:true, loop:true, mute:true, startAt:0, opacity:1, quality:'large'}"></div>
        <div class="overlay"></div>
		<?php
		if ( themesflat_get_opt( 'sub_title_enabled' ) == 1 ) {
			echo sprintf( '<h6 class="page-sub-title">%s</h6>', $sub_title );
		}
		?>
        <div class="container position-relative">
            <div class="row">
                <div class="page-title-container">
					<?php
					if ( themesflat_get_opt( 'page_title_heading_enabled' ) == 1 ) {
						echo sprintf( '<h1 class="page-title-heading">%s</h1>', $title );
					}
					?>
					<?php
					if ( $breadcrumb_type == 'breadcrumb-01' && $breadcrumb_type != '' ):
						themesflat_breadcrumb();
					endif;
					?>
					<?php
					if ( $breadcrumb_type == 'breadcrumb-02' && $breadcrumb_type != '' ): ?>
                        <div class="breadcrumbs">
                            <a href="<?php echo get_home_url() ?>"
                               class="text-capitalize"><?php echo esc_html__( 'Back To Home Page', 'fungi' ) ?></a>
                        </div>
					<?php endif; ?>
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.page-title -->
</header><!-- /.page-header -->
