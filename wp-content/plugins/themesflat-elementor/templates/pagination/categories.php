<?php
/**
 * @var $nonce_field
 * @var $settings_array
 */
$categories_id   = array();
$categories      = array();
$all_category_id = array();
if ( empty( $settings['portfolio_category_ids'] ) ) {
	$args = array(
		'taxonomy' => 'portfolio_category',
		'orderby' => 'name',
		'order'   => 'ASC'
	);
	$categories = get_categories($args);
	foreach ( $categories as $category ) {
		$categories_id[] = $category->term_id;
	}
} else {
	$categories_id = $settings['portfolio_category_ids'];
	foreach ( $settings['portfolio_category_ids'] as $id ) {
		$categories[] = get_category( $id );
	}
}
foreach ( $categories as $category ) {
	$all_category_id[] = $category->term_id;
}

$all_setting                       = $settings;
$all_setting['portfolio_category_ids']       = $all_category_id;
$all_args                          = tf_get_portfolio_query_args( $all_setting );
$all_args_paging                   = $all_args;
$all_args_paging['posts_per_page'] = - 1;
$query                             = new \WP_Query( $all_args_paging );
$post_count                        = $query->post_count;
$total_page                        = 1;
$post_per_page                     = $all_args['posts_per_page'];
if ( $post_per_page != 0 && $post_per_page != '' ) {
	$total_page = ceil( $post_count / $all_args['posts_per_page'] );
}
?>
<ul class="nav tf-nav-post">
    <li class="nav-item <?php if ( empty( $settings['portfolio_category_ids'] ) ) {
		echo 'active';
	} ?>" id="all"
        data-args="<?php echo http_build_query( $all_args ) ?>"
        data-settings="<?php echo http_build_query( $settings_array ) ?>" data-filter="category_filter"
        data-page="1"
        data-total-page="<?php echo esc_attr( $total_page ) ?>"
        data-widget="<?php echo esc_attr( $settings_array['id'] ) ?>"
        data-nonce="<?php echo esc_attr( $nonce_field ) ?>">
        <a class="nav-link ladda-button" href="#" data-ladda="true" data-style="zoom-out"
           data-spinner-color="currentColor"><?php esc_html_e( "All", 'themesflat-elementor' ) ?></a>
		<?php foreach ( $categories

		as $index => $category ):
		$item_setting                     = $settings;
		$item_setting['portfolio_category_ids']     = [ $category->term_id ];
		$new_args                         = tf_get_portfolio_query_args( $item_setting );

		$new_arg_paging                   = $new_args;
		$new_arg_paging['posts_per_page'] = - 1;
		$query                            = new \WP_Query( $new_arg_paging );
		$post_count                       = $query->post_count;
		$total_page                       = 1;
		$post_per_page                    = $new_args['posts_per_page'];
		$paging_post_count                = $post_count;
		if ( $post_per_page != 0 && $post_per_page != '' ) {
			$total_page = ceil( $post_count / $new_args['posts_per_page'] );
		}
		?>
    <li class="nav-item <?php if ( ! empty( $settings['portfolio_category_ids'] ) && count( $settings['portfolio_category_ids'] ) == 1 && in_array( $category->term_id, $settings['portfolio_category_ids'] ) ) {
		echo 'active';
	} ?>" id="<?php echo esc_attr( $category->slug ) ?>"
        data-args="<?php echo http_build_query( $new_args ) ?>"
        data-settings="<?php echo http_build_query( $settings_array ) ?>" data-filter="category_filter"
        data-page="1"
        data-total-page="<?php echo esc_attr( $total_page ) ?>"
        data-widget="<?php echo esc_attr( $settings_array['id'] ) ?>"
        data-nonce="<?php echo esc_attr( $nonce_field ) ?>"
    >
        <a class="nav-link ladda-button" href="#" data-ladda="true" data-style="zoom-out"
           data-spinner-color="currentColor"><?php echo esc_html( $category->name ) ?></a>
    </li>
	<?php endforeach; ?>
</ul>
