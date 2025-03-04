<?php
/*
Template Name: Sidebar Page
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="profile" href="<?php echo THEMESFLAT_PROTOCOL ?>://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="themesflat-boxed">
        <div class="page-sidebar">
            <div class="page-sidebar-nav">
                <?php
                get_template_part( 'tpl/site-header' );
                ?>
            </div>
            <div class="page-sidebar-content">
                <?php get_template_part( 'tpl/page-title' ); ?>
                <main id="main" class="site-main" role="main">
                    <div class="entry-content">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php the_content(); ?>
                        <?php endwhile; ?>
                    </div><!-- .entry-content -->
                </main><!-- #main -->
            </div>
        </div>
    </div>



    <?php
    $footer_wrap_classes = array(
        'footer_background',
        themesflat_get_opt_elementor( 'extra_classes_footer' ),
    );
    ?>

    <!-- Start Footer -->
    <div class="<?php echo esc_attr( join( ' ', $footer_wrap_classes ) ); ?>">
        <!-- Bottom -->
        <?php if ( themesflat_get_opt( 'show_bottom' ) == 1 ): ?>
            <?php get_template_part( 'tpl/footer/bottom' ); ?>
        <?php endif; ?>

    </div> <!-- Footer Background Image -->
    <!-- End Footer -->
    </div><!-- /#boxed -->
    <?php wp_footer(); ?>
</body>
</html>