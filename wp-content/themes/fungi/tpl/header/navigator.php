<?php
$menu = themesflat_get_opt_elementor( 'select_page_menu' );
?>

<div class="nav-wrap">
    <nav id="mainnav" class="mainnav" role="navigation">
		<?php
		$arg_menu = array(
			'theme_location' => 'primary',
			'fallback_cb'    => 'themesflat_menu_fallback',
			'container'      => false,
		);

		if ( $menu !== "" ) {
			$arg_menu['menu'] = $menu;
		}

		wp_nav_menu( $arg_menu );
		?>
    </nav><!-- #site-navigation -->
</div><!-- /.nav-wrap -->   