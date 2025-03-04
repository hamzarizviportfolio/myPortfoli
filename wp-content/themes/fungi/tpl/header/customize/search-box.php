<?php $header_custom_html = themesflat_get_option( 'header_custom_html' ); ?>
<div class="header-customize-item show-search">
    <a class="icon-show-search" href="#"><i class="fungi-icon-search"></i></a>
    <div class="submenu top-search widget_search">
		<?php get_search_form(); ?>
    </div>
</div>